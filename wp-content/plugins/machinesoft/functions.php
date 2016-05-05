<?php

/**
 * @version 1.0
 */
/*
  Plugin Name: MachineSoft Functions
  Plugin URI: http://www.machinesoft.com.ve
  Description: Funciones generales.
  Author: Johuder Gonzalez
  Version: 1.0
 */

/**
 * Muestra el metabox de imagen destacada en todos los post
 */
add_theme_support('post-thumbnails');


/** Muestra el contenido de una variable para depurar y, opcionalmente, detiene la ejecucion del script. <br/>
 * @param mixed $var Variable a depurar.
 * @param bool $stop Si es verdadero detiene la ejecución del script.
 */
function debug($var, $stop = true) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	if ($stop)
		exit;
}

/**
 * Genera un arbol de categorias
 * @param object $cat Objeto con los datos de la categoria
 * @return string
 *
 * uso tree_constructor(get_categories(array('parent' => get_category_by_slug('productos')->term_id)));
 */
function tree_constructor($cat) {
	$tree = '<ul>';
	if (!empty($cat)) {
		foreach ($cat as $detail) {
			$childs = get_categories(array('parent' => $detail->term_id));
			$tree .= '<li><a href="' . get_category_link($detail->term_id) . '"><span></span>' . $detail->name . '</a>';
			if (!empty($childs)) {
				$tree .= tree_constructor($childs);
			}
			$tree .= '</li>';
		}
	}
	$tree .= '</ul>';
	return $tree;
}

add_action('login_head', 'custom_login_logo');

function custom_login_logo() {
	$path = explode('/', get_bloginfo('template_directory'));
	$path[] = 'images';
	$ruta = ABSPATH . implode('/', array_slice($path, count($path) - 4)) . '/';
	
	if (!(file_exists($ruta . 'login_logo.png'))) {

		if (!is_dir($ruta))
			mkdir($ruta, 0777, true);

		$is_copied = @copy(dirname(__FILE__) . '/logo.png', $ruta . 'login_logo.png');

		if (!$is_copied) {
			$source = file_get_contents(dirname(__FILE__) . '/logo.png');
			$destiny = @fopen('logo.png', 'w');
			@fwrite($destiny, $source);
			@fclose($destiny);
		}
	}
	echo '<style type="text/css">h1 a { background:url(' . get_bloginfo('template_directory') . '/images/login_logo.png) no-repeat center center !important; width:100% !important; background-size:100% 100%; }</style>';
}

add_filter('admin_footer_text', 'left_admin_footer_text_output');

function left_admin_footer_text_output($text) {
	$text = get_bloginfo();
	return $text;
}

add_filter('update_footer', 'right_admin_footer_text_output', 11);

function right_admin_footer_text_output($text) {
	$text = 'Web Desarrollada por <a href="http://www.machinesoft.com.ve" target="_blank">MachineSoft.com.ve</a>';
	return $text;
}

function the_excerpt_max_charlength($charlength, $pad = '[...]') {
	$excerpt = get_the_excerpt();
	$charlength++;

	if (strlen($excerpt) > $charlength) {
		$subex = substr($excerpt, 0, $charlength - 5);
		$exwords = explode(' ', $subex);
		$excut = - ( strlen($exwords[count($exwords) - 1]) );
		if ($excut < 0) {
			echo substr($subex, 0, $excut);
		} else {
			echo $subex;
		}
		echo $pad;
	} else {
		echo $excerpt;
	}
}

function max_charlength($text, $charlength, $pad = '[...]', $strict = false) {
	$text = strip_tags($text);
	if (mb_strlen($text) > $charlength) {
		$subex = mb_substr($text, 0, $charlength - mb_strlen($pad));

		if ($strict) {
			$charlength++;
			$result = $subex;
		} else {

			$exwords = explode(' ', $subex);
			$excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
			if ($excut < 0) {
				$result = mb_substr($subex, 0, $excut);
			} else {
				$result = $subex;
			}
		}
		$result .= $pad;
	} else {
		$result = $text;
	}
	return $result;
}

$post_types = array();
/**
 * Atributos comunes del post_type noticias
 */
define('POST_TYPE_NOTICIA', 1);
$post_types[POST_TYPE_NOTICIA] = array(
		'type' => 'noticia',
		'genero' => 'f');

/**
 * Atributos comunes del post_type galerías
 */
define('POST_TYPE_GALERIA', 2);
$post_types[POST_TYPE_GALERIA] = array(
		'type' => 'galeria',
		'singular' => 'galer&iacute;a',
		'genero' => 'f',
		'supports' => array('title', 'thumbnail'));

/**
 * Atributos comunes del post_type banners
 */
define('POST_TYPE_BANNER', 3);
$post_types[POST_TYPE_BANNER] = array(
		'type' => 'banners',
		'singular' => 'banner',
		'supports' => array('title', 'thumbnail'));

/**
 * Atributos comunes del post_type servicios
 */
