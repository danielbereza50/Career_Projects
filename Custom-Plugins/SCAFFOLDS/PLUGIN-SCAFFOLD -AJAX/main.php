<?php
/*
    Plugin Name: Custom code
    Plugin URI:  
    Description: Added on functionality. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

# require_once __DIR__.'/includes/class_ajax.php';

/*
add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'custom-script', plugin_dir_url( __FILE__ ).'public/js/functions.js');
    wp_enqueue_script( 'custom-script' );

    wp_enqueue_script(  'sample_wpajax_plugin', plugin_dir_url( __FILE__ ).'public/js/functions.js', array( 'jquery' ) );
    wp_localize_script( 'sample_wpajax_plugin', 'al',   array(  'ajaxurl'  => admin_url( 'admin-ajax.php' )  ) );
}

*/