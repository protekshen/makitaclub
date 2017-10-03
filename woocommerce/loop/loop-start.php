<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>

<?php 

    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $display_type = get_woocommerce_term_meta($cat->term_id, 'display_type', true);
    //print_r($display_type); // products // subcategories

    if ($display_type == 'subcategories' || $display_type == '') {
        echo '<ul class="products  subcategories-list  row  small-up-2  medium-up-3  large-up-4">';
    } else {
        echo '<ul class="products  products-list">';
    }

?>