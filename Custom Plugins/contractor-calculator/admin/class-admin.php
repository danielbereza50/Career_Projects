<?php

// Add this code to your theme's functions.php or a custom plugin

// Hook to add admin menu
add_action('admin_menu', 'custom_calcuator_item_menu');

function custom_calcuator_item_menu() {
    add_menu_page(
        'Calculator Fields',             // Page title
        'Calculator Fields',             // Menu title
        'manage_options',           // Capability
        'custom-calculator-fields',             // Menu slug
        'custom_calculator_fields',        // Function to display the page
        'dashicons-calculator',      // Icon
        100                         // Position
    );
}

function custom_calculator_fields() {
    global $wpdb;

    // Check if the user has submitted the form
    if (isset($_POST['submit'])) {
        // Sanitize and prepare the input
        $bullet_items = isset($_POST['roi_bullet_items']) ? sanitize_textarea_field($_POST['roi_bullet_items']) : '';

        // Convert the bullet items into an array and save as JSON
        $bullet_items_array = array_filter(array_map('trim', explode("\n", $bullet_items))); // Remove empty lines

        // Encode the items, ensuring to handle characters properly
        $bullet_items_json = json_encode($bullet_items_array, JSON_UNESCAPED_UNICODE);

        // Prepare the SQL query to save to the options table
        $table_name = $wpdb->prefix . 'options';
        $option_name = 'roi_bullet_items';
        $wpdb->query($wpdb->prepare("INSERT INTO $table_name (option_name, option_value) VALUES (%s, %s) ON DUPLICATE KEY UPDATE option_value = %s", $option_name, $bullet_items_json, $bullet_items_json));

        echo '<div class="updated"><p>Bullet items saved successfully!</p></div>';
    }

    // Retrieve the existing bullet items
    $existing_bullet_items = $wpdb->get_var("SELECT option_value FROM {$wpdb->prefix}options WHERE option_name = 'roi_bullet_items'");
    $existing_bullet_items_array = $existing_bullet_items ? json_decode($existing_bullet_items, true) : [];
    $existing_bullet_items_text = implode("\n", $existing_bullet_items_array);
	

    ?>
<h2>Hit the return key when done with current item to create a new bullet item</h2>
    <div class="wrap">
        <h1>ROI Bullet Items</h1>
        <form method="post" action="">
            <textarea name="roi_bullet_items" rows="10" cols="160"><?php echo esc_textarea($existing_bullet_items_text); ?></textarea><br />
            <input type="submit" name="submit" class="button button-primary" value="Save Bullet Items" />
        </form>
    </div>
    <?php
}
