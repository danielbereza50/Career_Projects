<?php

// https://wordpress-1166095-4073655.cloudwaysapps.com/calculator?ID=23

class CalculatorForm {

   private $wpdb;
   private $calculatedID;
	
   public function __construct() {
	    global $wpdb;
        $this->wpdb = $wpdb;
	   
	    // Set the value of $calculatedID
        $this->calculatedID = isset($_GET['ID']) ? $_GET['ID'] : null;
	   
        add_action('wp_ajax_data_fetch', array($this, 'data_fetch'));
        add_action('wp_ajax_nopriv_data_fetch', array($this, 'data_fetch'));
	   
	    add_action('wp_ajax_save_meta', array($this, 'save_meta'));
        add_action('wp_ajax_nopriv_save_meta', array($this, 'save_meta'));
	   
	    add_action('wp_ajax_display_history', array($this, 'display_history'));
        add_action('wp_ajax_nopriv_display_history', array($this, 'display_history'));
	   
	    add_action('wp_ajax_delete_record', array($this, 'delete_record'));
        add_action('wp_ajax_nopriv_delete_record', array($this, 'delete_record'));
	   
	   

    }
	public function format_number($number) {
		if ($number >= 10000) {
			return number_format($number, 2, '.', ',');
		} elseif ($number >= 1000) {
			return number_format($number, 1, '.', ',');
		} else {
			return number_format($number, 2, '.', ',');
		}
	}
    public function get_calculator_form() { 
		
		print_header();

		// SELECT address, type_of_incident FROM wp_incidents WHERE ID = 59
		
		$html .= '<div class = "form-title">Chemical / Meter Info</div>
				 <hr class = "under-title">';
        $html .= '
            <form id="percentageForm" class="calculator-form">
                <div class="form-container">
                    <div class="form-item chemical">
                        ' . $this->get_chemical_dropdown() . '
                    </div>
                </div>
            </form>
        ';
		
		// Table name
		$table_name = $this->wpdb->prefix . 'incidents';

 		// Your SQL query
        $sql = $this->wpdb->prepare(
            "SELECT address, type_of_incident FROM $table_name WHERE ID = %d",
            $this->calculatedID
        );

        // Execute the query
        $result = $this->wpdb->get_results($sql);

        // Output the results (for testing purposes)
        foreach ($result as $row) {
            // Print the values within your HTML structure
            $html .= '<div class="incident-fields">';
            $html .= '<p>Address: ' . esc_html($row->address) . '</p>';
            $html .= '<p>Type of Incident: ' . esc_html($row->type_of_incident) . '</p>';
            $html .= '</div>';
        }
		
        $html .= '<div id="results" class="calculator-container">Please select a chemical</div>';
        $html .= '<div class="modal"></div>';

        echo $html;
		
		exit();
	}
		
