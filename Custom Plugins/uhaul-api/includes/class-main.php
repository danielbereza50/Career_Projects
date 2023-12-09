<?php
// [display_uhaul entity="1035538"]
add_shortcode('display_uhaul', 'do_uhaul');
function do_uhaul($atts){
	ob_start();
	
	$atts = shortcode_atts(array(
        'entity' => '', 
    ), $atts);
	
	// Address : 10 Hill Street 
	// entiity ID: 23324234234423
	


    $entity = $atts['entity'];
	//$url = "https://api.webselfstorage.com/v3/{$location_id}";
	//$url = "https://api.webselfstorage.com/v3/paymentPortalUrl/{$location_id}";
	//$url = "https://api.webselfstorage.com/v3/movein/{$location_id}/cost "; - X
    //$url = "https://api.webselfstorage.com/v3/location/{$location_id}/waitinglist";
	//$url = "https://api.webselfstorage.com/v3/location/{$location_id}/rentroll";
	
    $url_location = "https://api.webselfstorage.com/v3/location/{$entity}";
	$url_image = "https://api.webselfstorage.com/v3/location/{$entity}/images";
	
	$headers = array(
    	'Authorization' => 'Bearer XXXXXXXXXXXX',
	);
	$response_location = wp_remote_get($url_location, array(
		'headers' => $headers,
	));
	$response_images = wp_remote_get($url_image, array(
		'headers' => $headers,
	));

	
	if (is_array($response_location) && !is_wp_error($response_location)) {
		$response_location_code = wp_remote_retrieve_response_code($response_location);
		if ($response_location_code === 200) {
			$data_location = json_decode(wp_remote_retrieve_body($response_location));
			$data_images = json_decode(wp_remote_retrieve_body($response_images));
			
			$postalCode = $data_location->location->address->postalCode;
			$city = $data_location->location->address->city;
			$units = $data_location->location->units;
			$imageLinks = $data_images->imageLinks;
			$lastImageUrl = end($imageLinks);
			$count = 0;
			
			// $data_images
			// echo '<pre>';
			//	print_r($data_location);
			// echo '<pre>';

			echo '<div class = "unit-top-txt">Available Units (All Sizes are Approximate) </div>';	
			echo '<div class = "search-filter">';
				echo '<div class = "filter-item">';
					echo '<label for="filter">Sort and Filter</label>';
				echo '</div>';
				echo '<div class = "filter-item">';
					echo '<div>Unit Size: </div>';
					echo '<select id="unitSize" class="">
                                    <option selected="" value = "any">All Sizes</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                          </select>';
				echo '</div>';
				echo '<div class = "filter-item">';
					echo '<div>Unit Type:</div>';
					echo '<select id="unitType" class="">
                                    <option selected="" value = "any">Select Unit Type</option>
                                    <option value="driveupstorage">Drive Up Storage</option>
                                    <option value="uboxContainers"> Portable Storage containers</option>
                          </select>';
				echo '</div>';
				echo '<div class = "filter-item" id = "item-hide">';
					echo '<input type="checkbox" id="rent" name="rent" value="1">';
					echo '<label for="rent"> Filter rooms available for Rent Now</label>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class = "unit-first-item">';
				echo '<div class = "unit-last-img">';
			 		echo '<img src="' . $lastImageUrl . '" alt="Image" width="300" height="300">';
				echo '</div>';
				$descriptions = $data_location->location->locationFeatures;
				foreach ($units as $unit) {
					$unitdescriptionsField = $unit->sizeDescriptionsField[0];
					if (strpos($unit->sizeDescriptionsField[0], 'Drive Up') !== false) {
   					 echo '<div class="unit-description-top" id = "drive-up">';
					 	echo '<span class = "description-title">' . $unitdescriptionsField . '</span>';
						echo '<br>';
						foreach ($descriptions as $description) {
							echo '<span class = "">'.$description->description . '</span>, ';
						}
					 echo '</div>';
					}elseif(strpos($unit->sizeDescriptionsField[0], 'Portable') !== false) {
						 echo '<div class="unit-description-top" id = "portable">';
							echo '<span class = "description-title">' . $unitdescriptionsField .'</span>';
							echo '<br>';
							foreach ($descriptions as $description) {
								echo '<span class = "">'.$description->description . '</span>, ';
							 }
						 echo '</div>';
					}else{
						//
					}
					break;
				}
			
			echo '</div>';
			
		   // columns: image, description, price, buttons
		   foreach ($units as $unit) {
			//echo $unit->unitSize;
			//echo $unit->width;
			   
		 	   if($unit->width <= 5){	   
				     echo '<div class = "uhaul-row" id = "small">';
			    }elseif($unit->width > 5){
				     echo '<div class = "uhaul-row" id = "medium">';
			    }else{
				     //  
			    }
				echo '<div class = "uhaul-column">';
					if (isset($data_location->location->facilityFeatures)) {
						$facilityFeatures = $data_location->location->facilityFeatures;
				
						//echo '<pre>';
						//print_r($facilityFeatures1);
						//echo '<pre>';
							$imageLinks = $data_images->imageLinks;
							//echo $count;
							//$count_1 = count($imageLinks);
							//echo($count_1); // 7
							//echo '<br>';
							//echo($count); // 0, 1
							//while($count <= $count_1){
							for ($i = 0; $i < 1; $i++) {
								// $facilityFeatures[$count]->imageUrl
								if (isset($imageLinks[$count])) {
									$imageLink = $imageLinks[$count];
									echo '<div class="location-image-wrapper">';
									echo '<div class="location-image-item" style="background-image: url(' . $imageLink . ');"></div>';
									echo '</div>';
								} else {
									$imageLink = $imageLinks[0];
									echo '<div class="location-image-wrapper">';
									echo '<div class="location-image-item" style="background-image: url(' . $imageLink . ');"></div>';
									echo '</div>';
								}
							}		
					}
				echo '</div>';// end of column
				echo '<div class = "uhaul-column">';
				if (isset($data_location->location) && isset($data_location->location->units) && is_array($data_location->location->units) && isset($data_location->location->units[0])) {
				
					//foreach ($units as $unit) {
						echo '<div class="unit-container">';
							echo '<div class="unit-size">' . $unit->unitSize . '</div>';
							echo '<div class="unit-description">' . $unit->sizeDescriptionsField[0] . '</div>';
						echo '</div>';
					//}	
				}
				echo '</div>';// end of column
				echo '<div class = "uhaul-column">';
					if (isset($data_location->location) && isset($data_location->location->units) && is_array($data_location->location->units) && isset($data_location->location->units[0])) {
				
					 // print_r($unit);  
					  echo '<div class="monthly-container">';
						//foreach ($units as $unit) {
							echo '<div class="monthly-txt">';
							echo '<div>$' . $unit->monthly . '.00</div>';
							echo '<div>Per Month</div>';
							echo '</div>';
						//}
						echo '</div>';	
				}
				echo '</div>';// end of column
				echo '<div class = "uhaul-column">';
					//foreach ($units as $unit) {
							echo '<div class = "button-wrapper">';
							echo '<a href="https://www.uhaul.com/Locations/Self-Storage-near-' . $city . $postalCode . '/' . $entity . '" target="_blank"><button class="button-item" type="button">Rent Now</button></a>
						  <a href="https://www.uhaul.com/Locations/Self-Storage-near-' . $city  . $postalCode . '/' . $entity . '" target="_blank"><button class="button-item" type="button">
							Reserve
						  </button></a>';
							echo '</div>';
			   				echo '<div class = "reservation-txt">';
								echo '<div class = "units-left">' . $unit->vacantUnits . ' Units Left!</div>';
								echo '<div class = "rent-now">Rent Now to Secure Your Room! </div>';
			   				echo '</div>';
			//}
			echo '</div>'; // end of column
		echo '</div>'; // end of row
	 	  $count++;
		} // end of foreach loop
	  } else {
			echo 'Error: ' . $response_code;
	  }
	} else {
		echo 'Error: Failed to make the API call';
	}
	
	return ob_get_clean();
}