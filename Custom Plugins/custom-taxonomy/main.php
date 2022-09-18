<?php
/*
    Plugin Name: Inoac Custom Code 
    Plugin URI:  https://212creative.com
    Description: Added on functionality to this divi child theme.  Requires the Categories Images plugin.   
    Version:     100.0.0
    Author:      212 Creative, LLC
    Author URI:  https://212creative.com
    License:     GPL2
    License URI: Licence URl
*/

// debugging
// echo "$variable_name"; WP_DEBUG; var_dump(); print_r(); error_log(); debug_backtrace();

// Imports
include (__DIR__.'/includes/show-hide.php');
include (__DIR__.'/includes/taxonomy.php');
include (__DIR__.'/includes/ajax.php');
include (__DIR__.'/includes/taxonomy-tiles.php');

// create an admin page with the data here
add_action('admin_menu', 'admin_page_create');
function admin_page_create() {
 
    $page_title = 'Inoac Custom Code';
    $menu_title = 'Inoac Custom Code';
    $capability = 'edit_posts';
    $menu_slug = 'Inoac Custom Code';
    $function = 'admin_page_display';
    $icon_url = '';
    $position = 6;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

$function = 'admin_page_display';


function admin_page_display() {
?> 

<h1>This shortcode is to do the show/hide on the unused data fields.</h1>
<div>[CPT]</div>

<h1>This is to pull in the taxnomy desccription and image in the divi builder.</h1>
<div>This shortcode requires the 'Categories Images plugin.'</div>
<div>[taxonomy]</div> 

<!--<h1>This is to pull in the taxnomy items in an ajax scroll a taxonomy.</h1>
<div>This shortcode has to be placed in a 'materials' divi template file.</div>
<div>[my_ajax_load]</div>-->

<h1>This is to pull in the taxnomy items by terms</h1>
<div>example: [taxonomy_tile custom_taxonomy="materials"]</div> 


<?php

}














