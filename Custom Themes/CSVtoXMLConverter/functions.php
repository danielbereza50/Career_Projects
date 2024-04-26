<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/public/js/custom-theme.js',
		array( 'jquery' )
	);





	

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


add_action('wp_enqueue_scripts', 'enqueue_csv_upload_scripts');
function enqueue_csv_upload_scripts() {
    wp_enqueue_script('csv-xml-upload-script', plugin_dir_url(__FILE__) . '/public/js/custom-theme.js', array('jquery'), null, true);
    wp_localize_script('csv-xml-upload-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}


add_action('wp_ajax_csv_upload', 'handle_csv_upload');
add_action('wp_ajax_nopriv_csv_upload', 'handle_csv_upload');
function handle_csv_upload() {
	
	
    $csv_upload_directory = get_template_directory() . "/Incident_Data/";
    $new_file_name = "IncidentData.csv"; // Change this to whatever name you desire
    
	$xml_upload_directory = get_template_directory() . "/XML_Data/";
	
	 // Remove existing files from the directory
    $files = glob($xml_upload_directory . '*'); // Get all files in the directory
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); // Remove the file
        }
    }
	
	
    if ($_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["csv_file"]["tmp_name"];
        // Rename the file
        $destination = $csv_upload_directory . $new_file_name;

        if (move_uploaded_file($tmp_name, $destination)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error moving file to destination directory.";
        }
    } else {
        echo "Error uploading file. Error code: " . $_FILES["csv_file"]["error"];
    }

	
    wp_die();
}


add_action('wp_ajax_xml_upload', 'handle_xml_upload');
add_action('wp_ajax_nopriv_xml_upload', 'handle_xml_upload');

function handle_xml_upload() {
    $xml_upload_directory = get_template_directory() . "/XML_Data/";

    // Check if files were uploaded
    if (!empty($_FILES['xml_files']['name'][0])) {
        $file_count = count($_FILES['xml_files']['name']);

        for ($i = 0; $i < $file_count; $i++) {
            $file_name = $_FILES['xml_files']['name'][$i];
            $tmp_name = $_FILES['xml_files']['tmp_name'][$i];
            $destination = $xml_upload_directory . $file_name;

            if (move_uploaded_file($tmp_name, $destination)) {
                echo "File $file_name uploaded successfully!<br>";
            } else {
                echo "Error moving file $file_name to destination directory.<br>";
            }
        }

        // Print out the count of items uploaded
        echo "Total files uploaded: $file_count<br>";
    } else {
        echo "No files were uploaded.<br>";
    }

    wp_die();
}






add_action('wp_ajax_sync_files', 'handle_sync_files');
add_action('wp_ajax_nopriv_sync_files', 'handle_sync_files');
function handle_sync_files() {
	
	
	
	$csv_file_path = get_template_directory() . '/Incident_Data/IncidentData.csv'; // Replace with your CSV file name
	$xml_folder_path = get_template_directory() . '/XML_Data/'; // Folder containing XML files

	// Get a list of all XML files in the folder
	$xml_files = glob($xml_folder_path . '*.xml');

	foreach ($xml_files as $xml_file_path) {
		// Load the XML file
		$xml = simplexml_load_file($xml_file_path);

		// Find the value of <Incident_Number>
		$incident_number = (string)$xml->Other->Incident_Number;

		// Read the CSV file into an associative array
		$csv_data = array_map('str_getcsv', file($csv_file_path));
		$headers = array_shift($csv_data);
		$csv_data = array_map(function($row) use ($headers) {
			return array_combine($headers, $row);
		}, $csv_data);

		// Find the row in the CSV file where IncidentNumber matches
		$csv_row = null;
		foreach ($csv_data as $row) {
			if ($row['IncidentNumber'] === $incident_number) {
				$csv_row = $row;
				break;
			}
		}

		// If CSV row found, update XML with Dispatch_Notified_Dttm
		if ($csv_row) {
			// Parse date-time string from CSV file
			$csv_date_time = strtotime($csv_row['CallDateTime']);

			// Format date-time to desired format
			$formatted_date_time = date('Y-m-d\TH:i:s', $csv_date_time);

			// Check if <Dispatch_Notified_Dttm> exists, if not, add it with the formatted date-time value
			if (!isset($xml->Times->Dispatch_Notified_Dttm)) {
				// Create a new <Dispatch_Notified_Dttm> element with the formatted date-time value from the CSV file
				$dispatch_notified_dttm = $xml->Times->addChild('Dispatch_Notified_Dttm', $formatted_date_time);

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
			} else {
				// Update the existing <Dispatch_Notified_Dttm> element with the formatted date-time value from the CSV file
				$xml->Times->Dispatch_Notified_Dttm = $formatted_date_time;
			}

			// Save the modified XML back to the file
			$xml->asXML($xml_file_path);
		}

		
		
	}	
	
 
	
    // Make sure to exit after processing the AJAX request
    wp_die();
}


add_action('wp_ajax_download_xml_folder', 'download_xml_folder');
add_action('wp_ajax_nopriv_download_xml_folder', 'download_xml_folder');
function download_xml_folder() {
	
	
    // Define the folder path
    $xml_folder_path = get_template_directory() . '/XML_Data';

    // Get all files in the folder
    $files = glob($xml_folder_path . '/*');

    // Create a zip archive
    $zip = new ZipArchive();
    $zip_file_path = $xml_folder_path . '/xml_folder.zip';
    if ($zip->open($zip_file_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // Add all files to the zip
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();
        // Optionally, you can delete the original files if needed
        // foreach ($files as $file) {
        //     unlink($file);
        // }
        // Set proper headers for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="xml_folder.zip"');
        header('Content-Length: ' . filesize($zip_file_path));
        // Read the zip file and output it to the browser
        readfile($zip_file_path);
    } else {
        // Zip creation failed
        echo 'Failed to create zip file';
    }

	
	
	
    // Always exit to avoid further processing
    exit;
}





