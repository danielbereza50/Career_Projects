<?php
/*
    Plugin Name: Filter Course Categories
    Plugin URI:  https://212creative.com/
    Description: Allows site users to search for a '' on a wordpress page.
    Version:     100.0.0
    Author:      212 Creative
    Author URI: https://212creative.com/
    License:     GPL2
    License URI: Licence URl
*/

//include __DIR__.'/includes/class-main.php';
//include __DIR__.'/includes/class-ajax.php';

define('CWB_INDEX', plugin_dir_url( __FILE__ ) );

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');  

    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
    
}