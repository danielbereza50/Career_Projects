<?php
/*
    Plugin Name: Divi Mobile Navigation
    Plugin URI:  https://212creative.com/
    Description: Added on functionality. 
    Version:     100.0.0
    Author:      212 Creative
    Author URI:  https://212creative.com/
    License:     GPL2
    License URI: Licence URl
*/

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
}