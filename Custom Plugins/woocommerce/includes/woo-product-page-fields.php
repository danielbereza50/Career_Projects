<?php
// Display a custom dropdown in single product pages before add_to_cart button
add_action( 'woocommerce_before_add_to_cart_button', 'display_dropdown_in_ends');
function display_dropdown_in_ends() { ?>
 	<div class="class_dropdown_ends">	
	<input type="text" id="fname" name="fname" placeholder="Enter student first name">
		 <input type="text" id="lname" name="lname" placeholder="Enter student last name">
		 <input type="text" id="grade" name="grade" placeholder="Enter student Grade">
		 <input type="text" id="home_room_teacher_name" name="home_room_teacher_name" placeholder="Enter Home Room Teacher Name">	
    <label for="id_dropdown_one_end"><b>Schools/Offices</b></label>
        <select id ="id_dropdown_one_end" name="school_name">
		 <option value="Pick up location">Select a Value</option>
            <option value="Option 1">Option 1</option>
			<option value="Option 2">Option 2</option>
			<option value="Option 3">Option 3</option>
        </select>
    </div>    
   <?php 
}
/*
 * Add dropdown value as custom cart item data, on add to cart
 *
 * @param array $cart_item_data
 * @param int   $product_id
 * @param int   $variation_id
 *
 * @return array
 */
add_filter( 'woocommerce_add_cart_item_data', 'add_dropdown_value_to_cart_item_data', 10, 4 );
function add_dropdown_value_to_cart_item_data( $cart_item_data, $product_id, $variation_id) {
    if( isset($_POST['school_name']) && ! empty($_POST['school_name']) ) {
        // Add the dropdown value as custom cart item data
        $cart_item_data['school_end'] = esc_attr($_POST['school_name']);
        $cart_item_data['unique_key'] = md5(microtime().rand()); // Make each added item unique
    }
	if( isset($_POST['fname']) && ! empty($_POST['fname']) ) {
        // Add the dropdown value as custom cart item data
        $cart_item_data['fname_end'] = esc_attr($_POST['fname']);
        $cart_item_data['unique_key'] = md5(microtime().rand()); // Make each added item unique
    }
	if( isset($_POST['lname']) && ! empty($_POST['lname']) ) {
        // Add the dropdown value as custom cart item data
        $cart_item_data['lname_end'] = esc_attr($_POST['lname']);
        $cart_item_data['unique_key'] = md5(microtime().rand()); // Make each added item unique
    }
	if( isset($_POST['grade']) && ! empty($_POST['grade']) ) {
        // Add the dropdown value as custom cart item data
        $cart_item_data['grade_end'] = esc_attr($_POST['grade']);
        $cart_item_data['unique_key'] = md5(microtime().rand()); // Make each added item unique
    }
	if( isset($_POST['home_room_teacher_name']) && ! empty($_POST['home_room_teacher_name']) ) {
        // Add the dropdown value as custom cart item data
        $cart_item_data['home_room_teacher_name_end'] = esc_attr($_POST['home_room_teacher_name']);
        $cart_item_data['unique_key'] = md5(microtime().rand()); // Make each added item unique
    }
    return $cart_item_data;
}
// Cart page: Display dropdown value after the cart item name
add_filter( 'woocommerce_cart_item_name', 'display_dropdown_value_after_cart_item_name', 10, 3 );
function display_dropdown_value_after_cart_item_name( $name, $cart_item, $cart_item_key ) {
    if( is_cart() && isset($cart_item['school_end']) ) {
        $name .= '<p>'.__("Schools/Offices:") . ' ' . esc_html($cart_item['school_end']) . '</p>';
    }
	if( is_cart() && isset($cart_item['fname_end']) ) {
        $name .= '<p>'.__("First Name:") . ' ' . esc_html($cart_item['fname_end']) . '</p>';
    }
	if( is_cart() && isset($cart_item['lname_end']) ) {
        $name .= '<p>'.__("Last Name:") . ' ' . esc_html($cart_item['lname_end']) . '</p>';
    }
	if( is_cart() && isset($cart_item['grade_end']) ) {
        $name .= '<p>'.__("Grade:") . ' ' . esc_html($cart_item['grade_end']) . '</p>';
    }
	if( is_cart() && isset($cart_item['home_room_teacher_name_end']) ) {
        $name .= '<p>'.__("Home Room Teacher Name:") . ' ' . esc_html($cart_item['home_room_teacher_name_end']) . '</p>';
    }
    return $name;
}
// Checkout page: Display dropdown value after the cart item name
add_filter( 'woocommerce_checkout_cart_item_quantity', 'display_dropdown_value_after_cart_item_quantity', 10, 3 );
function display_dropdown_value_after_cart_item_quantity( $item_qty, $cart_item, $cart_item_key ) {
    if( isset($cart_item['school_end']) ) {
        $item_qty .= '<p>'.__("Schools/Offices:") . ' ' . esc_html($cart_item['school_end']) . '</p>';
    }
	if( isset($cart_item['fname_end']) ) {
        $item_qty .= '<p>'.__("First Name:") . ' ' . esc_html($cart_item['fname_end']) . '</p>';
    }
	if( isset($cart_item['lname_end']) ) {
        $item_qty .= '<p>'.__("Last Name:") . ' ' . esc_html($cart_item['lname_end']) . '</p>';
    }
	if( isset($cart_item['grade_end']) ) {
        $item_qty .= '<p>'.__("Grade:") . ' ' . esc_html($cart_item['grade_end']) . '</p>';
    }
	if( isset($cart_item['home_room_teacher_name_end']) ) {
        $item_qty .= '<p>'.__("Home Room Teacher Name:") . ' ' . esc_html($cart_item['home_room_teacher_name_end']) . '</p>';
    }
    return $item_qty;
}
add_action( 'woocommerce_checkout_create_order_line_item', 'custom_checkout_create_order_line_item', 20, 4 );
function custom_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if( ! isset( $values['school_end'] ) ) return;
	if( ! isset( $values['fname_end'] ) ) return;
	if( ! isset( $values['lname_end'] ) ) return;
	if( ! isset( $values['grade_end'] ) ) return;
	if( ! isset( $values['home_room_teacher_name_end'] ) ) return;
	
    if( ! empty( $values['school_end'] ) )
        $item->update_meta_data( 'Schools/Offices:', $values['school_end'] );
	if( ! empty( $values['fname_end'] ) )
        $item->update_meta_data( 'First Name:', $values['fname_end'] );
	if( ! empty( $values['lname_end'] ) )
        $item->update_meta_data( 'Last Name:', $values['lname_end'] );
	if( ! empty( $values['grade_end'] ) )
        $item->update_meta_data( 'Grade:', $values['grade_end'] );
	if( ! empty( $values['home_room_teacher_name_end'] ) )
        $item->update_meta_data( 'Home Room Tacher Name:', $values['home_room_teacher_name_end'] );
}