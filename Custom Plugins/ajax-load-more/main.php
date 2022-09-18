<?php
/*
    Plugin Name: Ajax Load More 
    Plugin URI:  
    Description: 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

// debugging
// echo "$variable_name"; WP_DEBUG; var_dump(); print_r(); error_log(); debug_backtrace();

// Imports
include (__DIR__.'/includes/ajax.php');

// create an admin page with the data here
add_action('admin_menu', 'admin_page_create');
function admin_page_create() {
 
    $page_title = '';
    $menu_title = '';
    $capability = 'edit_posts';
    $menu_slug = '';
    $function = 'admin_page_display';
    $icon_url = '';
    $position = 6;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

$function = 'admin_page_display';


function admin_page_display() {
?> 


<h1>This shortcode is to load more via ajax.</h1>
<div>[my_ajax_load totalposts="2" category = "Life Lessons"]</div>

<?php

}














