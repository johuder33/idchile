<?php

get_header();

get_template_part('banner');

?>

<div class="container">
	<?php

	/**
	 * Here we are going to get the who we are section
	 */

	$args = array(
		'post_type'=>'nosotros',
		'showposts'=>1,
		'order'=>'desc'
	);
		 
	query_posts($args);

	if(have_posts()){
		the_post();
		$hasImageFeatured = has_post_thumbnail();
		$class = $hasImageFeatured ? 'col-md-6 col-lg-6' : 'col-md-12 col-lg-12 only_info_company' ;
		?>
		<section class="nosotros_block" id="nosotros-section">
			<div class="row flex">
				<?php
				if ($hasImageFeatured) {
						$imageId = get_post_thumbnail_id($post->ID);
						$imageFeaturedFromURL = array_shift(wp_get_attachment_image_src($imageId, 'full' ));
					?>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 picture">
						<figure>
							<img src="<?php echo $imageFeaturedFromURL; ?>" alt="Quienes Somos" title="Quienes Somos" class="img-responsive center-block">
						</figure>
					</div>
					<?php
				}
				?>

				<div class="col-xs-12 col-sm-12 <?php echo $class; ?> info_company">
					<div>
						<h3 class="title_company"><?php the_title(); ?></h3>
						<h3 class="title_company">Nosotros</h3>

						<article class="text-justify">
							<?php the_content(); ?>
						</article>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	?>

<?php

/**
 * Here we are going to put all information about services that we serve.
 */

	$args = array(
		'post_type'=>'servicios',
		'showposts'=>1,
		'order'=>'desc'
	);

	query_posts($args);

	if(have_posts()){
			the_post();
		?>

<section class="servicios_block" id="servicios-section">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<h1 class="title_company"><?php the_title(); ?></h1>
			<div class="text-box center-block">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

	<div class="row text-center">
		<div class="box-service">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio1.png" alt="Servicios" title="Servicios" class="img-responsive">
				<span class="rotateHoverAnimation"></span>
			</figure>

			<article class="text-service">
				<h2>Servicio de Impresión</h2>
				<div class="info-box text-center">
					<p>Encuentra información sobre viajes y paseos a lugares de interés, hospedajes, transporte.</p>
				</div>
			</article>
		</div>

		<div class="box-service">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio2.png" alt="Servicios" title="Servicios" class="img-responsive center-block">
				<span class="rotateHoverAnimation"></span>
			</figure>
			<article class="text-service">
				<h2>Personalizacion de ID</h2>
				<div class="info-box text-center">
					<p>Encuentra información sobre viajes y paseos a lugares de interés, hospedajes, transporte.</p>
				</div>
			</article>
		</div>

		<div class="box-service">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio3.png" alt="Servicios" title="Servicios" class="img-responsive">
				<span class="rotateHoverAnimation"></span>
			</figure>
			<article class="text-service">
				<h2>Soporte Técnico</h2>
				<div class="info-box text-center">
					<p>Encuentra información sobre viajes y paseos a lugares de interés, hospedajes, transporte.</p>
				</div>
			</article>
		</div>
	</div>
</section>

		<?php
	}

?>

<article class="row">
	<?php do_action( 'getFeaturedProducts'); ?>
</article>

<section class="productos_block" id="productos-section">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 box-title text-left">
			<h2>Producto destacados</h2>
		</div>

		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 box-title text-right">
			<div class="hidden-xs">
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
			</div>

			<div class="dropdown visible-xs">
			  <button class="btn btn-default dropdown-category dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			  	Categoria
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu ul-submenu" aria-labelledby="dropdownMenu1">
			    <li><a href="#!"><strong>Categoria</strong></a></li>
			    <li role="separator" class="divider"></li>
			    <li><a href="#">Impresoras</a></li>
			    <li><a href="#">Accesorios</a></li>
			    <li><a href="#">Consumibles</a></li>
			  </ul>
			</div>
		</div>
	</div>

	<div class="row">
		<section class="wrap_products">
				<?php

				$i = 0;

				while($i < 4){
				?>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<article class="product-box center-block">
						<figure>
							<img src="<?php bloginfo('template_url'); ?>/assets/images/product.png" alt="Producto" title="Producto" class="img-responsive">
						</figure>

						<div class="controls-box">
							<div class="view">
								<a href="!#">Ver Más</a>
							</div>

							<div class="subControls">
								<div class="heart">
									<i class="glyphicon glyphicon-heart-empty"></i>
								</div>
								<div class="save">
									<i class="fa fa-share-square-o"></i>
								</div>
							</div>
						</div>
					</article>
				</div>
				<?php	
				$i++;
				}

				?>
		</section>
	</div>
</section>

<?php
	get_template_part('brands');
?>

</div>


<?php
get_footer();
?>