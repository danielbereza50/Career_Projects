<?php
/*
 
    Session Management: Implement a custom session management system where you track user sessions and devices. This could involve storing session data in the database or using a third-party session management solution.

    Token-Based Authentication: Use token-based authentication for users. When a user logs in, issue a unique token to that user. This token can then be used to identify the user across devices.

    AJAX Polling: Use AJAX to periodically check if the user is still logged in. This could involve making requests to the server at regular intervals to check the user's login status.

    Websockets: Implement Websockets for real-time communication between the server and the client. This would allow you to instantly notify other devices when a user logs in or logs out.

    Third-Party Services: Utilize third-party services or plugins that offer cross-device login tracking functionality. Be cautious with third-party services and ensure they align with your privacy and security requirements.


table 1:

CREATE TABLE wp_g3mmvh_custom_sessions (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    session_id varchar(255) NOT NULL,
    user_id bigint(20) NOT NULL,
    device_identifier varchar(255) NOT NULL,
    login_timestamp datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
);


table 2:

CREATE TABLE wp_g3mmvh_custom_session_meta (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_id bigint(20) NOT NULL,
    session_id VARCHAR(255) NOT NULL;
    lesson_code varchar(255) NOT NULL,
    group_symbol varchar(255) NOT NULL,
    PRIMARY KEY (id),
);

table 3:


CREATE TABLE wp_g3mmvh_daily_activity (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    user_id bigint(20) NOT NULL,
	
    login_timestamp datetime DEFAULT CURRENT_TIMESTAMP,
	logout_timestamp varchar(255);
	
	
	
    PRIMARY KEY (id),
);





   

*/



class CustomSessionManager {
	
	
	
   public static function createOrUpdateSession($user_id, $device_identifier) {
		global $wpdb;

		$sessions_table_name = $wpdb->prefix . 'custom_sessions';
		$meta_table_name = $wpdb->prefix . 'custom_session_meta';

		// Retrieve the session ID from the meta table
		$existing_meta = $wpdb->get_row($wpdb->prepare("SELECT * FROM $meta_table_name WHERE user_id = %d", $user_id));
	   
	   
		$session_id = md5(uniqid());

		// Delete existing session record in sessions table
		$wpdb->delete($sessions_table_name, array('user_id' => $user_id));
	    $wpdb->delete($meta_table_name, array('user_id' => $user_id));

		// Update or insert session record in sessions table
		if ($existing_session = $wpdb->get_row($wpdb->prepare("SELECT * FROM $sessions_table_name WHERE user_id = %d AND device_identifier = %s", $user_id, $device_identifier))) {
			$wpdb->update($sessions_table_name, array('session_id' => $session_id, 'login_timestamp' => current_time('mysql')), array('id' => $existing_session->id));
		} else {
			$wpdb->insert($sessions_table_name, array('session_id' => $session_id, 'user_id' => $user_id, 'device_identifier' => $device_identifier, 'login_timestamp' => current_time('mysql')));
		}

		// Update or insert session record in meta table
		if ($existing_meta) {
			$wpdb->update($meta_table_name, array('user_id' => $user_id), array('user_id' => $user_id));
		} else {
			// Retry mechanism for inserting record in meta table
			$max_retries = 3;
			$attempt = 0;
			$insert_success = false;

			while ($attempt < $max_retries && !$insert_success) {
				$insert_success = $wpdb->insert($meta_table_name, array('user_id' => $user_id));
				if (!$insert_success) {
					$attempt++;
					// Optionally, you can add a small delay between retries
					usleep(500000); // 500ms delay
				}
			}
			
			
			

			if (!$insert_success) {
				// Handle the error accordingly
				error_log("Failed to insert record into meta table for user_id: $user_id after $max_retries attempts.");
				return false;
			}
		}

		return $session_id;
	}

	
	public static function customLogoutHandler($user_id) {
        global $wpdb;
        $sessions_table_name = $wpdb->prefix . 'custom_sessions';
        $meta_table_name = $wpdb->prefix . 'custom_session_meta';
		
		
		
		
		 // Now delete records from the parent table (custom_sessions)
        $wpdb->delete($sessions_table_name, array('user_id' => $user_id));

        // Delete records from the child table (custom_session_meta) first
        $wpdb->delete($meta_table_name, array('user_id' => $user_id));

       
		
		
        // Clear cookies or session variables
        setcookie('session_id', '', time() - 3600, '/'); // Clear the session ID cookie

        // Redirect the user to a logout confirmation page or elsewhere
        wp_redirect(home_url());
        exit;
    }
	

