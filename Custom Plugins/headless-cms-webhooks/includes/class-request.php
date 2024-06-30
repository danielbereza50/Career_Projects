<?php


// set webhook url:
// Develop > Phone Numbers > Manage > Active Numbers > Click Number(8006) Scroll down to Web hook url field
// domain.com/sms-hello.php


// Add the custom function to the parse_request action hook
add_action('parse_request', 'my_custom_function');
function my_custom_function($wp) {
    // Check if the requested URL is '/hello'
    if ($wp->request === 'sms-hello.php') {
		
			$public_html_path = $_SERVER['DOCUMENT_ROOT'];
			$file_path = $public_html_path . 'wp-content/plugins/no-headers/sms-hello.php';
			require_once $file_path;
	
        exit(); // Exit to prevent further processing
    }
}









