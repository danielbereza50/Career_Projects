<?php

class Incidents {

   private $wpdb;
	
   public function __construct() {
	    global $wpdb;
        $this->wpdb = $wpdb;
	   
        add_action('wp_ajax_insert_incidents', array($this, 'insert_incidents'));
        add_action('wp_ajax_nopriv_insert_incidents', array($this, 'insert_incidents'));

    }
    public function get_incident_table() { 
		
		print_header();
		
		$html .= '<div class = "form-title">Haz Mat Incident</div>
					 <hr class = "under-title">';
		
		$html .= '<div class="incidents-container">
					<div class="incidents-column">
						<button class="incidents-button create-new" id = "create-new">Create New Incident</button>
					</div>
					<div class="incidents-column">
						<button class="incidents-button select-existing" id = "select-existing">Select an Existing Incident</button>
					</div>
		</div>';
		
			$html .= '<div class="create-new-container" id="create-new-container">';
				$html .= '    <label for="address">Address:</label>';
				$html .= '    <input type="text" id="address" name="address" placeholder="Enter Address" required>';

				$html .= '    <label for="type-of-incident">Type of Incident:</label>';
				$html .= '    <input type="text" id="type-of-incident" name="type_of_incident" placeholder="Enter Type of Incident" required>';
				$html .= '    <button type="submit" id="submit-new" class = "submit-new">Submit</button>';
		
				$html .= '<div id="alert"></div>';
				$html .= '<div id="results"></div>';
		
		
			$html .= '</div>';
		
		
		$html .= '<div id="select-existing-container">';

		// Query to select all records from wp_incidents
		$query = "SELECT * FROM {$this->wpdb->prefix}incidents";
		$results = $this->wpdb->get_results($query, ARRAY_A);

		if (!empty($results)) {
			foreach ($results as $record) {
				
				$html .= '<div class="existing-record">';
				$html .= '    <p class="record-id">ID: ' . $record['ID'] . '</p>';
				$html .= '    <p class="record-address">Address: ' . $record['address'] . '</p>';
				$html .= '    <p class="record-type">Type of Incident: ' . $record['type_of_incident'] . '</p>';
				$html .= '    <p class="record-created-at">Created At: ' . $record['created_at'] . '</p>';
				$html .= '    <button class="go-to-calculator-button">
									<a href = "/calculator?ID='.$record['ID'].'">Go to Calculator</a></button>';
				$html .= '</div>';
				
			}
		} else {
			$html .= '<p class="no-records">No records found</p>';
		}

		$html .= '</div>';
		
        $html .= '<div class="modal"></div>';
		
		
        echo $html;
		exit();
	}
	public function insert_incidents(){
		/*
			
		*/
		 // Retrieve data from the AJAX request
        $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
        $type_of_incident = isset($_POST['type_of_incident']) ? sanitize_text_field($_POST['type_of_incident']) : '';

        // Validate and insert data into the wp_incidents table
        if (!empty($address) && !empty($type_of_incident)) {
            $table_name = $this->wpdb->prefix . 'incidents';

            $sql = $this->wpdb->prepare(
                "INSERT INTO $table_name (address, type_of_incident) VALUES (%s, %s)",
                $address,
                $type_of_incident
            );

            $this->wpdb->query($sql);
			
			 // Get the ID of the last inserted record
			$last_inserted_id = $this->wpdb->insert_id;

			echo 'Incident inserted successfully!
				<button class = "view-record" id="view-record" data-id="' . $last_inserted_id . '">
					<a href = "/calculator?ID='.$last_inserted_id.'">Go to Calculator</a>
				</button>';
			
			// Echo JavaScript code to redirect after HTML is printed
			echo '<script>
				jQuery(document).ready(function($) {
					// Document is ready, now you can execute jQuery code

					// Redirect after a delay (adjust the delay as needed)
					setTimeout(function() {
						window.location.href = "/calculator?ID=' . $last_inserted_id . '";
					}, 2000); // 2000 milliseconds (2 seconds)
				});
			</script>';
			

        } else {
            echo 'Invalid data provided.';
        }
        wp_die(); // Always include this to terminate the script properly
	}
	
	
	
	
	
	
	
}
// Instantiate the class
$Incidents = new Incidents();