<?php

include('includes/twilio-php/src/Twilio/autoload.php');

//require __DIR__ . 'includes/twilio-php-main/src/Twilio/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

// Get the path to the document root directory
$document_root = dirname(dirname(dirname(dirname(__FILE__)))) . '/';

// Construct the path to the wp-config.php file
$wp_config_path = $document_root . 'wp-config.php';

// Check if the wp-config.php file exists
if (file_exists($wp_config_path)) {
    // Include the wp-config.php file
    require_once($wp_config_path);

    // Get the database connection details from the configuration
    $db_config = [
        'host'     => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'database' => DB_NAME,
    ];

    // Create a new mysqli instance with the retrieved connection details
    $mysqli = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database']);

    // Check the connection
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    // Use the $mysqli object for further database operations
    // ...
} else {
    die("wp-config.php file not found.");
}

//$mysqli = new mysqli("localhost", "pwmzzxpgzt", "xTUwF6ug2Na", "pwmzzxpgzt");

// Perform the MySQL query to retrieve all users
$query_api_credentials = "
    SELECT option_value FROM `wp_options` WHERE option_name = 'trn_options'
";
$result_api_credentials = $mysqli->query($query_api_credentials);

// Check if the query was successful
if (!$result_api_credentials) {
    echo "Error executing the query: " . $mysqli->error;
    exit;
}

// Fetch all rows from the result set
$result_api_credentials = $result_api_credentials->fetch_all(MYSQLI_ASSOC);

$string = ($result_api_credentials[0]['option_value']);

preg_match('/"account_sid";s:\d+:"(.*?)"/', $string, $matches);
$accountSid = $matches[1];

preg_match('/"auth_token";s:\d+:"(.*?)"/', $string, $matches);
$authToken = $matches[1];

// Your Account SID and Auth Token from console.twilio.com
$sid = $accountSid;
$token = $authToken;
$client = new Twilio\Rest\Client($sid, $token);

// Perform the MySQL query to retrieve all users
$query = "
    SELECT DISTINCT u.ID, u.user_login, u.user_nicename, u.user_email, um_mobile.meta_value AS mobile_number
    FROM wp_users u
    INNER JOIN wp_usermeta um_trn ON u.ID = um_trn.user_id
    INNER JOIN wp_usermeta um_mobile ON u.ID = um_mobile.user_id
    WHERE um_mobile.meta_key = 'mobile_number'
";
$result = $mysqli->query($query);

// Check if the query was successful
if (!$result) {
    echo "Error executing the query: " . $mysqli->error;
    exit;
}

// Fetch all rows from the result set
$recipients = $result->fetch_all(MYSQLI_ASSOC);

$fromNumber = isset($_REQUEST['From']) ? $_REQUEST['From'] : 'Unknown';
$body = isset($_REQUEST['Body']) ? $_REQUEST['Body'] : 'EMPTY';

// Display the users
$sentCount = 0;
      //  trn_permissions
      $query_from_permissions = "SELECT DISTINCT u.ID, u.user_login, u.user_nicename, u.user_email, um_mobile.meta_value AS mobile_number
              FROM wp_users u
              INNER JOIN wp_usermeta um_trn ON u.ID = um_trn.user_id
              INNER JOIN wp_usermeta um_mobile ON u.ID = um_mobile.user_id
              WHERE um_trn.meta_key = 'trn_permissions'
              AND um_trn.meta_value LIKE '%\"1\"%'
              AND um_mobile.meta_key = 'mobile_number'
              AND um_mobile.meta_value = '$fromNumber'";
  
      $result_from_permissions = $mysqli->query($query_from_permissions);
      if ($result_from_permissions->num_rows > 0) {
        try {
          
           $client->messages->create(
           $fromNumber,
            [
            'from' => '+18453458006',
            'body' => $body
             ]
          );
        } catch (Exception $e) {
          //echo $e;
        }
      }else{
        //
      }
      foreach ($recipients as $recipient) {
            //  trn_subscriptions
            $recipient_final =  $recipient['mobile_number'];
            $query_from_subscriptions = "SELECT DISTINCT u.ID, u.user_login, u.user_nicename, u.user_email, um_mobile.meta_value AS mobile_number
                    FROM wp_users u
                    INNER JOIN wp_usermeta um_trn ON u.ID = um_trn.user_id
                    INNER JOIN wp_usermeta um_mobile ON u.ID = um_mobile.user_id
                    WHERE um_trn.meta_key = 'trn_subscriptions'
                    AND um_trn.meta_value LIKE '%\"1\"%'
                    AND um_mobile.meta_key = 'mobile_number'
                    AND um_mobile.meta_value = '$recipient_final'
                    AND um_mobile.meta_value != '$fromNumber'";

            $result_from_subscriptions = $mysqli->query($query_from_subscriptions);
            if ($result_from_subscriptions->num_rows > 0 && $result_from_permissions->num_rows > 0) {
              try {
                 $client->messages->create(
                 $recipient_final,
                  [
                  'from' => '+18453458006',
                  'body' => $body
                   ]
                );
              } catch (Exception $e) {
                //echo $e;
              }
            }else{
              //
            }
      }
$mysqli->close();