<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

$classes[] = 'product-card  row  column';

?>
<li <?php post_class( $classes ); ?>>
<?php do_action( 'woocommerce_before_shop_loop_item' );?>
	<div class="small-12  medium-2  column  product-card__thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php
				/**
				* woocommerce_before_shop_loop_item_title hook
				*
				* @hooked woocommerce_show_product_loop_sale_flash - 10
				* @hooked woocommerce_template_loop_product_thumbnail - 10
				*/
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>
	</div>

	<div class="small-12  medium-7  column  product-card__title">
		<a href="<?php the_permalink(); ?>">
			<?php
				/**
				* woocommerce_shop_loop_item_title hook
				*
				* @hooked woocommerce_template_loop_product_title - 10
				*/
				do_action( 'woocommerce_shop_loop_item_title' );
			?>
		</a>
	</div>
	
	<div class="small-12  medium-3  column  product-card__order">
			<div class="product-card__order--price">
				<?php				
					/**
					* woocommerce_after_shop_loop_item_title hook
					*
					* @hooked woocommerce_template_loop_rating - 5
					* @hooked woocommerce_template_loop_price - 10
					*/
					//do_action( 'woocommerce_after_shop_loop_item_title' );

					global $product;
					
					$price_html = $product->get_price_html();
					if ($product->price > 0) {
						echo '<span class="price">Цена: ';
						echo $price_html;
						echo '</span>';
					}
				?>
			</div>

			<div class="product-card__order--button <?php if ($product->is_in_stock() == 0) { echo 'not-available'; }?>">
				<?php	
					/**
					* woocommerce_after_shop_loop_item hook
					*
					* @hooked woocommerce_template_loop_add_to_cart - 10
					*/
					//do_action( 'woocommerce_after_shop_loop_item' );

					// OLD STATEMENT wc_get_template( 'loop/add-to-cart.php' , $args );
					// if ($product->price == 0 && $product->is_in_stock() == 1) {
					// 		echo "<div style='position: relative;' class='product__wr-button'>";
					// 			echo "<div class='product-more'>Товар временно отсутствует</div>";
					// 		echo "</div>";
					// } else {
					// 		wc_get_template( 'loop/add-to-cart.php' , $args );
					// }
					
					wc_get_template( 'loop/add-to-cart.php' , $args );

					/*global $product;
					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
						sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->id ),
							esc_attr( $product->get_sku() ),
							esc_attr( isset( $quantity ) ? $quantity : 1 ),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', //add_to_cart_button в function.php 
							esc_attr( $product->product_type ),
							esc_html( $product->add_to_cart_text() )
						),
					$product );*/
				?>
			</div>
	</div>
		

		

	
	
		
	
	
</li>
