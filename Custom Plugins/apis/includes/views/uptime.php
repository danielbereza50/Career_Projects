<?php

		// https://uptimerobot.com/api/
		// https://github.com/plesk/ext-uptime-robot/blob/master/plib/library/API.php
		// Test key: u1941939-90ad761c92dfd6c935df088c
		
		$api_key = get_user_option( 'uptime_robot_api_key', $user_id);
		//echo $bar;
		//$api_key     = get_user_option($user_id, 'uptime_robot_api_key');
		//echo $api_key;
		$str = "api_key=".$api_key."&format=json";
		//	echo $str;
		// https://api.uptimerobot.com/v2/getMonitors?api_key=&format=json
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.uptimerobot.com/v2/getMonitors",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $str,
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		$json = json_decode($response);
		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			//echo $response;
		}
		//print_r($json->stat);
		
/*

		foreach ($json->monitors as $monitor) {
						echo '<h4>Monitor: <strong>'.$monitor->friendly_name.'</strong> ('.$monitor->interval.' Interval)</h4>';
						echo '<h4>Status: ('.$monitor->status.' Up/Down Status)</h4>';
						echo '<ul style="margin-left:2em;">';
						// log events
						$i = 0;

						foreach ($monitor->log as $event) {
							switch ($event->type) {
								case 1:
									$prefix = '<span style="color:#800">Down at ';
									break;
								case 2:
									$prefix = '<span>Up at ';
									break;
								case 99:
									$prefix = '<span style="color:#bbb">Paused at ';
									break;
								case 98:
									$prefix = '<span>Started at ';
									break;
							}
							echo '<li class="log-event" style="list-style:disc;">'.$prefix.$event->datetime.'</span></li>';
							$i++;
							if ($i > $num_log_items) { 
								break; 
							}
						}
						echo '</ul>';
					}
				//echo 'Print out dashboard here';
			*/

		echo '<div class = "updown-container">';
			echo '<h2>Up/down Monitoring</h2>';

		$idea_status = $json->monitors[1]->status;
		if($idea_status == 2){
			echo 'All OK'; ?>
			<i class="fa fa-check" aria-hidden="true"></i>
			<?php
		}
		if($idea_status == 9){
			echo 'Down'; ?>
		<i class="fa fa-times" aria-hidden="true"></i>
		<?php
		}

		echo '</div>';

		echo do_shortcode('[uptime-robot-response]');

	


		//echo do_shortcode('[uptime-robot-response monitors="775925288"]');