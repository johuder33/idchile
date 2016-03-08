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
define('AUTH_KEY', '8?ikMQX?{pW@^kle8uJ?5r$&]F!i_*qycprUwO_GTiD<IJrfNh=>IV7+&I-S9C5P');
define('SECURE_AUTH_KEY', 'dF1V9Gt~_&8bhA{<wSDQe`TkI3IK+>3h<guc8X5(`(:fBnz@eC^(M Ukm 0dr0fw');
define('LOGGED_IN_KEY', 'Pe<?e(_CVP:j2F<Xb*xE!bo)]pxSBZG2TjuADRvCcLU+]>1J*bkxgFb^Z`s:nYuU');
define('NONCE_KEY', 'iV&[3Hnv0wf=G2/kGhh5^ rKMU|OHS|kSl uC/Uq{lAd)0-tg.L3E0]-UzHIn~#a');
define('AUTH_SALT', '}Ky(A~~>`[37YF|%OZ}w%lsK.W~&B m,z+REY%GG&86O~2(u+z0Kw|o#|30J_&$S');
define('SECURE_AUTH_SALT', 'V3d7uFcERBW^*fnQ#D6x2~tBd3T]Z[ xL)eN3l#3hkG~},$GJwhb7v4P2fBD#)k8');
define('LOGGED_IN_SALT', ',MCu{``[wEsJ:;:Hh&171U7 %Yg/`6/vX)|c}]Q)~q&RhB:Vum2S:W@a|kbsA=u3');
define('NONCE_SALT', 'iV-#N,>&~{4 w39XT0Dc)+;dNn $W8yJ U_ +ErixbsPh,V0Tzf<jQN7bZD@Ac9:');

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

