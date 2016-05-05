<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title><?php print get_bloginfo('name'); print wp_title(' > '); ?></title>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0, user-scalable=no" />
	<?php wp_head(); ?>
</head>
<body>
	<div class="container ">
		<nav class="nav-menu clearfix">
			<ul class="list-inline custom-inline">
				<li>
					<a href="<?php echo apply_filters('getUrl', '#!nosotros-section'); ?>" class="permalink">Nosotros</a>
				</li>
				<li>
					<a href="<?php echo apply_filters('getUrl', '#!servicios-section'); ?>" class="permalink">Servicios</a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/productos" class="permalink">Productos</a>
				</li>
				<li>
					<a href="<?php echo apply_filters('getUrl', '#!marcas-section'); ?>" class="permalink">Marcas</a>
				</li>
				<li>
					<a href="#!contacto-section" class="permalink">Contacto</a>
				</li>

				<?php
					do_action('display_custom_cart');
				?>

				<li>
					<?php get_search_form(); ?>
				</li>
			</ul>
		</nav>
	</div>