	public function get_chemical_dropdown() {

		// Table name
		$table_name = $this->wpdb->prefix . 'incidents_meta';

		// Your Incident_id value to search for duplicates
		$incident_id_to_search = $this->calculatedID;

		// Query to find records with the same Incident_id
		$query = $this->wpdb->prepare("
			SELECT *
			FROM $table_name
			WHERE Incident_id = %s
		", $incident_id_to_search);

		// Fetch the results
		$results = $this->wpdb->get_results($query);

		// Get the chemical ID from the results
		$chemical_id = !empty($results[0]->chemical) ? $results[0]->chemical : '';

		// Query to get chemicals
		$query = "SELECT ID, post_title FROM {$this->wpdb->prefix}posts WHERE post_type = 'chemicals' AND post_status = 'publish'";
		$chemical_results = $this->wpdb->get_results($query);

		// Initialize the dropdown
		$dropdown = '<select id="chemical" name="chemical"';

		// Check if chemical_id is not empty to disable the select field
		if (!empty($chemical_id)) {
			$dropdown .= ' disabled="disabled"';
			echo '<button id = "auto-select">Auto Select</button>';
		}

		$dropdown .= '>';
		$dropdown .= '<option value="">Choose chemical</option>';

		// Loop through chemicals to build the options
		foreach ($chemical_results as $result) {
			$option_value = esc_attr($result->ID);
			$option_label = esc_html($result->post_title);
			$selected = ($chemical_id == $option_value) ? 'selected="selected"' : '';

			$dropdown .= '<option value="' . $option_value . '" ' . $selected . '>' . $option_label . '</option>';
		}

		$dropdown .= '</select>';

		return $dropdown;

		
	
	}
	
	public function data_fetch(){
		/*
			 _lel_value
			 _uel_value
			 _idlh_value
			 _cf_value
			 _flash_point_value
			 _vapor_density_value
		*/

		 $chemical_id = isset($_POST['chemical']) ? absint($_POST['chemical']) : 0;

        if ($chemical_id > 0) {
            $query = $this->wpdb->prepare("
                SELECT meta_key, meta_value
                FROM {$this->wpdb->postmeta}
                WHERE post_id = %d
                    AND meta_key IN ('_lel_value', '_uel_value', '_idlh_value', '_cf_value', '_flash_point_value', '_vapor_density_value')
            ", $chemical_id);

            $results = $this->wpdb->get_results($query);
            $response = '';

			foreach ($results as $result) {
				$meta_key = $result->meta_key;
				$meta_value = $result->meta_value;

				// Remove underscore and capitalize first letter of each word
				$formatted_key = ucwords(str_replace('_', ' ', $meta_key));

								
				// Convert to float for calculations
				$meta_value_float = floatval($meta_value);
				
				//$response .= '<input class = "extra-data-input" type="text" value="' . $formatted_key . ': ' . $meta_value . '" readonly>'; 
				
				if ($meta_key === '_lel_value' || $meta_key === '_uel_value') {
					 // Extract key name after the first underscore
					$underscore_position = strpos($meta_key, '_');
					$id_value = $underscore_position !== false ? substr($meta_key, $underscore_position + 1) : '';
					$response .= '<input class="extra-data-input" type="text" id="' . $id_value . '" value="' . $formatted_key . ': ' . $meta_value . ' %" readonly>';
				}
				
/*
			if ($meta_key === '_idlh_value') {
				
				$o2Percentage = 20.8; // Default value

				// Check if PPM is greater than 5000
				if ($meta_value_float > 5000) {
					// Calculate O2 percentage based on PPM and intervals
					$intervals = floor(($meta_value_float - 5000) / 5000);
					$o2Percentage -= $intervals * 0.1; // Decrease by 0.1% for every 5,000 PPM interval

					// Format the number using the format_number function
					$formatted_number_idlh = $this->format_number($meta_value);

					// Create the input field with the appropriate color and O2 percentage
					$response .= '<input class="extra-data-input" type="text" value="' . $formatted_key . ': ' . $formatted_number_idlh . ' PPM" readonly>';
					$response .= '<p style="color: blue;">PPM - IDLH at ' . number_format($o2Percentage, 1) . ' % O2</p>';
					
				} else {
					// Format the number for the else case
					$formatted_number_idlh = $this->format_number($meta_value);

					// Create the input field without the blue text
					$response .= '<input class="extra-data-input" id = "idlh-value" type="text" value="' . $formatted_key . ': ' . $formatted_number_idlh . ' PPM" readonly>';
				}
			}
				
	*/			
			
				if ($meta_key === '_idlh_value') {

					// Format the number for the else case
					$formatted_number_idlh = $this->format_number($meta_value);

					// Create the input field without the blue text
					$response .= '<input class="extra-data-input" id = "idlh-value" type="text" value="' . $formatted_key . ': ' . $formatted_number_idlh . ' PPM" readonly>';
					
			}
				
				
				// Add logic for _vapor_density_value
				if ($meta_key === '_vapor_density_value') {
					$vapor_density = $meta_value_float;

					// Check if the value is less than 1
					if ($vapor_density < 1) {
						$response .= '<input class="extra-data-input" id = "vapor_density" type="text" value="' . $formatted_key . ': ' . $vapor_density . '" readonly>';
						$response .= '<p class="extra-data-text vapor-warning">LIGHTER THAN AIR. Check high areas for collecting gas.</p>';
					} else {
						$response .= '<input class="extra-data-input" id = "vapor_density" type="text" value="' . $formatted_key . ': ' . $vapor_density . ' " readonly>';
						$response .= '<p class="extra-data-text vapor-warning">HEAVIER THAN AIR. Check low areas for collecting gas.</p>';
					}
				}
				

				// Calculate Actual LEL and UEL based on the current meta key
				if ($meta_key === '_lel_value') {
					$first_lel = $meta_value_float * 10000; // Multiply by 10,000
				} elseif ($meta_key === '_uel_value') {
					$first_uel = $meta_value_float * 10000; // Multiply by 10,000
				}else{
					
				}
				// Calculate $c_value based on _cf_value
				if ($meta_key === '_cf_value') {
					
					$cf_value = $meta_value_float;
					
					$c_value = $first_lel / 100;
					$e_value = $c_value * $meta_value_float;
					// Multiply $first_lel and $first_uel by _cf_value and store the results in new variables
					$multiplied_lel = $first_lel * $meta_value_float;
					$multiplied_uel = $first_uel * $meta_value_float;
				}
					
				// Add logic for _idlh_value
				if ($meta_key === '_idlh_value') {
					$idlh = $meta_value_float;
				}
				
			}
			
			// Check values before division
			// var_dump($idlh, $e_value);

			// Corrected calculation for $idlh
			if ($e_value != 0) {
				$idlh = $idlh / $e_value;
				
				 // Limit to 2 decimal places
  				 $idlh = number_format($idlh, 2);
			} else {
				$idlh = "Undefined (Division by zero)";
			}
			
			$divided_lel = $multiplied_lel / 10000;
			$divided_uel = $multiplied_uel / 10000;
			
			
			// Format the number using the format_number function
			$formatted_number_lel = $this->format_number($first_lel);
			$formatted_number_uel = $this->format_number($first_uel);
			$formatted_number_e_value = $this->format_number($e_value);
			
			//echo $first_lel;
			
			// Calculate the O2 displacement based on the LEL value
			$o2_displacement = 20.9 - floor($first_lel / 5000) * 0.1;

			// Ensure that the O2 displacement does not go below the minimum value (e.g., 20.0%)
			$o2_displacement = max(20.0, $o2_displacement);
			
			
			$response .= '<input id = "first_a" class = "extra-data-input" type="text" value="LEL PPM: ' . $formatted_number_lel . ' PPM" readonly>';
			$response .= '<p class = "blue">O2 Displacement: ' . number_format($o2_displacement, 1) . '%</p>';
			
			$response .= '<input id = "first_b" class = "extra-data-input" type="text" value="UEL PPM: ' . $formatted_number_uel . ' PPM" readonly>';
			
		//	$response .= '<input id = "first_a" class = "extra-data-input" type="text" value="A) First A: ' . $first_lel . ' PPM" readonly>';
		//	$response .= '<input id = "first_b" class = "extra-data-input" type="text" value="B) First B: ' . $first_uel . ' PPM" readonly>';

		//	$response .= '<input id = "c_value" class = "extra-data-input" type="text" value="C) 1% of LEL in PPM: ' . $c_value . ' PPM" readonly>';
			
			$response .= '<input id = "cf_value" class = "extra-data-input" type="hidden" value="' . $cf_value . '" readonly>';

			$response .= '<input id = "actual_lel" class = "extra-data-input" type="text" value="Actual LEL: ' . $divided_lel . '%" readonly>';
			$response .= '<input id = "actual_uel" class = "extra-data-input" type="text" value="Actual UEL: ' . $divided_uel . '%" readonly>';

			$response .= '<input id = "lel_meter" class = "extra-data-input" type="text" value="1% LEL on Meter in ppm: ' . $formatted_number_e_value . ' PPM" readonly>';
			
			//$response .= '<input id = "lel_meter" class = "extra-data-input" type="text" value="E) 1% LEL on Meter in ppm: ' . $e_value . ' PPM" readonly>';
			$response .= '<input id = "idlh" class = "extra-data-input" type="text" value="IDLH% LEL on Meter: ' . $idlh . ' %" readonly>';
			
			echo $response;
			
			echo '<div class="extra-info-container">
			
			
			
			<div class = "meter-readings">Meter Readings</div>
			
						<div class="extra-info-row">
							<input class = "extra-data-input" type="text" name="location" id="location" class="extra-info-input" placeholder = "Please enter location" required>
						</div>

						<div class="extra-info-row">
							<input class = "extra-data-input" type="text" name="meter_reading" id="meter_reading" class="extra-info-input" placeholder = "Enter the LEL% Reading on the Meter" required>
						</div>


						<div class="button-container">
						  <button type="submit" class="button submit-button" id="submit-extra">CALCULATE</button>
						  <button type="submit" class="button submit-save" id="submit-save">SAVE</button>
						  <button type="submit" class="button submit-history" id="submit-history">HISTORY</button>
						  <button type="submit" class="button submit-back" id="submit-back"><a href = "/haz-mat-incident">BACK</a></button>
						</div>
						
					</div>';
			?>	
			<div class="extra-info-results"></div>
			<div id = "extra-info-results-previous"></div>


			<div id="test"></div>
			<?php
		}
		die();
	}
	public function save_meta(){
		// Get the incident ID and other common data
		$incidentID = isset($_POST['incidentID']) ? absint($_POST['incidentID']) : 0;
		$chemicalID = isset($_POST['chemicalID']) ? absint($_POST['chemicalID']) : 0;

		// Get the table prefix
		$table_prefix = $this->wpdb->prefix;
		
	/*
		 echo '<pre>';
			print_r($_POST['records']);
		 echo '</pre>';
		*/
	
		// Check if records array is set in the POST data
		if (isset($_POST['records']) && is_array($_POST['records'])) {
			foreach ($_POST['records'] as $record) {
				$date_time = $record['date_time'];
				$location_print = $record['location_print'];
				$actual_lel = $record['actual_lel'];
				$lel_warning = $record['lel_warning'];
				$lel_on_meter = $record['lel_on_meter'];
				$idlh_warning = $record['idlh_warning'];
				

				// Check if a similar record already exists
				$existing_record = $this->wpdb->get_row(
					$this->wpdb->prepare(
						"SELECT * FROM {$table_prefix}incidents_meta
						WHERE Incident_id = %d
						AND chemical = %d
						AND time_stamp = %s
						AND location = %s
						AND percent_actual_lel = %s
						AND (lel_warning = %s OR lel_warning IS NULL)
						AND (idlh_warning = %s OR idlh_warning IS NULL)",
						$incidentID,
						$chemicalID,
						$date_time,
						$location_print,
						$actual_lel,
						$lel_warning,
						$idlh_warning
					)
				);
				
				//print_r($existing_record);

				
				// If no existing record found, insert the new record
				if (!$existing_record) {
					$this->wpdb->insert(
						$table_prefix . 'incidents_meta',
						array(
							'Incident_id' => $incidentID,
							'chemical' => $chemicalID,
							'time_stamp' => $date_time,
							'location' => $location_print,
							'percent_actual_lel' => $actual_lel,
							'lel_warning' => $lel_warning,
							'lel_on_meter' => $lel_on_meter,
							'idlh_warning' => $idlh_warning,
						),
						array('%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s')
					);

					// Check for success for each record
					if ($this->wpdb->insert_id) {
						// Insert successful
						# echo "Data for record inserted successfully!";
					} else {
						// Insert failed for this record
						# echo "Error inserting data for record!";
					}
				} else {
					// Skip insertion if a similar record already exists
					# echo "Record with similar values already exists. Skipped insertion.";
				}
				
				
				
				
			}
		}
		
		
		
		
		// echo $chemicalID;
		
		// Make sure to exit after sending the response
		exit();
		
	}
	public function display_history(){
		/*
		 
		https://wordpress-1166095-4073655.cloudwaysapps.com/calculator?ID=23
		
		Acetone
		
		SELECT *
		FROM wp_incidents_meta
		WHERE chemical = 45 AND Incident_id = 23
		ORDER BY ID DESC;		
		
		*/
		
		$chemicalID = isset($_POST['chemicalID']) ? absint($_POST['chemicalID']) : 0;
		$incidentID = isset($_POST['incidentID']) ? absint($_POST['incidentID']) : 0;

		// Query to select records where chemical is equal to $chemicalID and Incident_id is equal to $incidentID
		$query = $this->wpdb->prepare(
			   "SELECT * 
				FROM {$this->wpdb->prefix}incidents_meta 
				WHERE chemical = %d 
				AND Incident_id = %d 
				ORDER BY ID DESC",
			$chemicalID,
			$incidentID
		);

		// Fetch all records as an associative array
		$records = $this->wpdb->get_results($query, ARRAY_A);
		//print_r($records);

		 foreach ($records as $record) : ?>

				<div class="record">
					
					
					<input type="text" id="date-time" class="existing-record read-only-text" value="<?= $record['time_stamp'] ?>" readonly="">
					<input type="text" id="location-print" class="existing-record read-only-text" value="<?= $record['location'] ?>" readonly="">
					<input type="text" id="actual-lel" class="existing-record read-only-text" value="<?= $record['percent_actual_lel'] ?>" readonly="">
					
					<input type="text" id="lel_warning" class="existing-record read-only-text red <?= ($record['lel_warning'] == 'DANGER - IN THE EXPLOSIVE RANGE.') ? 'red' : '' ?>" value="<?= $record['lel_warning'] ?>" readonly="">
					
					<input type="text" id="lel-on-meter" class="existing-record read-only-text" value="<?= $record['lel_on_meter'] ?> PPM" readonly="">
					
					<input type="text" id="idlh_warning" class="existing-record read-only-text red <?= ($record['idlh_warning'] == 'Warning - Environment is above the IDLH. Wear protective gear.') ? 'red' : '' ?>" value="<?= $record['idlh_warning'] ?>" readonly="">
					<input type="hidden" id="record_id" class="record_id" data-id= "<?php echo $record['ID'] ;?>"readonly="">
					<button class="delete-button" id = "delete-button">Delete</button>
					
				</div>
			<?php endforeach; 
				// Always exit to avoid extra output
				wp_die();
		
	}
	public function delete_record(){

		// Get the record ID from the AJAX request
		$record_id = isset($_POST['recordID']) ? intval($_POST['recordID']) : 0;

		// Replace 'your_table_name' with your actual table name
		$table_name = $this->wpdb->prefix . 'incidents_meta';

		// Prepare and execute the SQL query
		$sql = $this->wpdb->prepare("DELETE FROM $table_name WHERE ID = %d", $record_id);
		$result = $this->wpdb->query($sql);
		
		// echo $record_id;
		
		// Always exit to avoid extra output
		wp_die();
	}
	
	
	
	
	

	
	

	
	
}
// Instantiate the class
$calculator_form = new CalculatorForm();