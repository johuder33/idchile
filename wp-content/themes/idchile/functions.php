<?php

// agregamos los estilos
wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
wp_enqueue_style('swiper_css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css');
wp_enqueue_style('style', get_stylesheet_uri());

// agregamos los js
wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js', array(), '1.12.2', true);
wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.6', true);
wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js', array(), '3.3.1', true);
wp_enqueue_script('idchile', get_template_directory_uri().'/assets/js/idchile.js', array(), '', true);

?>