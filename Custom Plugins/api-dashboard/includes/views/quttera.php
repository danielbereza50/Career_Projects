<?php

	// https://quttera.com/quttera-anti-malware-api-help
	// http://scannerapi.quttera.com/api/v3/<api-key>/url/scan/<domain-name>
	// http://scannerapi.quttera.com/api/v3/<api-key>/url/scan/domain.com
	
	// http://scannerapi.quttera.com/api/v3/ab547ca4a14c1b914bb93286327f0f92/url/report/ideatreesolutions.com.yaml
	$response = wp_remote_get( 'http://scannerapi.quttera.com/api/v3/ab547ca4a14c1b914bb93286327f0f92/url/status/domain.com.yaml' );
	$body     = wp_remote_retrieve_body( $response );
	//print_r($body);
	//var_dump(json_decode($body));
	$json = json_decode($body, true);
	//var_dump($body);
	//$list = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';
	$decoded_list = json_decode($body); 
	//print_r($decoded_list);

echo '<div class = "api-container">';
echo '<h2>Site Malware Check</h2>';
	echo '<div class = "api-wrapper">';
			print_r($body);
	echo '</div>';
echo '</div>';