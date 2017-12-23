<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="product-page">
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 itemprop="name" class="title"><?php the_title(); ?></h1>
	
		
    <div class="row">
		<div class="medium-4 columns">			
			<?php
				if ( current_user_can('activate_plugins') ) {
					$custom_fields = get_post_custom($post->ID);
					$my_custom_field = $custom_fields['b2b_code'];
						foreach ( $my_custom_field as $key => $value )
						echo '<a class="shipment-product" href="http://b2b.makita-online.ru/shippings/'.$value.'?priceType=RETAIL_CUSTOM" target="_blank">Показать отгрузки</a>';
				}
			?>
			<?php
				add_action('custom_woocommerce_show_product_images','woocommerce_show_product_images', 1);
				do_action('custom_woocommerce_show_product_images');
			?>

			
			<?php do_action( 'woocommerce_product_thumbnails_columns' ); ?>
		</div>
		
		<div class="medium-8 columns">

			<?php do_action('shop_messages'); ?>

			<div class="columns  product-page__price">
				<div class="row">
					<div class="column medium-6">
						<div class="product-sale">
							<?php
								// add_action('km_woocommerce_show_product_sale_flash','woocommerce_show_product_sale_flash', 10);
								// do_action('km_woocommerce_show_product_sale_flash');
							?>
							<div class="sku_wrapper">
								<span class="sku" itemprop="sku"><?php _e( 'SKU:', 'woocommerce' ); ?> <?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>
							</div>
						</div>
					</div>

					<div class="column medium-6">
						<div class="float-right">
							<?php
								if ($product->price == 0 && $product->is_in_stock() == 1) {
									echo "<div style='position: relative;' class='product__wr-button'>";
										echo "<div class='product-more'>Товар временно отсутствует</div>";
									echo "</div>";
								} else {
									add_action('custom_template_single_add_to_cart','woocommerce_template_single_add_to_cart', 10);
									do_action('custom_template_single_add_to_cart');
								}				
							?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column">
						<div>
							<?php if ( ! defined( 'ABSPATH' ) ) {
								exit; // Exit if accessed directly
							}
							global $product;
							?>

							<?php if ( $product->get_price() ) : ?>

							<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<p class="price"><?php echo $product->get_price_html(); ?></p>
								
								<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
								<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
								<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
							</div>

							<?php endif; ?>
						</div>
					</div>
				</div>

			</div>




			<div class="column  short-description">
				<?php
					add_action('km_template_short_description','woocommerce_template_single_excerpt', 10);
					do_action('km_template_short_description');
				?>
			</div>

		</div>
		
	</div>

	<div class="row columns">
		<?php
				$tabs = apply_filters( 'woocommerce_product_tabs', array() );
				if ( ! empty( $tabs ) ) {
					foreach ( $tabs as $key => $tab ) :
						if ($key == 'komplektatsiya') {
							echo '<div class="complectation  makita-border ">';
							echo '<p><strong>Комплектация:</strong></p>';
							echo '<div>';
								call_user_func( $tab['callback'], $key, $tab );
							echo '</div>';
						}
					endforeach;
				}
			?>
	</div>

	<div class="product-tabs">
		<div class="row columns">
			<?php
				add_action('output_product_data_tabs','woocommerce_output_product_data_tabs', 10);
				do_action('output_product_data_tabs');
			?>
		</div><!--row columns-->
	</div><!--product-tabs-->

	
	<div class="related-products">
		<?php
			// add_action('km_related_products','woocommerce_output_related_products', 10);
			// do_action('km_related_products');
		?>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
