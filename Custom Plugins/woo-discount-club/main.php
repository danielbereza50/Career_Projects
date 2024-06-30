<?php
/*
    Plugin Name: Sales Club
    Plugin URI:  
    Description: Welcome to the sales club.
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

define('LC_INDEX', plugin_dir_url( __FILE__ ) );

include __DIR__.'/includes/class-main.php';
include __DIR__.'/includes/class-cart-discount.php';


add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
}

add_action('woocommerce_checkout_order_processed', 'check_checkout_products_and_discount');
add_action('woocommerce_order_status_completed', 'check_checkout_products_and_discount');
add_action('woocommerce_thankyou', 'check_checkout_products_and_discount');
function check_checkout_products_and_discount($order_id) {
    // Get the current user ID
    $current_user_id = get_current_user_id();

    // Define the product IDs for your three sets
    $product_ids_set_30 = array(1169, 720, 993, 1488, 4296, 3611, 511, 999, 1191, 7506, 2591, 838, 1970, 1171, 4916, 1330, 955);
    $product_ids_set_20 = array(2161, 2266, 1480, 1701, 8725, 20979, 418, 36, 1694, 2232, 6965, 7121, 7689, 4386, 3658, 1232, 1945);
    $product_ids_set_10 = array(664, 4229, 1242, 3731, 872, 5808, 11124);

    // Initialize variables to track product matches
    $set_30_match = false;
    $set_20_match = false;
    $set_10_match = false;

    // Get the order object
    $order = wc_get_order($order_id);

    // Loop through the order items and check if they match any of the product sets
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();

        if (in_array($product_id, $product_ids_set_30)) {
            $set_30_match = true;
        } elseif (in_array($product_id, $product_ids_set_20)) {
            $set_20_match = true;
        } elseif (in_array($product_id, $product_ids_set_10)) {
            $set_10_match = true;
        }
    }

    // Check if the user qualifies for a discount from the 'qualify_for_discount' field
    global $wpdb;
    $table_name = $wpdb->prefix . 'users'; // Replace with your table name
    $qualify_for_discount = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT qualify_for_discount FROM $table_name WHERE ID = %d",
            $current_user_id
        )
    );

    // Set the new value for first_time_discount_checkout
    $new_value = ($set_30_match || $set_20_match || $set_10_match) && $qualify_for_discount == 1 ? 1 : 0;

    // Update the first_time_discount_checkout field in the wp_users table
    $wpdb->update(
        $table_name,
        array('first_time_discount_checkout' => $new_value),
        array('ID' => $current_user_id),
        array('%d'),
        array('%d')
    );
	
	
}





