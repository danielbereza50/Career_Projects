<div class="xml-form-container">
    <div class="xml-form-wrapper">
        <div class="xml-form-item">
            <form id="xml-upload-form" enctype="multipart/form-data">
                <input type="hidden" name="action" value="xml_upload">
                <input type="file" name="xml_files[]" accept=".xml" multiple required>
                <button type="submit">Upload XML</button>
            </form>
        </div>
    </div>
</div>

 $('#xml-upload-form').submit(function(event) {
			event.preventDefault(); // Prevent default form submission

			var formData = new FormData(this);
			var uploadStatus = $('#upload-status');

			$.ajax({
				url: ajax_object.ajax_url,
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				beforeSend: function() {
					uploadStatus.html('Uploading...');
				},
				success: function(response) {
					uploadStatus.html(response);
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});
		
		
		
add_action('wp_ajax_sync_files', 'handle_sync_files');
add_action('wp_ajax_nopriv_sync_files', 'handle_sync_files');
function handle_sync_files() {
	
	//$csv_file_path = get_template_directory() . '/Incident_Data/your_csv_file.csv'; // Replace with your CSV file name
    $xml_file_path = get_template_directory() . '/XML_Data/2024-00000485.xml';
    
 	 // Load the XML file
    $xml = simplexml_load_file($xml_file_path);

    // Check if <Dispatch_Notified_Dttm> exists, if not, add it with value "0"
    if (!isset($xml->Times->Dispatch_Notified_Dttm)) {
        // Create a new <Dispatch_Notified_Dttm> element with a value of "0"
        $dispatch_notified_dttm = $xml->Times->addChild('Dispatch_Notified_Dttm', '0');
        
        // Find the position of <First_Unit_Arrival_Dttm>
        $position = 0;
        foreach ($xml->Times->children() as $child) {
            if ($child->getName() === 'First_Unit_Arrival_Dttm') {
                break;
            }
            $position++;
        }
        
        // Move <Dispatch_Notified_Dttm> to the correct position
        $dispatch_notified_dttm_dom = dom_import_simplexml($dispatch_notified_dttm);
        $first_unit_arrival_dttm_dom = dom_import_simplexml($xml->Times->First_Unit_Arrival_Dttm);
        $xml_dom = dom_import_simplexml($xml->Times);
        $xml_dom->insertBefore($dispatch_notified_dttm_dom, $first_unit_arrival_dttm_dom);
    }

    // Save the modified XML back to the file
    $xml->asXML($xml_file_path);
	
	
 
    // Make sure to exit after processing the AJAX request
    wp_die();
}



	
	
	