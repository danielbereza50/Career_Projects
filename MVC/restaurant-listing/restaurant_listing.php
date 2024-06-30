<?php
/*
Plugin Name: CT Restaurant Listings
Plugin URI:
Description: Lists major restaurants in CT with admin views.
Author: Daniel Bereza
Version: 100.0.0
Author URI:
*/

// 1. cd path/to/plugins/wp-mvc
// 2. chmod +x wpmvc
// 3. ./wpmvc generate plugin RestaurantListing
// 4. ./wpmvc generate scaffold RestaurantListing Restaurant
// endpoints: http://localhost/wpsite1/restaurants/1/


// tutorials:
// https://www.sitepoint.com/getting-started-with-wordpress-mvc/
// http://wpmvc.org/documentation/tutorial/create_the_models_views_and_controllers.html



register_activation_hook(__FILE__, 'restaurant_listing_activate');
register_deactivation_hook(__FILE__, 'restaurant_listing_deactivate');

function restaurant_listing_activate() {
    global $wp_rewrite;
    require_once dirname(__FILE__).'/restaurant_listing_loader.php';
    $loader = new RestaurantListingLoader();
    $loader->activate();
    $wp_rewrite->flush_rules( true );
}

function restaurant_listing_deactivate() {
    global $wp_rewrite;
    require_once dirname(__FILE__).'/restaurant_listing_loader.php';
    $loader = new RestaurantListingLoader();
    $loader->deactivate();
    $wp_rewrite->flush_rules( true );
}







