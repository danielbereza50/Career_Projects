https://vimeo.com/

https://ziggeo.com/

https://console.plivo.com/accounts/login/

https://www.twilio.com/login

https://developer.aylien.com/login

https://developers.facebook.com/tools/debug/

/////////////////////////////////////////////

https://login.quickbase.com/db/main?a=signin

https://developer.quickbase.com/

https://www.youtube.com/watch?v=8OWD9COKDIU&t=1642s

appId: br5n39gmu

QB-Realm-Hostname: danielbereza.quickbase.com

User-Agent: mydemo

Authorization: QB-USER-TOKEN b6tday_p2sq_0_d3y8zjeb8buiv9euy5msbjjj2d3 

Parameters are take right from the url:

https://danielbereza.quickbase.com/db/br5n39gmu

take request 'body' out of quickbase and plugin to the code variable on the site

 
/////////////////////////////////////////////

project file header:

example:

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

terminal command:  

composer require {folder}

Need a: 

1. Client Id

2. Client Secret (Private Key)

3. Application Token

4. Encryption Key

5. SDK to connect


sample quttera API:

	POST http://scannerapi.quttera.com/api/v3/<api-key>/url/scan/<domain>.yaml
	GET http://scannerapi.quttera.com/api/v3/<api-key>/url/status/<domain>.yaml
	GET http://scannerapi.quttera.com/api/v3/<api-key>/url/report<domain>.yaml



or connect to api via url in wordpress

	$response = wp_remote_get( 'https://api.domain.com/api/v1/history/?key=<value>');
	//$response = wp_remote_get( 'https://api.domain.com/api/v1/history?key=<value>');

	$body     = wp_remote_retrieve_body( $response );
	//var_dump(json_decode($body));
	$json = json_decode($body, true);
	//var_dump($body);
	//$list = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';
	$decoded_list = json_decode($body); 
	//print_r($decoded_list);

	echo '<div class = "api-wrapper">';
		foreach($decoded_list as $json){
			echo '<div class = "api-item">';
			echo 'Transitioned On: ' . $json->TransitionedOn;
			echo '</div>';
		}
	echo '</div>';



example POST followed by GET request:


	// POST request
	$url = 'http://scannerapi.quttera.com/api/v3/<api-key>/url/scan/<domain>.yaml';
	$response = wp_remote_post($url);

	if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
		
		// POST request successful
		$reportUrl = 'http://scannerapi.quttera.com/api/v3/<api-key>/url/status/<domain>.yaml';

		// GET request
		$reportResponse = wp_remote_get($reportUrl);
		if (!is_wp_error($reportResponse) && wp_remote_retrieve_response_code($reportResponse) === 200) {
			// GET request successful
			$reportBody = wp_remote_retrieve_body($reportResponse);
			   echo '<div class = "api-container">';
					echo '<h2>Site Malware Check</h2>';
						echo '<div class = "api-wrapper quttera">';
						 echo '<pre>';
							print_r($reportBody);
						 echo '/<pre>';
					echo '</div>';
				echo '</div>';	
		} else {
			// GET request failed
			$error_message = is_wp_error($reportResponse) ? $reportResponse->get_error_message() : 'Request failed';
			echo 'Error: ' . $error_message;
		}
	} else {
		// POST request failed
		$error_message = is_wp_error($response) ? $response->get_error_message() : 'Request failed';
		echo 'Error: ' . $error_message;
	}



	HTTP Codes:

	Code 	Description
	200 OK 	Request was successful.
	400 Bad Request 	Request could not be handled due to an issue.
	403 Forbidden 	Account does not have access to the endpoint.
	404 Not Found 	Endpoint or file could not found.
	429 Too Many Requests 	Too many requests have been made in a period of time.
	500 Internal Server Error 	Server is experiencing technical difficulties.
	503 Service Unavailable 	API is down for maintenance.
 
