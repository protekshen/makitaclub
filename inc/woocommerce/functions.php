<?php
/**
 * General functions used to integrate this theme with WooCommerce.
 *
 * @package storefront
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */

function get_product_category_by_slug($cat_slug)
{
    $category = get_term_by('slug', $cat_slug, 'product_cat', 'ARRAY_A');
    return $category['term_taxonomy_id'];
}

if ( ! function_exists( 'storefront_before_content' ) ) {
	function storefront_before_content() {
		?>
		<div class="row">
			<div class="columns  large-3">
				<div class="products-cart  hide-for-small-only">	
					<div><?php storefront_header_cart(); ?></div>
				</div>
				<?php  
					do_action( 'storefront_sidebar' );
				?>
			</div>
			<div class="columns  large-9">
				<?php 
					global $wp_query;
					$cat = $wp_query->get_queried_object();
					$display_type = get_woocommerce_term_meta($cat->term_id, 'display_type', true);
					// products // subcategories

					if ($display_type == 'products') {
						echo '<div class="catalog-ordering">';
							do_action( 'woocommerce_catalog_ordering'); 
						echo '</div>';
					}
				?>
				
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
		<?php
	}
}

//Reposition WooCommerce breadcrumb 
function woocommerce_remove_breadcrumb(){
	remove_action( 
		'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
	add_action(
		'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
	);

function woocommerce_custom_breadcrumb(){
    woocommerce_breadcrumb();
}

add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

function woocommerce_catalog_ordering() {
	global $wp_query;

	if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() ) {
		return;
	}

	$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
		'menu_order' => __( 'по умолчанию', 'woocommerce' ), //Default sorting
		'popularity' => __( 'по популярности', 'woocommerce' ), //Sort by popularity
		'rating'     => __( 'по рейтингу', 'woocommerce' ), //Sort by average rating
		'date'       => __( 'по новинкам', 'woocommerce' ), //Sort by newness
		'price'      => __( 'по возрастанию', 'woocommerce' ), //Sort by price: low to high
		'price-desc' => __( 'по убыванию', 'woocommerce' )  //Sort by price: high to low
	) );

	if ( ! $show_default_orderby ) {
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
		unset( $catalog_orderby_options['rating'] );
	}
	wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
}
add_action( 'woocommerce_catalog_ordering', 'woocommerce_catalog_ordering' );

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'storefront_after_content' ) ) {
	function storefront_after_content() {
		?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
		<?php
	}
}

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */
function storefront_loop_columns() {
	return apply_filters( 'storefront_loop_columns', 3 ); // 3 products per row
}

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes
 * @return array $classes modified to include 'woocommerce-active' class
 */
function storefront_woocommerce_body_class( $classes ) {
	if ( is_woocommerce_activated() ) {
		$classes[] = 'woocommerce-active';
	}

	return $classes;
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
	function storefront_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		storefront_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * WooCommerce specific scripts & stylesheets
 * @since 1.0.0
 */
function storefront_woocommerce_scripts() {
	global $storefront_version;
	// TODO: Удалил woocommerce css стили
	//wp_enqueue_style( 'storefront-woocommerce-style', get_template_directory_uri() . '/inc/woocommerce/css/woocommerce.css', $storefront_version );
	//wp_style_add_data( 'storefront-woocommerce-style', 'rtl', 'replace' );
}

/**
 * Related Products Args
 * @param  array $args related products args
 * @since 1.0.0
 * @return  array $args related products args
 */
function storefront_related_products_args( $args ) {
	$args = apply_filters( 'storefront_related_products_args', array(
		'posts_per_page' => 3,
		'columns'        => 3,
	) );

	return $args;
}

/**
 * Product gallery thumnail columns
 * @return integer number of columns
 * @since  1.0.0
 */
function storefront_thumbnail_columns() {
	return intval( apply_filters( 'storefront_product_thumbnail_columns', 4 ) );
}

/**
 * Products per page
 * @return integer number of products
 * @since  1.0.0
 */
function storefront_products_per_page() {
	return intval( apply_filters( 'storefront_products_per_page', 12 ) );
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension = 'WC_Bookings' ) {
	return class_exists( $extension ) ? true : false;
}