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

add_action('init', 'angularjs');
function angularjs(){ 

	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	if (strpos($url,'angularjs') !== false) {		
	   include 'includes/angular.php';
	   exit();
	}
}