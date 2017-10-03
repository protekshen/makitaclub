<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="product-tabs">
		<ul class="tabs"  data-tabs  id="makita-produc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<?php if( $key == 'additional_information') { ?>
					<li class="tabs-title  is-active  small-12  medium-4  text-center <?php echo esc_attr( $key ); ?>_tab">
						<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( 'Характеристики' ), $key ); ?></a>
					</li>
				<?php } ?>
			<?php endforeach; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>	
				<?php if( $key == 'description') { ?>
					<li class="tabs-title  small-12  medium-4  text-center  <?php echo esc_attr( $key ); ?>_tab">
						<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
				<?php } ?>
			<?php endforeach; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>	
				<?php if( $key == 'dokumentatsiya') { ?>
					<li class="tabs-title  small-12  medium-4  text-center  <?php echo esc_attr( $key ); ?>_tab">
						<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
				<?php } ?>
			<?php endforeach; ?>
			<!-- if( $key == 'komplektatsiya') -->
        </ul>
        
        <div class="tabs-content" data-tabs-content="makita-produc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tabs-panel   <?php if( $key == 'additional_information') { echo 'is-active  product-tabs__options'; };?>      "  id="tab-<?php echo esc_attr( $key ); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>	
            <?php endforeach; ?>
        </div>
	</div>

<?php endif; ?>