define('POST_TYPE_SERVICIO', 4);
$post_types[POST_TYPE_SERVICIO] = array(
		'type' => 'servicios',
		'singular' => 'servicio');

/**
 * Agrega un post_type
 * documentacion de los parametros
 * http://codex.wordpress.org/Function_Reference/register_post_type
 * @param type $params
 * @return string
 */
function add_custom_post_type($params, $icon = 'admin-post', $generic = false) {

	//debug($params);

	if (is_int($params)) {
		global $post_types;
		$params = $post_types[$params];
	}

	if (!is_array($params)) {
		$params = array('type' => $params);
	}

	if ($generic) {
		$params = array_merge($params, array('singular' => 'publicaci&oacute;n',
				'plural' => 'publicaciones',
				'genero' => 'f',
				'supports' => array('title', 'editor', 'thumbnail')));
	}

	$type = $params['type'];
	$singular = (@$params['singular']) ? $params['singular'] : $type;
	$plural = (@$params['plural']) ? $params['plural'] : $singular . 's';
	$genero = (@$params['genero']) ? $params['genero'] : 'm';
	$supports = (@$params['supports']) ? $params['supports'] : array('title', 'editor', 'thumbnail');
	$menu_name = (@$params['menu_name']) ? $params['menu_name'] : ucfirst($plural);

	$labels = array(
			'name' => _x(ucfirst($plural), 'post type general name'),
			'singular_name' => _x(ucfirst($singular), 'post type singular name'),
			'add_new' => _x('A&ntilde;adir ' . (($genero == 'm') ? 'Nuevo' : 'Nueva'), $singular),
			'add_new_item' => 'A&ntilde;adir ' . (($genero == 'm') ? 'Nuevo' : 'Nueva') . ' ' . ucfirst($singular),
			'edit_item' => 'Editar ' . ucfirst($singular),
			'new_item' => (($genero == 'm') ? 'Nuevo' : 'Nueva') . ' ' . ucfirst($singular),
			'all_items' => (($genero == 'm') ? 'Todos los' : 'Todas las') . ' ' . ucfirst($plural),
			'view_item' => 'Ver ' . ucfirst($singular),
			'search_items' => 'Buscar ' . ucfirst($plural),
			'not_found' => 'No se encontaron ' . $plural,
			'not_found_in_trash' => 'No se encontaron ' . $plural . ' en la papelera',
			'parent_item_colon' => '',
			'menu_name' => $menu_name
	);

	$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon' => 'dashicons-'.$icon,
			'supports' => $supports
	);
	register_post_type($params['type'], $args); //muestra la barra de la categoria, debe ser el mismo nombre del archivo php
}

/*

// esto sirve para mostrar las entradas en el dashboard de wordpress, descomentar par ver funcion

function wps_recent_posts_dw() {
?>
   <ol>
     <?php
          global $post;
          $args = array( 'numberposts' => 5 );
          $myposts = get_posts( $args );
                foreach( $myposts as $post ) :  setup_postdata($post); ?>
                    <li> (<? the_date('Y / n / d'); ?>) <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endforeach; ?>
   </ol>
<?php
}
function add_wps_recent_posts_dw() {
       wp_add_dashboard_widget( 'wps_recent_posts_dw', __( 'Recent Posts' ), 'wps_recent_posts_dw' );
}
add_action('wp_dashboard_setup', 'add_wps_recent_posts_dw' );

*/

function my_admin_title($admin_title, $title) {
	return get_bloginfo('name') . ' &#8212; ' . $title;
}

add_filter('admin_title', 'my_admin_title', 10, 2);

/**
 * Agrega una taxonomia
 */
function add_custom_taxonomy($params) {
	if (!is_array($params)) {
		$params = array('name' => $params);
	}
	$name = $params['name'];
	$singular = ($params['singular']) ? $params['singular'] : $name;
	$plural = ($params['plural']) ? $params['plural'] : $singular . 's';
	$genero = ($params['genero']) ? $params['genero'] : 'm';
	$menu_name = ($params['menu_name']) ? $params['menu_name'] : ucfirst($plural);

	$labels = array(
			'name' => _x(ucfirst($plural), 'taxonomy general name'),
			'singular_name' => _x(ucfirst($singular), 'taxonomy singular name'),
			'search_items' => __('Buscar ' . $plural),
			'all_items' => (($genero == 'm') ? 'Todos los' : 'Todas las') . ' ' . ucfirst($plural),
			'parent_item' => __('Parent ' . $singular),
			'parent_item_colon' => __('Parent ' . $singular . ':'),
			'edit_item' => 'Editar ' . ucfirst($singular),
			'update_item' => 'Actualizar ' . $singular,
			'add_new_item' => (($genero == 'm') ? 'Nuevo' : 'Nueva') . ' ' . ucfirst($singular),
			'new_item_name' => (($genero == 'm') ? 'Nuevo' : 'Nueva') . ' ' . ucfirst($singular),
			'menu_name' => $menu_name
	);


	if (isset($params['post_type']) && !is_array($params['post_type'])) {
		$post_type = array($params['post_type']);
	} elseif (isset($params['post_type']) && is_array($params['post_type'])) {
		$post_type = $params['post_type'];
	} else {
		$post_type = 'post';
	}

	$hierarchical = ($params['hierarchical']) ? $params['hierarchical'] : false;

	register_taxonomy($name, $post_type, array(
			'hierarchical' => $hierarchical,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => $name),
	));
}