    public static function validateSession($session_id, $device_identifier) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_sessions';

        $session = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE session_id = %s AND device_identifier = %s", $session_id, $device_identifier));

		
		
        if ($session) {
            // Session is valid, user is logged in
            return true;
        } else {
            // Session is invalid, user is not logged in
            return false;
        }
    }

    
	
}

// Example usage of validateSession() to check if the user is logged in
function custom_authentication_middleware() {
	global $wpdb;
	
    $session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
    $device_identifier = $_SERVER['HTTP_USER_AGENT']; // Example device identifier, you may need to use a more robust method
	$user_id = $user->ID;
	
	
    if (!CustomSessionManager::validateSession($session_id, $device_identifier)) {
		
		
	
        // User is not logged in, redirect them to the login page or take appropriate action
        wp_redirect(wp_login_url());
        exit;
    }
}
add_action('wp_logout', array('CustomSessionManager', 'customLogoutHandler'), 20, 1);



// Example usage of create_or_update_session() after successful login
function custom_login_handler($user_login, $user) {
	global $wpdb;
	
    $user_id = $user->ID;
    $device_identifier = $_SERVER['HTTP_USER_AGENT']; // Example device identifier, you may need to use a more robust method
    $session_id = CustomSessionManager::createOrUpdateSession($user_id, $device_identifier);
    // Set the session ID in a cookie or session variable for subsequent requests
    
	$daily_activity_table_name = $wpdb->prefix . 'daily_activity';

	// Get the current day of the week
	$day_of_week = date('l'); // This will give you the full name of the day, like "Monday", "Tuesday", etc.

	// Or, if you want abbreviated names like "Mon", "Tue", etc., you can use:
	// $day_of_week = date('D');

	// Insert data into the table
	$data = array(
		'user_id' => $user_id,
		'day_of_week' => $day_of_week
	);

	$wpdb->insert($daily_activity_table_name, $data);
	
	
}
add_action('wp_login', 'custom_login_handler', 10, 2);


function custom_authenticate_user($user, $password) {
	
		global $wpdb;
 		$sessions_table_name = $wpdb->prefix . 'custom_sessions';

 		 // Update or insert session record in sessions table
        if ($existing_session = $wpdb->get_row($wpdb->prepare("SELECT * FROM $sessions_table_name WHERE user_id = %d", $user->ID))) {
            return new WP_Error('authentication_failed', __('<strong>ERROR</strong>: You are already logged-in on another device.')); 
        } else {
           return $user;
        }
    
}
//add_filter('wp_authenticate_user', 'custom_authenticate_user', 10, 2);


function update_user_first_name_on_logout($user_id) {

	
	
	
	global $wpdb;
	// Get the current datetime in UTC
	$current_datetime_utc = current_time('mysql', true);

	// Convert UTC datetime to timestamp and subtract 7 hours (in seconds)
	$new_timestamp = strtotime($current_datetime_utc) - (7 * 3600);

	// Format the new datetime
	$new_datetime = date('Y-m-d H:i:s', $new_timestamp);
	$table_name = $wpdb->prefix . 'daily_activity';

	/*
		SELECT *
		FROM wp_g3mmvh_daily_activity
		WHERE user_id = 1
		ORDER BY login_timestamp DESC
		LIMIT 1;

		UPDATE wp_g3mmvh_daily_activity
		SET logout_timestamp = 'your_value'
		WHERE user_id = 1
		ORDER BY login_timestamp DESC
		LIMIT 1;
	
	*/
    // Run the SQL query directly
	$query = "
		UPDATE $table_name
		SET logout_timestamp = '{$new_datetime}'
		WHERE user_id = '{$user_id}'
		ORDER BY login_timestamp DESC
		LIMIT 1
	";

    // Execute the query
    $wpdb->query($query);
	
    // Update user meta
   //update_user_meta($user_id, 'first_name', 'fadsafsdfads');
   
	
}
add_action( 'wp_logout', 'update_user_first_name_on_logout', 10, 1 );








