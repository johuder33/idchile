<?php
get_header();
?>

<section class="banner">
	<div class="wrap-static-slide">
	</div>
	<div class="line_bottom"></div>
</section>

<div class="container">
	<div class="row all-products-block">
	
		<section class="controls-filters clearfix">
			<div class="col-xs-6 clearfix">
				<div class="pull-left">
					<h3>Categoria: </h3>
					<ul class="list-inline ul-inline">
						<li>
							<a href="!#">Impresoras</a>
						</li><!--
						--><li>
							<a href="!#">Accesorios</a>
						</li><!--
						--><li>
							<a href="!#">Consumibles</a>
						</li>
					</ul>

					<div class="controls">
						<div class="form-group wrap-form">
					    <label for="models" class="control-label">Modelos:</label>
					    <div class="wrap-select">
					      <select name="models" id="models" class="form-control">
									<option value="1">Modelo Uno</option>
									<option value="2">Modelo Dos</option>
									<option value="3">Modelo Tres</option>
								</select>
					    </div>
					  </div>

					  <div class="form-group wrap-form">
					    <label for="brands" class="control-label">Marcas:</label>
					    <div class="wrap-select">
					      <select name="brands" id="brands" class="form-control">
									<option value="1">Marca Uno</option>
									<option value="2">Marca Dos</option>
									<option value="3">Marca Tres</option>
								</select>
					    </div>
					  </div>

					</div>
				</div>
			</div>

			<div class="col-xs-6 clearfix">
				<div class="pull-right">
					<h3>Filtrar: </h3>
					<ul class="list-inline ul-inline">
						<li>
							<a href="!#">Mayor precio</a>
						</li><!--
						--><li>
							<a href="!#">Menor precio</a>
						</li>
					</ul>

					<div class="control-button">
						<button class="btn btn-sm-btn-default custom-btn" id="comparer">
							comparar productos
						</button>
					</div>
				</div>
			</div>
		</section>

		<section class="wrap_products">
				<?php
				$i = 1;
				while($i < 17){
					if(($i == 1)){
						echo "<div class='wrap-group-products'>";
					}
					?>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<article class="product-box" data-id="<?php print $i; ?>">
						<figure>
							<img src="<?php bloginfo('template_url'); ?>/assets/images/product.png" alt="Producto" title="Producto" class="img-responsive">
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

						<span class="glyphicon glyphicon-ok icon"></span>
					</article>
				</div>
					<?php
					if(($i % 4 == 0)){
						echo "</div><div class='wrap-group-products'>";
					}
					$i++;
				}
				?>
		</section>
	</div>
</div>


<?php
get_footer();
?>