<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
function divi__child_theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    $custom_css=filemtime(__DIR__.'/divi-style.min.css');
    wp_enqueue_style( 'child-style_custom',get_stylesheet_directory_uri() . '/divi-style.min.css',NULL,$custom_css);

    $custom_js=filemtime(__DIR__.'/custom-divi.js');
    wp_enqueue_script( 'custom-js','https://code.jquery.com/jquery-2.2.4.min.js',NULL,true );
    wp_enqueue_script( 'custom-divi-js',get_stylesheet_directory_uri().'/custom-divi.js',array('jquery'), $custom_js, true);
}
add_action( 'wp_enqueue_scripts', 'divi__child_theme_enqueue_styles' );
//
// Your code goes below
//
//

// Auto updating copyright //
// Outputs (c) 20** - 20**
add_shortcode( 'copyright', 'auto_cr' );
function auto_cr() {
		global $wpdb;
		$copyright_dates = $wpdb->get_results("
		SELECT
		YEAR(min(post_date_gmt)) AS firstdate,
		YEAR(max(post_date_gmt)) AS lastdate
		FROM
		$wpdb->posts
		WHERE
		post_status = 'publish'
		");
		$output = '';
		if($copyright_dates) {
		$copyright = "&copy; " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
		$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output = $copyright;
		}
		return $output;
}
