<?php

// agregamos los estilos
wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css');
wp_enqueue_style('style', get_stylesheet_uri());

// agregamos los js
wp_enqueue_script('jquery', get_template_directory_uri().'/assets/js/jquery-1.12.1.min.js', array(), '1.12.1', true);
wp_enqueue_script('bootstrap_js', get_template_directory_uri().'/assets/bootstrap/js/bootstrap.min.js', array(), '', true);
wp_enqueue_script('idchile', get_template_directory_uri().'/assets/js/idchile.js', array(), '', true);

?>