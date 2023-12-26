<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/custom-theme.js',
		array( 'jquery' )
	);





	

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function register_my_menus()
  {
  register_nav_menus(array(
    'main-menu' => __('Main Menu')


    
  ));
  }
add_action('init', 'register_my_menus');










