<?php

// Add 'Calculator User' role
function add_calculator_user_role() {
    add_role(
        'calculator_user',
        'Calculator User',
        array(
            'read' => true, // Give read access
            // Add more capabilities as needed
        )
    );
}
add_action('init', 'add_calculator_user_role');
