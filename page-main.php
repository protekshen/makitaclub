<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>
	<div class="row">
		<div class="columns  large-3">

			<div class="products-cart  hide-for-small-only">	
				<div><?php storefront_header_cart(); ?></div>
			</div>
			
			<?php do_action( 'storefront_sidebar' ); ?>
		</div>
		<div class="columns  large-9">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<header class="entry-header">
					<h1 class="entry-title" itemprop="name">Каталог товаров</h1>
				</header>

				<?php 
					// $parentid = get_queried_object_id();
					$args = array(
						'parent' => 0
					);
						
					$terms = get_terms( 'product_cat', $args );
						
					if ( $terms ) {
								
						echo '<div class="products  subcategories-list  row  small-up-2  medium-up-3  large-up-4">';
							
						foreach ( $terms as $term ) {	
							wc_get_template( 'content-product_cat.php', array(
								'category' => $term
							) );								
						}
							
						echo '</div>';
						
					}
				?>



				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>

	



<?php get_footer(); ?>
