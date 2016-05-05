<form method="get" action="<?php echo home_url('/'); ?>">
	<div class="wrap-search">
		<input type="search" class="search_input" value="<?php echo get_search_query(); ?>" name="s">
		<input type="hidden" name="post_type" value="product" />

		<span class="pull">
			<span class="glyphicon glyphicon-search zoom_search"></span>
		</span>
	</div>
</form>