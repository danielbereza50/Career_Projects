<?php
/*
    Plugin Name: API Calls
    Plugin URI:  
    Description: 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
	
	wp_enqueue_script('jquery');
	
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');	
}
function has_active_subscription( $user_id=null ) {
    // When a $user_id is not specified, get the current user Id
    if( null == $user_id && is_user_logged_in() ) 
        $user_id = get_current_user_id();
    // User not logged in we return false
    if( $user_id == 0 ) 
        return false;

    // Get all active subscriptions for a user ID
    $active_subscriptions = get_posts( array(
        'numberposts' => 1, // Only one is enough
        'meta_key'    => '_customer_user',
        'meta_value'  => $user_id,
        'post_type'   => 'shop_subscription', // Subscription post type
        'post_status' => 'wc-active', // Active subscription
        'fields'      => 'ids', // return only IDs (instead of complete post objects)
    ) );

    return sizeof($active_subscriptions) == 0 ? false : true;
}
add_shortcode('display_paywall', 'paywall');
function paywall() {
		ob_start();	
    	if(is_user_logged_in()) {
			if(has_active_subscription($user_id)){
				include 'includes/dashboard.php';			
		}else{ 
			echo '<div class = "product-txt-1">Product has to be purchased to access analytics dashboard</div>';
			echo '<br><br>';
			echo '<div class = "product-txt-1">Please <a href = "/product/monitoring-subscription/">click here</a></div>';
		} 
	}else{ 
		echo '<div class = "login-txt">Please <a href = "/login-quimonit/"> login to continue</a></div>';
    }  

	$html = ob_get_clean();
	return $html;
}
add_action('plugins_loaded', function () {
    require_once(ABSPATH . '/wp-admin/includes/plugin.php');
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
          deactivate_plugins('quimonit/main.php');
          add_action('admin_notices', 'admin_notice');
    } else {
          include '/quimonit/main.php';
    }
});
/**
 * admin_notice
 *
 * @return void
 */
function admin_notice()
{
    echo '<div class="error"><p>Plugin deactivated. Please activate Woocommerce plugin!</p></div>';
}
function diwp_menu_shortcode(){
return wp_nav_menu( array(
	'menu'             => 'Header Menu',
	'menu_class'    => ''
));
}
add_shortcode('addmenu', 'diwp_menu_shortcode');
//add_filter( 'login_redirect', 'redirect_to_home', 10, 3 );
//function redirect_to_home( $redirect_to, $request, $user ) {
   // if( $user->user_nicename == '212Creative' || $user->user_nicename == 'qAdmin') {
    //    return '/wp-admin';
   // }else{
   //     return '/dashboard';
  //  }
  //return '/dashboard';
//}
add_filter( 'gform_user_registration_login_redirect_url', 'quimonit_redirect', 10, 2 );
function quimonit_redirect( $login_redirect, $sign_on ) {
	return '/dashboard';
}
add_filter( 'gform_field_value_full_name', 'my_custom_population_function' );
function my_custom_population_function( $value ) {
	$first_name = get_user_meta( get_current_user_id(), 'first_name', true ); 
	$last_name = get_user_meta( get_current_user_id(), 'last_name', true ); 
	$full_name = $first_name . " " . $last_name;
	
	return $full_name;
}
function create_videos_cpt()
{
    $labels = array(
        'name' => _x('URLS', 'post type general name') ,
        'singular_name' => _x('URL', 'post type singular name') ,
        'add_new' => _x('Add URL', 'URLS') ,
        'add_new_item' => __('Add New URLS') ,
        'edit_item' => __('Edit URLS') ,
        'new_item' => __('New URLS') ,
        'all_items' => __('All URLS') ,
        'view_item' => __('View URLS') ,
        'search_items' => __('Search URLS') ,
        'not_found' => __('No URLS found') ,
        'not_found_in_trash' => __('No URLS found in the Trash') ,
        'parent_item_colon' => '',
        'menu_name' => 'URLS'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'URLS',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'menu_position' => 5,
		'menu_icon'           => 'dashicons-admin-links',
        'supports' => array(
            'title',
            'thumbnail',
            'comments',
            'editor',
            'page-attributes',
            'author',
        ) ,
        'has_archive' => true,
    );
    register_post_type('urls', $args);
}
add_action('init', 'create_videos_cpt');
/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );
function has_woocommerce_subscription($the_user_id, $the_product_id, $the_status) {
	$current_user = wp_get_current_user();
	if (empty($the_user_id)) {
		$the_user_id = $current_user->ID;
	}
	if (WC_Subscriptions_Manager::user_has_subscription( $the_user_id, $the_product_id, $the_status)) {
		return true;
	}
}