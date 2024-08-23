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

//include __DIR__.'/includes/class-main.php';





echo "<script src='".plugins_url('trimming_app/js/script.js?v='). rand(10,1000) . "'></script>";
function index(){
	ob_start();


}

function dependency_manager_tool2(){
   $url = explode('/', $_SERVER['REQUEST_URI']);
   if(end($url) == "trimmingapp"){
	   	index();
	   	exit();
   	}
   }

add_action('parse_request', 'dependency_manager_tool2');
   




