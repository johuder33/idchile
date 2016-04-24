<?php

global $product;

?>
<div class="controls-box">
	<div class="view">
		<a href="<?php the_permalink(); ?>">Ver Más</a>
	</div>

	<div class="subControls">
		<div class="heart">
			<i class="glyphicon glyphicon-shopping-cart wcustom-add-to-cart" data-id="<?php echo $product->id; ?>" data-sku="<?php echo $product->get_sku(); ?>" data-qty="1"></i>
		</div>
		<div class="save">
			<i class="glyphicon glyphicon-save-file"></i>
		</div>
	</div>
</div>