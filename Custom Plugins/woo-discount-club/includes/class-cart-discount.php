<?php

// Function to check and apply the discount
function check_and_apply_discount() {
    // Retrieve the 'discount_ids' options
    $serializedIds_30 = get_option('discount_ids_30');
    $serializedIds_20 = get_option('discount_ids_20');
    $serializedIds_10 = get_option('discount_ids_10'); // Add a new option for 10% discount IDs

    if (empty($serializedIds_30) || empty($serializedIds_20) || empty($serializedIds_10)) {
        return; // No discount IDs stored
    }

    // Unserialize the option values to get arrays of IDs
    $discountIds_30 = unserialize($serializedIds_30);
    $discountIds_20 = unserialize($serializedIds_20);
    $discountIds_10 = unserialize($serializedIds_10); // Unserialize the 10% discount IDs

    if (!is_array($discountIds_30) || !is_array($discountIds_20) || !is_array($discountIds_10)) {
        return; // Invalid or empty discount IDs
    }

    // Get the current cart
    $cart = WC()->cart;

    // Get the current user's ID
    $current_user_id = get_current_user_id();

    // Check if the current user qualifies for the discount
    global $wpdb;
    $table_name = $wpdb->prefix . 'users';
    $query = $wpdb->prepare(
        "SELECT * FROM $table_name
        WHERE `ID` = %d
        AND `qualify_for_discount` = 1",
        $current_user_id
    );

    // Execute the query
    $results = $wpdb->get_results($query);

    // Initialize a variable to store the total order cost
    $total_order_cost = 0;

    // Get the user's orders for the current year
    $current_year = date('Y');
    $user_orders = wc_get_orders(array(
        'customer' => $current_user_id,
        'status' => array('processing', 'completed'),
        'date_query' => array(
            array(
                'year' => $current_year,
            ),
        ),
    ));

    // Iterate through the user's orders and sum up the order totals
    foreach ($user_orders as $order) {
        $total_order_cost += $order->get_total();
    }

    // Initialize a variable to store the total cost of items in the cart
    $total_cost = 0;

    // Iterate through cart items
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        //$total_cost += $cart_item['data']->get_price();
    }

	
	
	
	
	
	
    $total_combined = $total_order_cost + $total_cost; // Add the values together

    if ($total_combined > 500) {
        // Define the new value for the qualify_for_discount column
        $new_value = 1;

        // Update the qualify_for_discount column in the users table
        $result = $wpdb->update(
            $table_name,
            array('qualify_for_discount' => $new_value),
            array('ID' => $current_user_id)
        );

        if (false !== $result) {
            // The column was updated successfully
        } else {
            // Error updating the column
        }
    } else {
        // Define the new value for the qualify_for_discount column
        $new_value = 0;

        // Update the qualify_for_discount column in the users table
        $result = $wpdb->update(
            $table_name,
            array('qualify_for_discount' => $new_value),
            array('ID' => $current_user_id)
        );

        if (false !== $result) {
            // The column was updated successfully
        } else {
            // Error updating the column
        }
    }

    // Iterate through cart items and apply discounts
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
		
        $product_id = $cart_item['product_id'];
        $item_price = $cart_item['data']->get_price();

        if (in_array($product_id, $discountIds_30) && !empty($results)) {
            // Calculate the 30% discount for this item
            $discount = $item_price * 0.3;

            // Apply the discount to the item
            $cart->cart_contents[$cart_item_key]['data']->set_price($item_price - $discount);
        }

        if (in_array($product_id, $discountIds_20) && !empty($results)) {
            // Calculate the 20% discount for this item
            $discount = $item_price * 0.2;

            // Apply the discount to the item
            $cart->cart_contents[$cart_item_key]['data']->set_price($item_price - $discount);
        }

        if (in_array($product_id, $discountIds_10) && !empty($results)) {
            // Calculate the 10% discount for this item
            $discount = $item_price * 0.1;

            // Apply the discount to the item
            $cart->cart_contents[$cart_item_key]['data']->set_price($item_price - $discount);
        }
		
		
    }
}

// Hook into the WooCommerce cart to check and apply the discount
add_action('woocommerce_before_calculate_totals', 'check_and_apply_discount');
