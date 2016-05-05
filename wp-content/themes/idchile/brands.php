<?php

/**
 * Here we are going to put all information about Our Brands
 */

	$args = array(
		'post_type'=>'marcas',
		'showposts'=>1,
		'order'=>'desc'
	);

	query_posts($args);

	if(have_posts()) {
			the_post();
			$brands = rwmb_meta('carousel_brands', 'image');
		?>
		<section class="brands-block clearfix" id="marcas-section">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row title-brand">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>

				<div class="row title-brand">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
						<article class="brand-info">
							<?php the_content(); ?>
						</article>
					</div>
				</div>
			</div>

			<?php
			if (sizeof($brands)) {
				?>
				<section class="wrap-carousel col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="swiper-container">
					  <!-- Additional required wrapper -->
						<div class="swiper-wrapper">
				<?php
				foreach($brands as $brand => $image) {
					$title = !empty($image['title']) ? $image['title'] : 'Logo de la marca';
					$url = $image['full_url'];
					?>
			        <!-- Slides -->
			        <div class="swiper-slide">
			        	<img src="<?php echo $url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" class="img-responsive center-block">
			        </div>
					<?php
				}
				?>
				    </div>
						    
						    <!-- If we need navigation buttons -->
						    <i class="icon-prev glyphicon glyphicon-triangle-left"></i>
						    <i class="icon-next glyphicon glyphicon-triangle-right"></i>
						</div>
					</section>
				<?php
			}
			?>
		</section>
		<?php
	}
?>