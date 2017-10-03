<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header>
	<h2>Общая информация</h2>
</header>
<table class="shop_table shop_table_responsive customer_details table table-bordered">
	<?php if ( $order->billing_phone ) : ?>
		<tr>
			<th><?php _e( 'Telephone:', 'woocommerce' ); ?></th>
			<td><?php echo esc_html( $order->billing_phone ); ?></td>
		</tr>
	<?php endif; ?>
	<?php if ( $order->billing_email ) : ?>
		<tr>
			<th><?php _e( 'Email:', 'woocommerce' ); ?></th>
			<td><?php echo esc_html( $order->billing_email ); ?></td>			
		</tr>
	<?php endif; ?>
	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
	<tr>
		<th>Адрес</th>
		<td>
			<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
		</td>
	</tr>
	<?php endif; ?>	
	<?php if ($pos = get_post_meta( $order->id, '_billing_pos', true )) : ?>
		<?php 
			$posLabel = '';
			switch ($pos) {
				case 'nourth':
					$posLabel = 'Адрес самовывоза 1';
					break;
				case 'sourth':
					$posLabel = 'Адрес самовывоза 2';
					break;				
			}
		?>
		<tr>
			<th>Точка самовывоза</th>
			<td>
				<?php echo $posLabel; ?>
			</td>
		</tr>
	<?php endif; ?>
		
	<?php if ( $order->customer_note ) : ?>	
		<tr>
			<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
			<td><?php echo wptexturize( $order->customer_note ); ?></td>
		</tr>
	<?php endif; ?>
</table>