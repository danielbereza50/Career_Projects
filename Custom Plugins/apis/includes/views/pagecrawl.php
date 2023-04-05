<?php

    //https://pagecrawl.io/api/changes?api_token=
	$response = wp_remote_get( 'https://pagecrawl.io/api/changes?api_token=' );
	$body     = wp_remote_retrieve_body( $response );
	//var_dump(json_decode($body));
	$json = json_decode($body, true);
	//var_dump($body);
	//$list = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';
	$decoded_list = json_decode($body); 
	//print_r($decoded_list);
	$decoded_list_final = $decoded_list[1]->latest;
	$decoded_list_final_1 = $decoded_list[1]->latest->changed_at;
	$createDate = new DateTime($decoded_list_final_1);
	$strip = $createDate->format('Y-m-d');
	$date = DateTime::createFromFormat("Y-m-d", $strip);
	$date_content_modified = $date->format("d");
	$date_month_modified = $date->format("m");

	$monthNum  = $date_month_modified;
	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$apimonthName = $dateObj->format('F'); // March

	//echo $apimonthName; 

	echo '<div class = "api-container">';
	echo '<h2>Content Change Monitoring</h2>';
		echo '<div class = "api-wrapper">'; ?>
			<table border='0' >
				<?php include 'table-changes.php'; ?>
			</table>
	<?php
		echo '</div>';
	echo '</div>';