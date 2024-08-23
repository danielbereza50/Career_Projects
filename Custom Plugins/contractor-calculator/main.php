<?php
/*
    Plugin Name: Contractor Calculators
    Plugin URI:  
    Description: Calculates cost comparison for contract and internal employees.
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/



include __DIR__.'/includes/class-contractor-calculators.php';
include __DIR__.'/admin/class-admin.php';

define('CURRENT_DIRECTORY_PATH', dirname(__FILE__));

$base_url = get_site_url(); // or 'http://yourdomain.com'
$relative_path = str_replace(ABSPATH, '', CURRENT_DIRECTORY_PATH);
$relative_url = rtrim($base_url, '/') . '/' . ltrim(str_replace('\\', '/', $relative_path), '/');
//echo $relative_url;


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



add_filter('template_include', 'override_template_for_calculator');
function override_template_for_calculator($template) {
    global $post;
    
    // Check if the content contains the shortcode
    if (has_shortcode($post->post_content, 'get_contractor_calculator')) {
        // Point to the custom template within the plugin directory
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/template-no-header-footer.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }

    return $template;
}




