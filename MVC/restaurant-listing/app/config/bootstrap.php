<?php 

add_action( 'wp_enqueue_scripts', 'venuelisting_enqueue_scripts' );

function venuelisting_enqueue_scripts($options) {
    wp_register_style('venuelists_style', mvc_css_url('venue-listing', 'venue-lists.css'));
    wp_enqueue_style('venuelists_style');
}




?>