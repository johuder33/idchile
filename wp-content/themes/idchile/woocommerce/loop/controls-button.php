<?php

global $product;

$manual = rwmb_meta('manual', 'file');
$hasFile = sizeof($manual);
$hasFileClass = 'noFile';

if ($hasFile) {
	$manual_url = $manual;
	$manual_url = $manual_url['url'];
	$hasFileClass = '';
}

if (!is_product()) {
?>

<div class="controls-box">
	<div class="view">
		<a href="<?php the_permalink(); ?>">Ver Más</a>
	</div>

	<div class="subControls <?php echo $hasFileClass; ?>">
		<div class="heart">
			<i title="Agregar al carrito" class="glyphicon glyphicon-shopping-cart wcustom-add-to-cart icon-item" data-id="<?php echo $product->id; ?>" data-sku="<?php echo $product->get_sku(); ?>" data-qty="1"></i>
		</div>
		<?php
			if ($hasFile) {
				?>
					<div class="save">
						<a href="<?php echo $manual_url; ?>" class="icon-item" target="_blank" download="<?php echo $manual['name']; ?>" title="Descargar Archivo">
							<i class="glyphicon glyphicon-save-file"></i>
						</a>
					</div>
				<?php
			}
		?>
	</div>
</div>

<?php
} else {
	?>

	<div class="controls-box">
		<div class="view <?php echo $hasFileClass; ?>">
			<a href="#!">
				<i class="glyphicon glyphicon-shopping-cart wcustom-add-to-cart" data-id="<?php echo $product->id; ?>" data-sku="<?php echo $product->get_sku(); ?>" data-qty="1"></i>
				Agregar al carrito
			</a>
		</div>

		<?php
		if ($hasFile) {
		?>
			<div class="subControls">
				<div class="save pull-right">
					<a href="<?php echo $manual_url; ?>" class="icon-item" target="_blank" download="<?php echo $manual['name']; ?>" title="Descargar Archivo">
						<i class="glyphicon glyphicon-save-file"></i>
					</a>
				</div>
			</div>
		<?php
		}
		?>
	</div>

	<?php
}

?>