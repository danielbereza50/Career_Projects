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

# require_once __DIR__.'/includes/main-class.php';
# require_once __DIR__.'/model/model-class.php';
# require_once __DIR__.'/controller/controller-class.php';

# register_activation_hook(__FILE__, array($model_obj, 'activate')); 
# add_action( 'rest_api_init', array($controller_obj,'route'));

//echo plugin_dir_url( __FILE__ ) . 'public/images/HPSA_logo.png'; 

/*

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
}


*/