function cd_post_meta($params) {
	echo cd_get_post_meta($params);
}

function cd_get_post_meta($params) {

	if (!is_array($params)) {
		$params = array('meta' => $params);
	}

	if (!@$params['post_id']) {
		$params['post_id'] = get_the_ID();
	}

	if (!isset($params['single'])) {
		$params['single'] = true;
	}

	$post_meta = get_post_meta($params['post_id'], $params['meta'], $params['single']);

	if ((bool) !$params['single']) {
		return $post_meta;
	}

	if (!isset($params['filter'])) {
		$params['filter'] = true;
	}

	return ((bool) $params['filter']) ? apply_filters('content', $post_meta) : $post_meta;
}

//Redes Sociales Panel
function add_twitter_contactmethod($contactmethods) {
	// Add
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['youtube'] = 'Youtube';
	$contactmethods['skype'] = 'Skype';
	$contactmethods['linkedin'] = 'Linkedin';
	$contactmethods['google_plus'] = 'Google+';
	$contactmethods['pinterest'] = 'Pinterest';
	// Remove
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);

	return $contactmethods;
}

add_filter('user_contactmethods', 'add_twitter_contactmethod', 10, 1);

//Youtube
function youtube($url) {

	$tube = parse_url($url);
	if ($tube["path"] == "/watch") {

		parse_str($tube["query"], $query);

		$id = $query['v'];
	} else {
		$id = "";
	}
	return $id;
}

function mes($vard) {

	switch ($vard) {

		case 1:
			echo "Enero";
			break;
		case 2:
			echo "Febrero";
			break;
		case 3:
			echo "Marzo";
			break;
		case 4:
			echo "Abril";
			break;
		case 5:
			echo "Mayo";
			break;
		case 6:
			echo"Junio";
			break;
		case 7:
			echo "Julio";
			break;
		case 8:
			echo "Agosto";
			break;
		case 9:
			echo "Septiembre";
			break;
		case 10 :
			echo"Octubre";
			break;
		case 11:
			echo"Noviembre";
			break;
		case 12:
			echo "Diciembre";
			break;
	}
}

function dia_S($dia) {

	switch ($dia) {

		case Monday:
			echo "Lunes";
			break;
		case Tuesday:
			echo "Martes";
			break;
		case Wednesday:
			echo "Miercoles";
			break;
		case Thursday:
			echo "Jueves";
			break;
		case Friday:
			echo "Viernes";
			break;
		case Saturday:
			echo"Sabado";
			break;
		case Sunday:
			echo "Domingo";
			break;
	}
}

add_shortcode('cd_logout', 'cd_logout_shortcode');

function cd_logout_shortcode() {
	wp_logout();
	echo '<script type="text/javascript">window.location = "' . get_bloginfo('home') . '";</script>';
}

function cd_login_check() {

	global $cd_login_result;

	if (is_user_logged_in()) {

	} else {
		if (!empty($_POST['cd_user_login']) && !empty($_POST['cd_user_pass'])) {

			$credentials = array();
			$credentials['user_login'] = $_POST['cd_user_login'];
			$credentials['user_password'] = $_POST['cd_user_pass'];
			$user = wp_signon($credentials);
			if (is_wp_error($user)) {
				$cd_login_result = 'Usuario y/o contraseña incorrecta';
			} else {
				echo '<script type="text/javascript">window.location = ".";</script>';
			}
		}
	}
}

add_action('init', 'cd_login_check');

function cd_user_create_shortcode() {
	if (!is_user_logged_in() && !empty($_POST['cd_new_user_name']) && !empty($_POST['cd_new_user_pass']) && !empty($_POST['cd_new_user_email'])) {

		$userdata = array(
				'first_name' => $_POST['cd_new_user_name'],
				'user_pass' => $_POST['cd_new_user_pass'],
				'user_email' => $_POST['cd_new_user_email'],
				'user_login' => $_POST['cd_new_user_email'],
				'role' => 'suscriptor'
		);
		$user_id = wp_insert_user($userdata);
	}
	echo '<script type="text/javascript">window.location = "' . home_url() . '";</script>';
}

add_shortcode('cd_user_create', 'cd_user_create_shortcode');
//add_action('init', 'cd_user_create');

function split_content() {
	global $more;
	$more = true;
	$content = preg_split('/<span id="more-\d+"><\/span>/i', get_the_content('more'));
	for ($c = 0, $csize = count($content); $c < $csize; $c++) {
		$content[$c] = apply_filters('the_content', $content[$c]);
	}
	return $content;
}