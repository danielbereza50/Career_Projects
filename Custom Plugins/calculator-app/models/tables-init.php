<?php

// Define the activation hook
register_activation_hook(__FILE__, 'plugin_activation');

// Activation callback function
function plugin_activation() {
    global $wpdb;

    // Define the incidents table name
    $incidents_table_name = $wpdb->prefix . 'incidents';

    // SQL query to create the incidents table
    $incidents_sql = "CREATE TABLE $incidents_table_name (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        address VARCHAR(255),
        type_of_incident VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";

    // Require the upgrade.php file for dbDelta
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Execute the SQL query for the incidents table
    dbDelta($incidents_sql);

    // Define the wp_incidents_meta table name
    $meta_table_name = $wpdb->prefix . 'incidents_meta';

    // SQL query to create the wp_incidents_meta table
    $meta_sql = "CREATE TABLE $meta_table_name (
        ID INT PRIMARY KEY,
        chemical VARCHAR(255),
        time_stamp DATETIME,
        location VARCHAR(255),
        percent_actual_lel DOUBLE,
        lel_warning VARCHAR(255),
        lel_on_meter DOUBLE,
        idlh_warning VARCHAR(255)
    );";

    // Execute the SQL query for the wp_incidents_meta table
    dbDelta($meta_sql);
}
