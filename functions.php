<?php
/**
 * storefront engine room
 *
 * @package storefront
 */

/**
 * Initialize all the things.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Remove default wordpress java script library from this theme
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function modify_jquery() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . './js/vendor/jquery.js', false, '3.2.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery');
/* --- */


add_action( 'shop_messages', 'storefront_shop_messages', 1);

add_filter( 'woocommerce_enqueue_styles', 	'__return_empty_array' );

/**
 * Note: Do not add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * http://codex.wordpress.org/Child_Themes
 */
 
add_action('admin_head', 'set_admin_favicon');
function set_admin_favicon() {
  echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/favicon.ico" />';
}

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

add_filter('woocommerce_return_to_shop_redirect', 'custom_return_to_shop_redirect');
function custom_return_to_shop_redirect(){
    return '/';
}

add_filter('wc_add_to_cart_message', 'custom_wc_add_to_cart_message');
function custom_wc_add_to_cart_message(){
    return 'Продукт добавлен в корзину';
}

/*-- Breadcrumb --*/
add_action( 'custom_breadcrumb', 'woocommerce_breadcrumb',1 );
add_filter( 'woocommerce_breadcrumb_defaults', 'mc_woocommerce_breadcrumbs' );
function mc_woocommerce_breadcrumbs() {
    
    return array(
            'delimiter'   => '  ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a href="http://new.makita-club.ru"><i class="fa fa-home" aria-hidden="true"></i></a>',
            'wrap_after'  => '</nav>',
            'before'      => '<div class="divider">',
            'after'       => '</div>',
            'home'        => _x( '', 'breadcrumb', 'woocommerce' ),
        );
}

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);

    $fields['billing']['billing_first_name']['label'] = 'Имя, фамилия';
    $fields['billing']['billing_first_name']['input_class'] = array('form-control');

    $fields['billing']['billing_email']['required'] = false;
    $fields['billing']['billing_email']['input_class'] = array('form-control');

    $fields['billing']['billing_phone']['label'] = 'Телефон';
    $fields['billing']['billing_phone']['input_class'] = array('form-control');

    $fields['billing']['billing_address_1']['required'] = false;
    $fields['billing']['billing_address_1']['label'] = 'Адрес доставки';
    $fields['billing']['billing_address_1']['input_class'] = array('form-control');

    $fields['billing']['billing_email']['required'] = false;
    $fields['billing']['billing_email']['input_class'] = array('form-control');
  return $fields;
}

add_filter('woocommerce_cart_needs_payment', 'custom_woocommerce_cart_needs_payment');
function custom_woocommerce_cart_needs_payment(){
    return false;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_woocommerce_checkout_fields' );
function custom_woocommerce_checkout_fields( $fields ) {        
     $fields['shipping']['shipping_pos'] = array(
        'label'     => "Точка самовывоза",
        'placeholder'   => "Выберите точку самовывоза",
        'required'  => false,
        'class'     => array('form-row-wide'),
        'clear'     => true
     );

     return $fields;
}

add_action( 'woocommerce_checkout_init', 'wc_add_pos_checkout', 10, 1 );
function wc_add_pos_checkout( $checkout ) {	
		$checkout->checkout_fields['billing']['billing_pos'] = array(
			'type' 				=> 'select',
			'label' 			=> 'Точка самовывоза',
            'input_class' => array('form-control'),
			// 'required'          => true,
			'placeholder' 		=> 'Выберите точку самовывоза',
            'options'           => array(
                // пункты самовывоза:
                //'no' => 'Не выбрана',
                // 'nourth' => 'Север м. Свиблово, ул. Верхоянская 18к2',
                // 'sourth' => 'ЮГ м. Аннино 33 км МКАД'
            )
		);	
}

add_action('woocommerce_checkout_process', 'custom_woocommerce_checkout_process');

function custom_woocommerce_checkout_process() {         
    if ( $_POST['shipping_method'][0] === 'local_pickup' && (!$_POST['billing_pos'] || $_POST['billing_pos'] === 'no')){
        wc_add_notice( 'Не выбрана точка самовывоза', 'error' );
    }
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    storefront_cart_link();
    $fragments['.cart-content'] = ob_get_clean();

    return $fragments;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

add_filter( 'woocommerce_output_related_products_args', 'custom_related_products_args' );
function custom_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 4; // arranged in 2 columns
    return $args;
}

add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );    // 2.1 +
function custom_woocommerce_product_add_to_cart_text($product) {
    global $product;
    //isset( $quantity ) ? $quantity : 1 
    switch (variable) {
        case $product->is_purchasable() && $product->is_in_stock() :
            return 'Купить';//<i class="fa fa-shopping-cart fa-lg"></i><i class="fa fa-plus fa-lg" style="margin-left: 5px"></i>
            break;
        case $product->price > 0  && !$product->is_in_stock() :
                    return '<div class="product-more">Нет в наличии</div>';
                    break;            
        default:
            return '<div class="product-more">Нет в наличии</div>';
            break;
    }
    
}

