<?php
/*
    Plugin Name: Chemical Calculator
    Plugin URI:  
    Description: Calculator App to perform simple mathematical operations on chemical attributes.
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

define('CALC_INDEX', plugin_dir_url( __FILE__ ) );

include __DIR__.'/controllers/class-controllers.php';
include __DIR__.'/models/tables-init.php';


include __DIR__.'/includes/class-calculator.php';
include __DIR__.'/includes/class-incidents.php';
include __DIR__.'/includes/class-chemicals.php';

include __DIR__.'/admin/users.php';


// Enqueue admin CSS files
function enqueue_admin_styles() {
    wp_register_style('admin-css', plugins_url('admin/admin.css',__FILE__ ));
    wp_enqueue_style('admin-css');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');


function print_header() { ?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="https://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	   <head>
		  <meta charset="<?php bloginfo( 'charset' ); ?>">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="profile" href="http://gmpg.org/xfn/11">
		  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		  <title>Fisch Solutions</title>
		  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
		  <link rel="shortcut icon" href="/wp-content/uploads/2023/11/logo.jpg">
		  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		  <?php wp_head(); ?>

		  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		   
		  <link rel="stylesheet" href="/wp-content/plugins/calculator-app/public/css/main.css">
		  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		  <script src="/wp-content/plugins/calculator-app/public/js/functions.js"></script>


	   </head>
	   <div class="logo-container">
			<img src="/wp-content/plugins/calculator-app/public/images/firehouse-logo.png" alt="Firehouse Logo" id="logoImage">
		</div>	
	
		
<?php }









