<?php
/*
    Plugin Name: Interactive Featured Images
    Plugin URI:  
    Description: Makes the services graphic interactive on the home page based on item that is clicked. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

define('BM_INDEX', plugin_dir_url( __FILE__ ) );

include __DIR__.'/includes/class-featured.php';

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
}

