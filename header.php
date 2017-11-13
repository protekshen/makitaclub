<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php storefront_html_tag_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<meta name="yandex-verification" content="416f073b03dca639" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?>>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45509052 = new Ya.Metrika({
                    id:45509052,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45509052" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div class="off-canvas position-left" id="offCanvasLeft" 
	data-off-canvas
	data-transition="overlap"
	data-content-scroll="false">
    <!-- Your menu or Off-canvas content goes here -->
	<!-- <button class="close-button" aria-label="Close menu" type="button" data-close>
  		<span aria-hidden="true">&times;</span>
	</button> -->
	<div class="search-wrapper"><?php storefront_product_search();?></div>

	<div><?php storefront_header_cart(); ?></div>
	
</div>

<div id="page" class="off-canvas-content" data-off-canvas-content>
	<?php
	do_action( 'storefront_before_header' ); ?>



	<header id="masthead"  class="header"  role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>
	
		<div class="row  header-menu">

			<div class="show-for-small-only  column  small-2">
				<button type="button" class="off-canvas-button" data-toggle="offCanvasLeft">
					<i class="fa fa-bars" aria-hidden="true" style="color: #fff;font-size: 2rem;"></i>
				</button>
			</div>
			<div class="logo  show-for-small-only  column  small-10">
				<a href="/">
					<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" 
						alt="Makita-Club - эллектроинструмент высокого качества, по низкимценам" .
						title="Makita-Club - эллектроинструмент высокого качества, по низкимценам" 
					/>
				</a>
				<a class="phone  float-right" href="tel:+74950000777">8-495-000-07-77</a>
			</div>
			<!-- <div class="show-for-small-only  column  small-12  products-cart-mobile"><?php storefront_header_cart(); ?></div> -->

			<div class="columns  medium-9  hide-for-small-only">
				<div class="logo">
					<a href="/">
						<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" 
							alt="Makita-Club - эллектроинструмент высокого качества, по низкимценам" .
							title="Makita-Club - эллектроинструмент высокого качества, по низкимценам" 
						/>
					</a>
				</div>


				<?php
					$category_id = get_product_category_by_slug('katalog-osnastky');
					$args_acs = array(
						'taxonomy'  => 'product_cat',
						'child_of'  => $category_id,
						'title_li' => ''
					);
					
					// echo '<ul class="vertical menu accordion-menu  woocommerce widget_product_categories" data-accordion-menu><li>';
					echo '<ul class="top-menu  menu   vertical  hover" data-multi-open="false" data-responsive-menu="drilldown medium-accordion"><li>';
					echo '<div><a href="/product-category/katalog-osnastky/">Оснастка</a></div>';
					echo '<ul style="display: none;"  class="menu  vertical">';
						wp_list_categories($args_acs); //Вывод категорий оснастки
					echo '</ul>';
					echo '</li></ul>';
				?>
				<?php
					$args_tools = array(
						'taxonomy'  => 'product_cat',
						'child_of'  => '', // root category
						'title_li' => '', // исключение заголовка
						'exclude'   => 122 // исключение дерева категорий Оснастки
					);
					
					// echo '<ul class="vertical menu accordion-menu  woocommerce widget_product_categories" data-accordion-menu><li>';
					echo '<ul class="top-menu  menu  vertical  hover" data-multi-open="false" data-responsive-menu="drilldown medium-accordion"><li>';
					echo '<div><a href="/">Инструменты</a></div>';
					echo '<ul style="display: none;"  class="menu  vertical">';
						wp_list_categories($args_tools); //Вывод категорий оснастки
					echo '</ul>';
					echo '</li></ul>';
				?>
				<!-- Primary_navigation -->
				<?php storefront_primary_navigation();?>
				<!-- #primary_navigation -->
			</div>

			<div class="columns  small-12  medium-3  hide-for-small-only"><?php storefront_product_search();?></div>

				

		</div>

	</header>

	<div class="row  breadcrumb-wrap">
		<div class="columns"> 
			<?php 
				if (get_page_link() == home_url('/')) {
					$hide = 'hide-for-small-only';
				}
			?>
			<div class="breadcrumb-block  <?php echo $hide; ?>">  
				<div class="column  small-12  large-9">
					<?php do_action( 'custom_breadcrumb' );	?>
				</div>
				<div class="login  column  large-3  text-right  hide-for-small-only">
						<?php
							if ( is_user_logged_in() ) {
								echo '<i class="fa fa-sign-out" aria-hidden="true"></i>';
							} else {
								echo '<i class="fa fa-sign-in" aria-hidden="true"></i>';
							}
						?>
					<?php wp_loginout(); ?> / 
					<?php 
						if ( is_user_logged_in() ) {
							echo '<a href="/my-orders/">Мои заказы</a>';
						} else {
							wp_register(' ' , ' ');
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<?php
	/** <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="container site-content mobile-container" tabindex="-1">



		