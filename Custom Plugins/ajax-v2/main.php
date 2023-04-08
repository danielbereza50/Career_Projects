<?php
/*
    Plugin Name: 
    Plugin URI:  
    Description: Allows site users to search for a '' on a wordpress page.
    Version:     100.0.0
    Author:      
    Author URI: 
    License:     GPL2
    License URI: Licence URl
*/

include __DIR__.'/includes/class-main.php';
include __DIR__.'/includes/class-ajax.php';

define('CWB_INDEX', plugin_dir_url( __FILE__ ) );

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');  
}