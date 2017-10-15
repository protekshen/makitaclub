<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package storefront
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	
	<?php
		$category_id = get_product_category_by_slug('katalog-osnastky');
		$args_acs = array(
			'taxonomy'  => 'product_cat',
			'child_of'  => $category_id,
			'title_li' => ''
		);
		
		echo '<ul id="accessories" class="vertical menu accordion-menu  woocommerce widget_product_categories" data-accordion-menu><li>';
		echo '<a href="#">Каталог оснастки</a>';
		echo '<ul style="display:none;" class="menu  vertical  nested  product-categories  collapse">';
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

		
		echo '<ul id="tools" class="show-for-medium  vertical menu accordion-menu  woocommerce widget_product_categories" data-accordion-menu><li>';
		echo '<a href="#">Каталог инструментов</a>';
		echo '<ul style="display:none;"  class="is-active  menu  vertical  nested  product-categories  collapse">';
			wp_list_categories($args_tools);
		echo '</ul>';
		echo '</li></ul>';

		echo '<ul id="tools" class="show-for-small-only  vertical menu accordion-menu  woocommerce widget_product_categories" data-accordion-menu><li>';
		echo '<a href="#">Каталог инструментов</a>';
		echo '<ul style="display:none;"  class="menu  vertical  nested  product-categories  collapse">';
			wp_list_categories($args_tools);
		echo '</ul>';
		echo '</li></ul>';
		
	?>

	<?php // dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary sidebar.php test-->
