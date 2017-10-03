<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div class="input-group">
		<i class="fa fa-search" aria-hidden="true"></i>
		<input type="search" class="search form-control" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
		<span class="input-group-btn">
        	<input type="submit"class="button"  value="<?php echo esc_attr_x( 'Найти', 'submit button', 'woocommerce' ); ?>" />
      	</span>
	</div>	
	<input type="hidden" name="post_type" value="product" />
</form>
