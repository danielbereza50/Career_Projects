<?php
/*
    Plugin Name: WordPress Games
    Plugin URI:  
    Description: Added on functionality. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

include __DIR__.'/includes/class-main.php';


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
	
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/custom-divi.js',
		array( 'jquery' )
	);
	wp_enqueue_script(
		'crossword-script',
		get_stylesheet_directory_uri() . '/js/games/crossword.js',
		array( 'jquery' )
	);

	wp_enqueue_script(
		'wordsearch-script',
		get_stylesheet_directory_uri() . '/js/games/wordsearch.js',
		array( 'jquery' )
	);

	// Localize the script with the AJAX URL
    wp_localize_script('custom-script', 'al', array('ajaxurl' => admin_url('admin-ajax.php')));
	
	// Enqueue React.js from CDN
    wp_enqueue_script('react-js', 'https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.production.min.js', array(), '17.0.2', true);

    // Enqueue React DOM from CDN
    wp_enqueue_script('react-dom-js', 'https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.production.min.js', array(), '17.0.2', true);

	
	
	
	

	


}