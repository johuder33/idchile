<?php
get_header();
?>

<section class="banner">
	<div class="wrap-static-slide">
	</div>
	<div class="line_bottom"></div>
</section>

<div class="container">

<section class="row single-product-block">
	<div class="wrap_products clearfix">
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
			<article class="product-box product-elastic-box">
				<figure>
					<img src="<?php bloginfo('template_url'); ?>/assets/images/product.png" alt="Producto" title="Producto" class="img-responsive center-block">
					<figcaption class="figcaption">
						<h2>Sed Ut Perspiciatis</h2>
						<span class="price">$680.00</span>
					</figcaption>
				</figure>

				<div class="controls-box">
					<div class="view">
						<a href="!#">Ver Más</a>
					</div>

					<div class="subControls">
						<div class="heart"></div>
						<div class="save"></div>
					</div>
				</div>
			</article>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-push-1 col-md-push-1">
			<?php //do_action( 'woocommerce_single_product_summary' ); ?>
			<div class="list-attr-item">
				<div class="attr-item title-attr">
					<h1>Modelo: AT-145</h1>
					<span class="hr-border"></span>
				</div>

				<div class="attr-item info-attr">
					<article class="state">
						<span>Disponibilidad:</span> <span class="stock">In Stock</span>
					</article>

					<article class="description-product">
						<div>DESCRIPCIÓN DEL PRODUCTO</div>
						<div class="paragraph-product text-justify">
							<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>
						</div>
					</article>
				</div>

				<div class="attr-item brand-attr">
					<article class="optionBuy">
						<div>OPCIONES DE COMPRA:</div>

						<div class="brand-tag">
							<span class="text-line">Marca*</span>
							<article class="features">
								<span class="text-line">HID</span>
							</article>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	get_template_part('brands');
?>

</div>


<?php
get_footer();
?>