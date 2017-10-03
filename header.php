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
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?>>

<div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
  <!-- Your menu or Off-canvas content goes here -->

	<!-- Close button -->
    <button class="close-button" aria-label="Close menu" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>

</div>

<div id="page" class="off-canvas-content"  data-off-canvas-content>
	<?php
	do_action( 'storefront_before_header' ); ?>



	<header id="masthead"  class="header"  role="banner" <?php if ( get_header_image() != '' ) { echo 'style="background-image: url(' . esc_url( get_header_image() ) . ');"'; } ?>>
	
		<div class="row  header-menu">

			<div class="show-for-small-only  column  small-2">
				<button class="show-for-small-only" type="button" data-open="offCanvasLeft">
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
				<a class="phone  float-right" href="tel:+74952475525">8-495-247-55-25</a>
			</div>

			<div class="columns  medium-9  hide-for-small-only">
				<div class="logo">
					<a href="/">
						<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" 
							alt="Makita-Club - эллектроинструмент высокого качества, по низкимценам" .
							title="Makita-Club - эллектроинструмент высокого качества, по низкимценам" 
						/>
					</a>
				</div>

				<?php storefront_primary_navigation();?>
			</div>

			<div class="columns  small-12  medium-3"><?php storefront_product_search();?></div>

				

		</div>
		
		

	</header>

	<div class="row">
		<div class="columns"> 
			<div class="breadcrumb-block">  
				<div class="column  large-9">
					<?php do_action( 'custom_breadcrumb' );	?>
				</div>
				<div class="login  column  large-3  text-right">
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



		