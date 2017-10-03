<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

echo '<div>';
if($product->is_purchasable() && $product->is_in_stock() ) {
	echo '<div class="quantity"><input type="number" value="1" title="Кол-во" class="quantity_to_cart qty text form-control effect-form" size="4"></div>';
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf(
		$product->is_purchasable() && $product->is_in_stock() ? '<button href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</button>' : 
			'<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		$product->add_to_cart_text()
	), $product );
echo '</div>';

