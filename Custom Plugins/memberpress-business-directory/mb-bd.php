<?php


//  backup the following files on the live site
//  /business-directory-plugin/includes/helpers/functions/templates-ui.php 
//  wpbdp_thumbnail_html
//  Version: 6.3.6
//   
//   /memberpress/app/models/MeprUser.php:893
//   /memberpress/app/controllers/MeprUsersCtrl.php:388
//   Version: 1.9.16
add_action('mepr-event-member-signup-completed', 'mepr_capture_new_member_signup_completed', 10, 1);
function mepr_capture_new_member_signup_completed($event) {
    $user = $event->get_data();
    $user_id = $user->ID;
	
    $email = $user->user_email; // Retrieve the email address from the user object
    $phone_key = 'mepr_phone'; 
	
    $address_one_key = 'mepr-address-one';  
    $city_key = 'mepr-address-city'; 
    $state_key = 'mepr-address-state'; 
    $zip_key = 'mepr-address-zip'; 
	$business_name_key = 'mepr_business_name';
	//$category_name_key = 'mepr_category';
	//$logo_key = 'mepr_company_logo';
 
    $website_key = 'mepr_website';
	
    $phone = get_user_meta( $user_id, $phone_key, true );
   
    $address_one = get_user_meta( $user_id, $address_one_key, true );
    $city = get_user_meta( $user_id, $city_key, true );
    $state = get_user_meta( $user_id, $state_key, true );
    $zip = get_user_meta( $user_id, $zip_key, true );
    $address_final = $address_one . "," . $city . "," . $state . "," . $zip;	
	
    $website = get_user_meta( $user_id, $website_key, true );
	$business_name = get_user_meta( $user_id, $business_name_key, true );
	//$logo = get_user_meta( $user_id, $logo_key, true );
	//$category = get_user_meta( $user_id, $category_name_key, true );
	
	
    // Create the new listing
    $post_title = $business_name;
    $post_status = 'publish';
    $post_type = 'wpbdp_listing';

    $new_post = array(
        'post_title' => $post_title,
        'post_status' => $post_status,
        'post_type' => $post_type,
    );

    // Insert the new listing
    $listing_id = wp_insert_post($new_post);

    if ($listing_id) {
		
		update_post_meta($listing_id, '_wpbdp[fields][5]', $website);
		update_post_meta($listing_id, '_wpbdp[fields][6]', $phone);
        update_post_meta($listing_id, '_wpbdp[fields][7]', $email);
		update_post_meta($listing_id, '_wpbdp[fields][9]', $address_final);
		//update_post_meta($listing_id, '_wpbdp[fields][10]', $zip);
		//update_post_meta($listing_id, '_wpbdp[fields][11]', $logo);
    }
	
	
}