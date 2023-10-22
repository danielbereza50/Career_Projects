<?php
// Add a new interval of every 24 hours
// See http://codex.wordpress.org/Plugin_API/Filter_Reference/cron_schedules
add_filter( 'cron_schedules', 'isa_add_every_day' );
function isa_add_every_day( $schedules ) {
    $schedules['every_day'] = array(
           // 'interval'  => 86400,
	    // minimum 60 seconds to run
	    'interval'  => 60,
            'display'   => __( 'Every 24 hours', 'textdomain' )
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'isa_add_every_day' ) ) {
    wp_schedule_event( time(), 'every_day', 'isa_add_every_day' );
}

// Hook into that action that'll fire every three minutes
add_action( 'isa_add_every_day', 'every_day_event_func' );
function every_day_event_func() {

 deactivate_plugins( '/copy-delete-posts/copy-delete-posts.php' );

	
/*
    global $wpdb;
	$user_tb = $wpdb->prefix."users";
	$sql = "SELECT * FROM $user_tb WHERE user_expiry = 0";
	$users = $wpdb->get_results($sql);

	foreach ( $users as $user ) {
		$bdate = get_user_meta($user->ID, 'user_birthday', true);

		if (!empty($bdate)) {
			$time = strtotime($bdate);
			$bdate = date('Y-m-d',$time);
			$currentdate = date("Y-m-d");
			$d1 = new DateTime($bdate);
			$d2 = new DateTime($currentdate);
			$diff = $d2->diff($d1);

		    if($diff->y >= 18){
		    	global $wpdb;
				$user_tb = $wpdb->prefix."users";
				$sql = "UPDATE $user_tb set user_expiry = 1 WHERE ID = $user->ID";
				$result = $wpdb->query($sql);

				wp_delete_user($user->ID);
		    }
		}
	}
	
*/


}














