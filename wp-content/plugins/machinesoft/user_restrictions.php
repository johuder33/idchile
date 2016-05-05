<?php

/**
 * @version 1.0
 */
/*
  Plugin Name: MachineSoft Users
  Plugin URI: http://www.adminoft.com.ve
  Description: Permisos de Usuarios.
  Author: Johuder Gonzalez
  Version: 1.0
 */


# based in http://wpsnipp.com/index.php/functions-php/remove-all-admin-submenu-items/
function cd_remove_submenus() {
	global $submenu;
	global $current_user;
	get_currentuserinfo();

	if ($current_user->user_login != 'admin') {

		//Dashboard menu
		unset($submenu['index.php'][10]); // Removes Updates
		//Posts menu
		unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
		unset($submenu['edit.php'][10]); // Add new post
		unset($submenu['edit.php'][15]); // Remove categories
		unset($submenu['edit.php'][16]); // Removes Post Tags
		//Media Menu
//		unset($submenu['upload.php'][5]); // View the Media library
//		unset($submenu['upload.php'][10]); // Add to Media library
		//Links Menu
//		unset($submenu['link-manager.php'][5]); // Link manager
//		unset($submenu['link-manager.php'][10]); // Add new link
//		unset($submenu['link-manager.php'][15]); // Link Categories
		//Pages Menu
//		unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
//		unset($submenu['edit.php?post_type=page'][10]); // Add New page
		//Appearance Menu
//		unset($submenu['themes.php'][5]); // Removes 'Themes'
//		unset($submenu['themes.php'][7]); // Widgets
//		unset($submenu['themes.php'][15]); // Removes Theme Installer tab
		//Plugins Menu
//		unset($submenu['plugins.php'][5]); // Plugin Manager
//		unset($submenu['plugins.php'][10]); // Add New Plugins
//		unset($submenu['plugins.php'][15]); // Plugin Editor
		//Users Menu
//		unset($submenu['users.php'][5]); // Users list
//		unset($submenu['users.php'][10]); // Add new user
//		unset($submenu['users.php'][15]); // Edit your profile
		//Tools Menu
//		unset($submenu['tools.php'][5]); // Tools area
//		unset($submenu['tools.php'][10]); // Import
//		unset($submenu['tools.php'][15]); // Export
//		unset($submenu['tools.php'][20]); // Upgrade plugins and core files
		//Settings Menu
//		unset($submenu['options-general.php'][10]); // General Options
//		unset($submenu['options-general.php'][15]); // Writing
//		unset($submenu['options-general.php'][20]); // Reading
//		unset($submenu['options-general.php'][25]); // Discussion
//		unset($submenu['options-general.php'][30]); // Media
//		unset($submenu['options-general.php'][35]); // Privacy
//		unset($submenu['options-general.php'][40]); // Permalinks
//		unset($submenu['options-general.php'][45]); // Misc
	}
}

add_action('admin_menu', 'cd_remove_submenus');

## based in http://wpsnipp.com/index.php/functions-php/restrict-admin-menu-items-by-username/

function cd_remove_menus() {
	global $menu;
	global $current_user;
	get_currentuserinfo();

	if ($current_user->user_login != 'admin') {
		$restricted = array(
				'Entradas',
				//__('Media'),
				__('Links'),
				//__('Pages'),
				__('Comments'),
				__('Appearance'),
				__('Plugins'),
				__('Users'),
				__('Tools'),
				__('Settings')
		);
		end($menu);
		while (prev($menu)) {
			$value = explode(' ', $menu[key($menu)][0]);
			if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
				unset($menu[key($menu)]);
			}
		}// end while
	}// end if
}

add_action('admin_menu', 'cd_remove_menus');

function cd_remove_menus_admin_bar() {
	global $wp_admin_bar;
	global $current_user;
	get_currentuserinfo();

	if ($current_user->user_login != 'admin') {

		$wp_admin_bar->remove_menu('wp-logo'); // Elimina el logo (desaparece también todo el submenú)
//	$wp_admin_bar->remove_menu('about'); // Elimina el enlace "Sobre"
		$wp_admin_bar->remove_menu('wporg'); // Elimina el enlace a .org
		$wp_admin_bar->remove_menu('documentation'); // Elimina el enlace a la documentación oficial (Codex)
		$wp_admin_bar->remove_menu('support-forums'); // Elimina el enlace a los foros de ayuda
		$wp_admin_bar->remove_menu('feedback'); // Elimina el enlace "Sugerencias"
		$wp_admin_bar->remove_menu('view-site'); // Elimina el submenú que aparece al pasar el cursor sobre el nombre de la web
		$wp_admin_bar->remove_menu('comments'); // Elimina el acceso directo a los comentarios
		$wp_admin_bar->remove_menu('updates'); // Elimina el icono de notificación de actualizaciones
//	$wp_admin_bar->remove_menu('new-content'); // Elimina el menú para generar nuevo contenido
//	$wp_admin_bar->remove_menu('my-account'); // Elimina el menú para generar nuevo contenido
//	$wp_admin_bar->remove_menu('new-post'); // This (when used individually with other “remove menu” lines removed) will hide the menu item “Post”.
//	$wp_admin_bar->remove_menu('new-page'); // This (when used individually with other “remove menu” lines removed) will hide the menu item “Page”.
//	$wp_admin_bar->remove_menu('new-media'); // This (when used individually with other “remove menu” lines removed) will hide the menu item “Media”.
		$wp_admin_bar->remove_menu('new-link'); // This (when used individually with other “remove menu” lines removed) will hide the menu item “Link”.
		$wp_admin_bar->remove_menu('new-user'); // This (when used individually with other “remove menu” lines removed) will hide the menu item “User”.
	}
}

add_action('wp_before_admin_bar_render', 'cd_remove_menus_admin_bar');

function cd_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	global $current_user;
	get_currentuserinfo();

	if ($current_user->user_login != 'admin') {
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	}
}

add_action('wp_dashboard_setup', 'cd_remove_dashboard_widgets');

function remove_screen_options() {
	return false;
}

add_filter('screen_options_show_screen', 'remove_screen_options');

function cd_remove_editor_options() {
	get_currentuserinfo();
	global $current_user;

	if ($current_user->user_login != 'admin') {
		if (('page' == get_post_type())) {
			echo '
	<style type="text/css">
		#favorite-actions {display:none;}
		.add-new-h2{display:none;}
		.tablenav{display:none;}
		.trash{display:none}
  </style>';
		}
		echo '
	<style type="text/css">
		.update-nag {display:none}
		/* #toplevel_page_woocommerce {display:none;} */
		#contextual-help-link-wrap { display: none !important; }
  </style>';
	}
}

add_action('admin_head', 'cd_remove_editor_options');
?>