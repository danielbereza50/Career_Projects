<?php

//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    $custom_js=filemtime(__DIR__.'/custom.js');
    wp_enqueue_script( 'custom-js','https://code.jquery.com/jquery-2.2.4.min.js',NULL,true );
    wp_enqueue_script( 'custom-site-js',get_stylesheet_directory_uri().'/custom.js',array('jquery'), $custom_js, true);

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function register_my_menus()
  {
  register_nav_menus(array(
    'account-menu' => __('Account Menu') ,
    'need-help-menu' => __('Need Help Menu') ,
    'about-sp-menu' => __('About SP Menu') ,
    'main-menu' => __('Main Menu')
  ));
  }
add_action('init', 'register_my_menus');






