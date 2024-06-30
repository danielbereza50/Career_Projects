<?php

/*

3 allowed retries
20 minutes lockout
3 lockouts increase lockout time to 24 hours
24 hours until retries are reset 


CREATE TABLE wp_g3mmvh_login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(50) NOT NULL,
    attempts INT DEFAULT 0,
    last_attempt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_locked TINYINT(1) DEFAULT 0,
    lockout_time TIMESTAMP DEFAULT NULL
);

// Scheduled task to reset attempts after 24 hours
if (!wp_next_scheduled('reset_login_attempts')) {
    wp_schedule_event(time(), 'daily', 'reset_login_attempts');
}

add_action('reset_login_attempts', 'custom_reset_login_attempts');
function custom_reset_login_attempts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'login_attempts';
    $wpdb->update($table_name, array(
        'is_locked' => 0,
        'lockout_time' => null,
        'attempts' => 0
    ), array('1' => '1'));
}



add_action('init', 'custom_reset_login_attempts_on_load');
function custom_reset_login_attempts_on_load() {
    if (!get_transient('custom_reset_login_attempts_scheduled')) {
        custom_reset_login_attempts();
        set_transient('custom_reset_login_attempts_scheduled', true, 24 * HOUR_IN_SECONDS);
    }
}

function custom_reset_login_attempts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'login_attempts';
    $current_time = current_time('mysql', 1);
    $expire_time = date('Y-m-d H:i:s', strtotime('-24 hours', strtotime($current_time)));
    $wpdb->query("UPDATE $table_name SET is_locked = 0, lockout_time = NULL, attempts = 0 WHERE last_attempt < '$expire_time'");
}

add_action('init', 'custom_reset_login_attempts_on_load');
function custom_reset_login_attempts_on_load() {
    if (!get_transient('custom_reset_login_attempts_scheduled')) {
        custom_reset_login_attempts();
        set_transient('custom_reset_login_attempts_scheduled', true, 5); // Set transient for 5 seconds
    }
}

function custom_reset_login_attempts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'login_attempts';
    $current_time = current_time('mysql', 1);
    $expire_time = date('Y-m-d H:i:s', strtotime('-5 seconds', strtotime($current_time))); // Adjust reset time to 5 seconds

    // Reset attempts for IPs where the last attempt was more than 5 seconds ago
    $wpdb->query("UPDATE $table_name SET is_locked = 0, lockout_time = NULL, attempts = 0 WHERE last_attempt < '$expire_time'");
}

*/



// Function to log login attempts
function log_login_attempt($ip_address, $login_successful) {
    global $wpdb; // Ensure $wpdb is globalized

    $table_name = $wpdb->prefix . 'login_attempts';
    $current_time = current_time('mysql');

    // Check if $wpdb is initialized properly
    if (!isset($wpdb) || !is_object($wpdb)) {
        return 0; // Return 0 or handle error appropriately
    }

    // Fetch the existing attempt record for the IP address
    $attempt = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ip_address = %s", $ip_address));

    if (!$login_successful) {
        if ($attempt) {
            // Only increment attempts if the last attempt was not successful
            if ($attempt->last_attempt < $current_time) {
                $attempts = $attempt->attempts + 1; // Increment attempts by 1
                $wpdb->update($table_name, array(
                    'attempts' => $attempts,
                    'last_attempt' => $current_time
                ), array('id' => $attempt->id));
            }
        } else {
            // Insert a new attempt record for unsuccessful login
            $wpdb->insert($table_name, array(
                'ip_address' => $ip_address,
                'attempts' => 1,
                'last_attempt' => $current_time
            ));
        }
    } else {
        // Reset attempts to 0 and lockout status if successful login
        if ($attempt) {
            $wpdb->update($table_name, array(
                'attempts' => 0,
                'is_locked' => 0,
                'lockout_time' => null
            ), array('id' => $attempt->id));
        }
    }

    // Return the number of attempts remaining
    if ($attempt) {
        return 3 - $attempt->attempts; // Assuming a maximum of 3 attempts before lockout
    } else {
        return 3; // Default to 3 attempts if no record is found
    }
}

// Function to check the lockout status
function check_lockout_status($ip_address) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'login_attempts';

    $attempt = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ip_address = %s", $ip_address));

    if ($attempt && $attempt->is_locked) {
        $current_time = current_time('mysql');
        if ($attempt->lockout_time < $current_time) {
            // Reset lockout status if the lockout period has passed
            $wpdb->update($table_name, array(
                'is_locked' => 0,
                'lockout_time' => null,
                'attempts' => 0
            ), array('id' => $attempt->id));
            return false;
        } else {
            return true;
        }
    }

    return false;
}

// Function to handle login attempts and lockout rules
function handle_login_attempt($ip_address) {
    if (check_lockout_status($ip_address)) {
        return 'locked_out';
    }

    $remaining_attempts = log_login_attempt($ip_address, false);

    if ($remaining_attempts <= 0) {
        // Lockout user if no remaining attempts
        $lockout_duration = apply_filters('custom_lockout_duration', 20 * MINUTE_IN_SECONDS); // Example lockout duration
        $lockout_time = strtotime("+$lockout_duration seconds");
        global $wpdb;
        $table_name = $wpdb->prefix . 'login_attempts';
        $wpdb->update($table_name, array(
            'is_locked' => 1,
            'lockout_time' => date('Y-m-d H:i:s', $lockout_time)
        ), array('ip_address' => $ip_address));

        return 'locked_out';
    }

    return 'allowed';
}

