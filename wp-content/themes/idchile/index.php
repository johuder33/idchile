<?php
get_header();
?>

<section class="banner">
	<div class="wrap-sliders">
	</div>
	<div class="line_bottom"></div>
</section>

<div class="container">
	<section class="nosotros_block">
		<div class="row flex">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 picture">
				<figure>
					<img src="<?php bloginfo('template_url'); ?>/assets/images/nosotros.png" alt="Quienes Somos" title="Quienes Somos" class="img-responsive">
				</figure>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 info_company">
				<div class="">
					<h3 class="title_company">Nombre de la Empresa</h3>
					<h3 class="title_company">Nosotros</h3>

					<article class="text-justify">
						<p>somos una nueva compañia de producción en medios de comunicación que se especializa en la creación de conceptos para la industria aeronáutica con énfasis en la industria de la aviación y las herramientas para identificación</p>

						<p>nuestro objetivo es crear conceptos que son una declaración sobre el valor, la identidad, el propósito y la misión de su organización. Nuestro principal objetivo es articular la personalidad y los valores cualitativos de su marca.</p>
					</article>
				</div>
			</div>
		</div>
	</section>

<section class="servicios_block">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			<h1 class="title_company">servicios</h1>
			<div class="text-box center-block">
				<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500</p>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio1.png" alt="Servicios" title="Servicios" class="img-responsive pull-right">
			</figure>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio2.png" alt="Servicios" title="Servicios" class="img-responsive center-block">
			</figure>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<figure class="clearfix column-service">
				<img src="<?php bloginfo('template_url'); ?>/assets/images/servicio3.png" alt="Servicios" title="Servicios" class="img-responsive pull-left">
			</figure>
		</div>
	</div>
</section>

</div>


<?php
get_footer();
?>