<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>
<div class="woocommerce-billing-fields">
	
	
<?php $mybillingfields=array(
    "billing_first_name",
	"billing_phone",
    "billing_email"
    
);
foreach ($mybillingfields as $key) : ?>
	<?php woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) ); ?>
<?php endforeach; ?>



<label>Способ получения товара</label>
<?php wc_cart_totals_shipping_html(); ?>


<?php $mybillingfields=array(
	"billing_pos",
    "billing_address_1"
); 
foreach ($mybillingfields as $key) : ?>	

	<!-- Msavin доставка и смовывоз
	<?php //if ($key !== 'billing_address_1' & $key !== 'billing_pos') {
		//woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) );
	//} 
	?>--> 

	<?php if ($key == 'billing_address_1') {
		// woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) );
	} 
	?>

<?php endforeach; ?>

<div class="delivery-address">

	<?php foreach ($mybillingfields as $key) : ?>
		<?php 
			woocommerce_form_field( $key, $checkout->checkout_fields['billing'][$key], $checkout->get_value( $key ) );	
		?>
	<?php endforeach; ?>

</div>
	
	

	<!--<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>
		<?php woocommerce_form_field( $key, $field ); ?>
		<?php print_r($key); ?>	
	<?php endforeach; ?>
	-->
	
	
</div>
