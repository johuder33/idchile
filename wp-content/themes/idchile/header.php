<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php print wp_title('|'); ?></title>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body>
	<div class="container ">
		<nav class="nav-menu clearfix">
			<ul class="list-inline custom-inline">
				<li>
					<a href="#nosotros-section" class="permalink">Nosotros</a>
				</li>
				<li>
					<a href="#servicios-section" class="permalink">Servicios</a>
				</li>
				<li>
					<a href="#productos-section" class="permalink">Productos</a>
				</li>
				<li>
					<a href="#marcas-section" class="permalink">Marcas</a>
				</li>
				<li>
					<a href="#contacto-section" class="permalink">Contacto</a>
				</li>

				<li>
					<div class="wrap-search">
						<input type="text" class="search_input">

						<span class="pull">
							<span class="glyphicon glyphicon-search zoom_search"></span>
						</span>
					</div>
				</li>
			</ul>
		</nav>
	</div>