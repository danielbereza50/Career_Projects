<?php
/*
    Plugin Name: API-NAME 
    Plugin URI:  
    Description: Added on functionality. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

// github sdk link here

// API login:
// https://domain.com/dashboard/    
// UN: danielbereza24@gmail.com
// PW: 111111111111111
  
// API Application ID: -
// Sandbox Access token: -

// Production Application ID: - 
// Production Access token: -

/*  

    1. install php and composer on your computer
    2. mkdir quickstart
       cd ./quickstart
    3. composer require api

*/

// require_once('vendor/autoload.php');

// use some\namespace\ClassA;
// use some\namespace\ClassB;

add_shortcode('api', 'show_output');
function show_output(){
    ob_start();

    /*
        $api_access_token = '-';
        $upper_case_environment = Environment::PRODUCTION;

        $client = new APIClient([
            'accessToken' => $api_access_token,
            'environment' => $upper_case_environment
        ]);

        print_r($client);

    */
 








	// echo 'fffff';
		
    $html = ob_get_clean();
    return $html;
}    