add_action('wp_authenticate_user', 'custom_authenticate_user_lockout', 10, 2);
function custom_authenticate_user_lockout($user, $password) {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $login_successful = false; // Assume login is unsuccessful initially

    // Check if $user is a WP_User object
    if ($user instanceof WP_User) {
        $username = $user->user_login; // Get the username from WP_User object
    } else {
        $username = $user; // Assume $user is the username string
    }

    // Perform authentication logic here to check if login is successful
    $user_obj = get_user_by('login', $username);

    if ($user_obj && wp_check_password($password, $user_obj->user_pass, $user_obj->ID)) {
        // Password is correct
        $login_successful = true;
    }

    // Handle locked out scenario before logging the attempt
    if (check_lockout_status($ip_address)) {
        wp_die('You are temporarily locked out. Please try again later.');
    }

    // Handle login attempt
    log_login_attempt($ip_address, $login_successful);

    if (!$login_successful) {
        $result = handle_login_attempt($ip_address);
        if ($result === 'locked_out') {
            wp_die('You are temporarily locked out. Please try again later.');
        }
    } else {
        $remaining_attempts = get_remaining_attempts($ip_address);
        if ($remaining_attempts <= 0) {
            wp_die('You are temporarily locked out. Please try again later.');
        }
    }

    return $user;
}

add_action('init', 'custom_reset_login_attempts_on_load');
function custom_reset_login_attempts_on_load() {
    if (!get_transient('custom_reset_login_attempts_scheduled')) {
        custom_reset_login_attempts();
        set_transient('custom_reset_login_attempts_scheduled', true, 24 * HOUR_IN_SECONDS);
    }
}

function custom_reset_login_attempts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'login_attempts';
    $current_time = current_time('mysql');
    $expire_time = date('Y-m-d H:i:s', strtotime('-24 hours', strtotime($current_time)));
    $wpdb->query("UPDATE $table_name SET is_locked = 0, lockout_time = NULL, attempts = 0 WHERE last_attempt < '$expire_time'");
}

// Function to get remaining attempts
function get_remaining_attempts($ip_address) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'login_attempts';
    $attempt = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ip_address = %s", $ip_address));

    if ($attempt) {
        return 3 - $attempt->attempts; // Calculate remaining attempts
    }

    return 3; // Default to 3 attempts if no record found
}

// Display remaining attempts on the login form
function display_remaining_attempts() {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $remaining_attempts = get_remaining_attempts($ip_address);

    echo '<p>Remaining Attempts: ' . $remaining_attempts . '</p>';
}

add_action('login_form', 'display_remaining_attempts');




// HERTETERTETEEE

// Hook into user login action
/*
add_action('wp_login', 'custom_set_transient_for_user_cleanup', 10, 2);

function custom_set_transient_for_user_cleanup($user_login, $user) {
    $user_id = $user->ID;

    // Set a transient that will trigger the cleanup after 5 seconds
    set_transient('custom_user_cleanup_' . $user_id, true, 5);

    // Schedule an event to check and cleanup after 5 seconds
    wp_schedule_single_event(time() + 5, 'custom_user_cleanup_event', array($user_id));
}
*/

// Hook into user login action
add_action('wp_login', 'custom_set_transient_for_user_cleanup', 10, 2);
function custom_set_transient_for_user_cleanup($user_login, $user) {
    $user_id = $user->ID;

    // Set a transient that will trigger the cleanup after 24 hours
    set_transient('custom_user_cleanup_' . $user_id, true, 24 * HOUR_IN_SECONDS);

    // Schedule an event to check and cleanup after 24 hours
    if (!wp_next_scheduled('custom_user_cleanup_event', array($user_id))) {
        wp_schedule_single_event(time() + 24 * HOUR_IN_SECONDS, 'custom_user_cleanup_event', array($user_id));
    }
}


// Schedule the cleanup event
add_action('custom_user_cleanup_event', 'custom_cleanup_user_sessions');

function custom_cleanup_user_sessions($user_id) {
    global $wpdb;

    $sessions_table_name = $wpdb->prefix . 'custom_sessions';
    $meta_table_name = $wpdb->prefix . 'custom_session_meta';

    // Delete records for the given user_id
    $wpdb->delete($sessions_table_name, array('user_id' => $user_id));
    $wpdb->delete($meta_table_name, array('user_id' => $user_id));
}

// Add a check in the init hook to ensure the cleanup happens even if the transient is missed
add_action('init', 'custom_check_and_cleanup_transients');

function custom_check_and_cleanup_transients() {
    global $wpdb;
    
    // Query the database to find any transients related to user cleanup
    $results = $wpdb->get_results(
        "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_custom_user_cleanup_%'"
    );

    // Loop through the results and trigger the cleanup if the transient has expired
    foreach ($results as $result) {
        $user_id = str_replace('_transient_custom_user_cleanup_', '', $result->option_name);
        if (!get_transient('custom_user_cleanup_' . $user_id)) {
            custom_cleanup_user_sessions($user_id);
        }
    }
}






