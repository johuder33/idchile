<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'idchile');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'XQoz3O~{P}B,0AaT/&#~^|N;Hlfa4PjCHR5OQde+oW3H9-zO{X|[NcbO AozfisI');
define('SECURE_AUTH_KEY', '-}mI.xW&+b[+_({PP7-zFe<rr:(Ml?Kw2%w.$XJjZE8cP#p/ha)sDm*=,m*E|1{-');
define('LOGGED_IN_KEY', '0Nc#f5:J4_ehcZ8tG=Cy.Ni~sRu/U@xHD!OY?ik,h@W6>{un}IUJ~={jqmtkNGlw');
define('NONCE_KEY', '$3,ft*ZU;^pUB8{VVu&oP8}pP1Gk8}o/-EK(K4&nXF0B9Zgey<{+z$3+EF~CE@Kf');
define('AUTH_SALT', 'CB5(V @/a}XOwf/[-L4sV3k}R{51I:fg:1P(~4>lw $dr@oG{n:J@`o=Y~n2?{JE');
define('SECURE_AUTH_SALT', '7ztl{:[Gl?[:pKyfd:{gmhR|8iJ WQGIG~$30!K-8+9`{qwGseg|n>p>-V0i6]%Q');
define('LOGGED_IN_SALT', 'Q0jEt/Rb>r&:-Z02`?Jo5|x-P:e1fYv`79eZM99^InYA`0gBJI7.,OfdZF]CPM`q');
define('NONCE_SALT', 'g0hKG$S;.q>tm1#P9CXF&+Ae/H Gp<xBOAi1uh_N0TXC<$+e` ?=m#Ug<p`yg=B{');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'sc_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

