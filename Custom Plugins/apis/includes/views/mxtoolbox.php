<?php

	//$mxapi_key = get_user_option( 'mx_toolbox_api_key', $user_id);
	//echo $mxapi_key;
	// https://blog.mxtoolbox.com/2013/12/06/dashboard-rest-api/
	// https://blog.mxtoolbox.com/2013/10/11/rest-api-api-access-now-available/
	// https://mxtoolbox.com/c/products/mxtoolboxapi
	// http://api.mxtoolbox.com/api/v1/monitor/?authorization=&tag=blacklist
	// https://api.mxtoolbox.com/api/v1/usage/?authorization=&tag=blacklist
	// https://api.mxtoolbox.com/api/v1/history/59ee6510-f51c-44fa-9ade-73cb31398fb9?authorization=
	// https://api.mxtoolbox.com/api/v1/lookup/dns/domain.com?authorization=

	//$response = wp_remote_get( 'http://api.mxtoolbox.com/api/v1/monitor/?authorization=&tag=blacklist' );
	//$response = wp_remote_get( 'https://api.mxtoolbox.com/api/v1/usage/?authorization=&tag=blacklist' );
	$url = "https://api.mxtoolbox.com/api/v1/history/59ee6510-f51c-44fa-9ade-73cb31398fb9?authorization=";
	$response = wp_remote_get($url);
	//$response = wp_remote_get( "https://api.mxtoolbox.com/api/v1/lookup/dns/ideatreesolutions.com?authorization=".$mxapi_key."" );

	$body     = wp_remote_retrieve_body( $response );
	//var_dump(json_decode($body));
	$json = json_decode($body, true);
	//var_dump($body);
	//$list = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';
	$decoded_list = json_decode($body); 
	//print_r($decoded_list);
	$status = $decoded_list[0]->Status;
	$transitionedString = $decoded_list[0]->TransitionedString;
	$name = $decoded_list[0]->Name;

//print_r($response['body']);
//  33bac3b2-10bf-4873-b6b8-1fe8a4cd23ad

	if($response['body'] === 'You are not authorized to access the API. Please login first at https://mxtoolbox.com.'){
		echo '<div class = "api-container">';
	echo '<h2>Domain Health Check</h2>';
	echo '<div class = "api-wrapper">';
		foreach($decoded_list as $json){
			echo '<div class = "api-item">';
			
			if($status == 0){
				echo $status . " " . ": All OK";  ?>
				<i class="fa fa-check" aria-hidden="true"></i>
				<?php
				echo '<br>';
			}
			if($status == 9){
				echo $status . " " . ": Down"; ?>
				<i class="fa fa-times" aria-hidden="true"></i>
				<?php
				echo '<br>';
			}
			
			echo "Last Changed:" . " " . $transitionedString;
			echo '<br>';
			echo "Record Name and change:" . " " . $name;
			
			if(!empty($json->Error)){
			}else{
				break;
			}
			echo '</div>';
		}
	echo '</div>';
echo '</div>';
	}else{
echo '<div class = "api-container">';
	echo '<h2>Domain Health Check</h2>';
	echo '<div class = "api-wrapper">';
		foreach($decoded_list as $json){
			echo '<div class = "api-item">';
			
			if($status == 0){
				echo $status . " " . ": All OK";  ?>
				<i class="fa fa-check" aria-hidden="true"></i>
				<?php
				echo '<br>';
			}
			if($status == 9){
				echo $status . " " . ": Down"; ?>
				<i class="fa fa-times" aria-hidden="true"></i>
				<?php
				echo '<br>';
			}
			
			echo "Last Changed:" . " " . $transitionedString;
			echo '<br>';
			echo "Record Name and change:" . " " . $name;
			
			if(!empty($json->Error)){
			}else{
				break;
			}
			echo '</div>';
		}
	echo '</div>';
echo '</div>';
echo '</div>';		
}