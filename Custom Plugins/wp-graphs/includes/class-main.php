<?php


function handle_ajax_request($action, $view_path) {
    include($view_path);
    die();
}



function data_fetch_activity() {
	handle_ajax_request('data_fetch_activity', 'views/activity.html.php');
}

add_action('wp_ajax_data_fetch_activity', 'data_fetch_activity');
add_action('wp_ajax_nopriv_data_fetch_activity', 'data_fetch_activity');

