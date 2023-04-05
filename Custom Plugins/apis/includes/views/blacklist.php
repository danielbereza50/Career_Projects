<?php

	// https://docs.hetrixtools.com/api/v3/
	// https://api.hetrixtools.com/v3/<API_TOKEN>/uptime-monitors
	// https://docs.hetrixtools.com/tag/api/
	
		//https://api.hetrixtools.com/v2/<API_TOKEN>/blacklist-check/domain/domain.com/

$response = wp_remote_get( 'http://api.mxtoolbox.com/api/v1/lookup/blacklist/domain.com?authorization=');

	$body     = wp_remote_retrieve_body( $response );
//	var_dump(json_decode($body));
	$json = json_decode($body, true);
	//var_dump($body);
	//$list = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';
	$decoded_list = json_decode($body); 
	 echo '<pre>';
    	//print_r($decoded_list);
	 echo '<pre>';
	 $obj_failed = $decoded_list->Failed;
	 $obj_passed = $decoded_list->Passed;

	echo '<div class = "api-container">';

	echo '<h2>Blacklist Check</h2>';
		echo '<div class = "api-wrapper">';
		if(empty($obj_failed)){
			echo '<i class="fa fa-check" aria-hidden="true"></i> ' . ' No failed blacklists checks';
		}else{
			echo '<i class="fa fa-times" aria-hidden="true"></i> ' . ' Failed blacklists checks';
		}
		echo '</div>';
		echo '<h2>Here are the passed blacklists Checks</h2>';
		echo '<div class = "api-wrapper">';
		//foreach($decoded_list as $obj => $student){
			//echo $obj . ":" . $student;
			//echo "<br>";
   		//}
		
		foreach($obj_passed as $key => $object){
				foreach($object as $property => $value){
					echo $property . " : " . $value;
					echo '<br><br>';
				}
			}
		echo '</div>';
echo '</div>';

