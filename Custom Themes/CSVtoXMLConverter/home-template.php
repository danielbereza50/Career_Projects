<?php 
/**
 * Template Name: Home 
 */ 
get_header();

// https://wordpress-106607-4305096.cloudwaysapps.com/wp-content/themes/incident/screenshot.png
// https://wordpress-106607-4305096.cloudwaysapps.com/wp-content/themes/incident/Incident_Data/

?>
<div class = "csv-container">
	<h2>Step 1: Upload CSV File</h2>
	<div class="csv-form-container">
		<div class="csv-form-wrapper">
			<div class="csv-form-item">
				<form id="csv-upload-form" enctype="multipart/form-data">
					<input type="hidden" name="action" value="csv_upload">
					<input type="file" name="csv_file" accept=".csv" required>
					<button type="submit">Upload CSV</button>
				</form>
			</div>
		</div>
	</div>
	<div id="upload-status"></div>
</div>
<div class = "xml-container">
	<h2>Step 2: Upload XML Files</h2>
	<div class="xml-form-container">
		<div class="xml-form-wrapper">
			<div class="xml-form-item">
				<form id="xml-upload-form" enctype="multipart/form-data">
					<input type="hidden" name="action" value="xml_upload">
					<div id="drop-zone" class="drop-zone">
						Drag & Drop XML files here or click to browse
					</div>
					<input type="file" name="xml_files[]" accept=".xml" multiple required>
					<button type="submit">Upload XML</button>
				</form>
			</div>
		</div>
	</div>
	<div id="upload-status"></div>
</div>
<div class = "sync-container">
	<h2>Step 3: Sync the data</h2>
	<div class="sync-form-container">
		<div class="sync-form-wrapper">
			<div class="sync-form-item">
					<button type="submit" id = "sync">Sync Files</button>
			</div>
		</div>
	</div>
	<div id="upload-status"></div>
</div>
<div class = "download-container">
	<h2>Step 4: Download Folder</h2>
	<button id="downloadButton">Download XML Folder</button>
</div>
<div class="modal"><!-- Place at bottom of page --></div>
<?php 

   get_footer(); 

?>