add_filter('woocommerce_product_docs', 'woocommerce_product_docs_tab');
function woocommerce_product_docs_tab() {
    wc_get_template( 'single-product/tabs/docs.php' );
}

add_filter('loop_shop_columns', 'custom_loop_columns');
function custom_loop_columns() {
    return 4;
}

function woo_remove_product_tabs( $tabs ) {
    //unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    //unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

add_filter( 'woocommerce_localisation_address_formats', 'custom_localisation_address_formats' );
function custom_localisation_address_formats( $args ) {
    $args['default'] = "{address_1}";
    return $args;
}

add_action( 'init', 'allow_origin' );
function allow_origin() {
    header("Access-Control-Allow-Origin: *");
}

add_filter( 'woocommerce_product_categories_widget_args', 'woo_hide_product_categories_widget' );
function woo_hide_product_categories_widget( $list_args ){
	$list_args[ 'hide_empty' ] = 1;
	
	return $list_args;
}

add_filter( 'product_cat_class', 'remove_product_cat_class', 21, 3 );
function remove_product_cat_class( $classes ) {
    $classes = array_diff(  $classes, array( 'first', 'last' ) ); // remove this classes
    return $classes;
}

add_action('woocommerce_after_checkout_validation', 'custom_woocommerce_after_checkout_validation');
function custom_woocommerce_after_checkout_validation($posted) {
    if ($posted['shipping_method'][0] == 'local_delivery' && empty( $posted['billing_address_1'])){
        wc_add_notice( '<strong>Адрес доставки</strong> не указан', 'error' );
    }
}

add_filter( 'woocommerce_subcategory_count_html', 'custom_subcategory_count_html' );
function custom_subcategory_count_html() {
    // No count
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 1000;' ), 20 );
function storefront_header_cart() {
    if ( is_woocommerce_activated() ) {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul class="site-header-cart menu">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php storefront_cart_link(); ?>
            </li>
        </ul>
        <?php
    }
}

add_action( 'wp_ajax_add_foobar', 'prefix_ajax_add_foobar' );
add_action( 'wp_ajax_nopriv_add_foobar', 'prefix_ajax_add_foobar' );

function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="menu" /',$menu);        
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 

function prefix_ajax_add_foobar() {
   $product_id  = intval( $_POST['product_id'] );
// add code the add the product to your cart
die();
}

//Products list in category
function woocommerce_template_loop_product_thumbnail(){
    global $post;
    echo get_the_post_thumbnail( $post->ID, 'list_products_img');
}

function storefront_cart_link() {
    ?>
    <div class="cart-content">
        <a href="/shopping-cart">     
        <?php if (WC()->cart->is_empty()){?>
            <div class="cart-content__section">
                Корзина пуста
                <div class="icon"></div>
            </div>
        <?php } else { ?>
            <div class="cart-content__section">
                <div class="available">
                    В корзине
                    <span class="amount">
                        <?php echo wp_kses_data( sprintf( _n( '%d item', '%d itesms', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?>
                    </span>
                </div>
                <div class="price">
                    на сумму
                    <span class="amount">
                    <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
                    </span>
                </div>
                <div class="icon"></div>
            </div>
        <?php } ?>
        </a>
    </div>
<?php
}
?>