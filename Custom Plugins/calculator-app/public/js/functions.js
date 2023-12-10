jQuery(document).ready(function($){
	console.log('Hello World!');

	
	$body = $("body");
	
	var ajaxURL = '/wp-admin/admin-ajax.php'

	
	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		 ajaxStop: function() { $body.removeClass("loading"); }    
	});
	
	
	 $('#chemical').change(function() {
	// $("#professionals-form").submit(function(event){
		event.preventDefault();
		 
		var chemical = jQuery("#chemical").val();
		
		console.log(chemical);

		  var selectedOptionValue = jQuery("#chemical").val();

			// Update the options dynamically
			jQuery('#chemical option').each(function () {
				if (this.value == selectedOptionValue) {
					jQuery(this).prop('selected', true).addClass('selected');
				} else {
					jQuery(this).prop('selected', false).removeClass('selected');
				}
			});
		 
		 
			jQuery.ajax({
				//url: al.ajaxurl,
				url: ajaxURL,
				type: 'post',
				data: {
					action: 'data_fetch',
					chemical: chemical, 
				},
				success: function(data) {
					
						jQuery('#results').html( data );
					//	alert(professional);
					},
					 error: function(data) { 
						//alert('ffffffff');
					}   
				}); 
		 
	});
	
	
	
	 $("#create-new-container").hide();
     $("#select-existing-container").hide();
	
	function toggleContainers(showContainer, hideContainer) {
		$(showContainer).show();
		$(hideContainer).hide();
	}

	$("#create-new").on("click", function() {
		toggleContainers("#create-new-container", "#select-existing-container");
	});

	$("#select-existing").on("click", function() {
		toggleContainers("#select-existing-container", "#create-new-container");
	});
	
	// Function to format field name
	function formatFieldName(fieldName) {
		// Remove hyphens and capitalize first letter of each word
		var formattedName = fieldName.replace(/-/g, ' ').replace(/(?:^|\s)\S/g, function(a) {
			return a.toUpperCase();
		});
		return formattedName;
	}
	$("#submit-new").on("click", function() {
		 var fieldsToCheck = ["#address", "#type-of-incident"];
		 var emptyFields = [];
		
		 var address = jQuery("#address").val();
		 var type_of_incident = jQuery("#type-of-incident").val();

		console.log(type_of_incident);

		for (var i = 0; i < fieldsToCheck.length; i++) {
			var fieldElement = $(fieldsToCheck[i]);
			var fieldValue = fieldElement.val().trim();

			if (fieldValue === '') {
					var fieldName = fieldsToCheck[i].replace("#", ''); // Get the field name without the '#'
					var formattedFieldName = formatFieldName(fieldName);
					emptyFields.push(formattedFieldName);
				}
		}

		if (emptyFields.length > 0) {
				$("#alert").text('Please fill out the fields: ' + emptyFields.join(', '));
			} else {
				console.log('Form submitted successfully');
				
			jQuery.ajax({
				url: ajaxURL,
				type: 'post',
				data: {
					action: 'insert_incidents',
					address: address, 
					type_of_incident: type_of_incident, 
				},
				success: function(data) {
					// /calculator-form?ID=
					console.log(data); // Log the data to the console for debugging
					//alert('Record created successfully');
					jQuery('#results').html(data); // Update with HTML content

				},
				 error: function(data) { 
					alert('Record creation failed');
				}   
			}); 
				
				
		}
	});	
	
	
	$(document).on("click", "#submit-save", function() {
		// Get the value of the selected option with class "selected"
		var chemicalID = $('#chemical').val();

		// Log the selected value to the console
		// console.log(selectedValue);

		// Get the URL parameters
		var urlParams = new URLSearchParams(window.location.search);

		// Get the value of the 'ID' parameter
		var incidentID = urlParams.get('ID');

		var date_time = jQuery("#date-time").val();
		var location_print = jQuery("#location-print").val();
		var actual_lel = jQuery("#actual-lel").val();
		var lel_warning = jQuery("#lel_warning").val();
		var lel_on_meter = jQuery("#lel-on-meter").val();
		var idlh_warning = jQuery("#idlh_warning").val();
		
		console.log(actual_lel);

		// Get the updated count of records and log it
		var recordCount = $(".record").length;
		console.log('Number of records:', recordCount);

		// Create an array to store records
		var records = [];

		// Loop through each record on the page
		$(".record").each(function() {
			var record = {
				
				date_time: $(this).find("#date-time").val(),
				location_print: $(this).find("#location-print").val(),
				actual_lel: $(this).find("#actual-lel").val(),
				lel_warning: $(this).find("#lel_warning").val(),
				lel_on_meter: $(this).find("#lel-on-meter").val(),
				idlh_warning: $(this).find("#idlh_warning").val()
				
			};

			// Push the record to the array
			records.push(record);
		});

		// Log the value to the console
		console.log(chemicalID);
		
		jQuery.ajax({
				url: ajaxURL,
				type: 'post',
				data: {
					action: 'save_meta',
					incidentID: incidentID,
					chemicalID: chemicalID,
					records: records // Include the records array
					
				},
				global: false, // Disable the global AJAX loader for this request
				success: function(data) {
					// alert('Record data saved');
					jQuery('#test').html(data); // Update with HTML content
				},
				 error: function(data) { 
					// alert('Record data not saved');
				}   
			}); 	
		
		
	});
	$(document).on("click", "#submit-history", function() {
		var chemicalID = $('#chemical').val();
		
		// Get the URL parameters
		var urlParams = new URLSearchParams(window.location.search);

		// Get the value of the 'ID' parameter
		var incidentID = urlParams.get('ID');
		
		console.log(chemicalID);
		
		jQuery.ajax({
				url: ajaxURL,
				type: 'post',
				data: {
					action: 'display_history',
					chemicalID: chemicalID,
					incidentID: incidentID
				},
				global: false, // Disable the global AJAX loader for this request
				success: function(data) {
					
					//alert('Success');
					jQuery('#extra-info-results-previous').html(data); // Update with HTML content
					
					
				},
				 error: function(data) { 
					//alert('Error');
				}   
			}); 
		
		
	});	
	$(document).on("click", "#delete-button", function() {		
		// Get the closest parent with class "record" and find the hidden input inside it
		var $recordIdInput = $(this).closest(".record").find(".record_id");

		// Get the data-id attribute value
		var recordID = $recordIdInput.data("id");

		console.log(recordID);
		
			jQuery.ajax({
				url: ajaxURL,
				type: 'post',
				data: {
					action: 'delete_record',
					recordID: recordID,
				},
				success: function(data) {
					alert('Success');
					jQuery('#test').html(data); // Update with HTML content
				},
				 error: function(data) { 
					alert('Error');
				}   
			}); 
			
		
	});	
	// Function to perform the action
	function performAction() {
		var chemical = jQuery("#chemical").val();
		console.log(chemical);

		var selectedOptionValue = jQuery("#chemical").val();

		// Update the options dynamically
		jQuery('#chemical option').each(function () {
			if (this.value == selectedOptionValue) {
				jQuery(this).prop('selected', true).addClass('selected');
			} else {
				jQuery(this).prop('selected', false).removeClass('selected');
			}
		});

		jQuery.ajax({
			//url: al.ajaxurl,
			url: ajaxURL,
			type: 'post',
			data: {
				action: 'data_fetch',
				chemical: chemical, 
			},
			global: false, // Disable the global AJAX loader for this request
			success: function(data) {
				jQuery('#results').html(data);
			},
			error: function(data) { 
				// Handle error
			}   
		}); 
	}
	/*
	   jQuery(document).ready(function($) {
					$("#submit-extra").click(function(event) {
					});	
		});
	*/
	
	 jQuery(document).on("click", "#submit-extra", function(event) {		
	//$("#submit-extra").click(function(event) {
						// Check if both fields are filled in
						var locationValue = $("#location").val();
						var meter_reading = $("#meter_reading").val();
						
						var actual_lel = $("#actual_lel").val();
						var c_value = $("#c_value").val();
						var cf_value = $("#cf_value").val();
						
						var first_idlh_value = $("#idlh-value").val();

						// Use a regular expression to extract the numeric part
						var match = first_idlh_value.match(/[\d,.]+/);

						// Check if a match is found and get the first match
						var numeric_part = match ? match[0] : null;

						// Convert the numeric part to a float
						var first_idlh_numeric_value = numeric_part ? parseFloat(numeric_part.replace(',', '')) : null;

						console.log(first_idlh_numeric_value);
						
						var idlh = $("#idlh").val();
						var idlhnumericValue = idlh.match(/\d+\.\d+/)[0];
						//console.log(idlhnumericValue); // Output: 4.55
						

						
						var finalmeterreading = meter_reading * cf_value;
						
						// Round the final meter reading to two decimal places
						var actualLEL = finalmeterreading.toFixed(2);

						// Assuming the value is a string containing the desired numbers
						var lelMeterString = $("#lel_meter").val();

						// Use a regular expression to extract all numeric values
						var numericValues = lelMeterString.match(/\d+/g);

						// Check if numeric values are found
						if (numericValues !== null && numericValues.length >= 2) {
							// Extract the second numeric value
							var secondNumericValue = numericValues[1];

							// Display or use the second numeric value
							//console.log("Second Numeric Value: " + secondNumericValue);
						} else {
							//console.log("No second numeric value found in the string.");
						}
						
						var lelonmeter = secondNumericValue * finalmeterreading
						// Use toLocaleString to add commas for thousands and more
						var formattedLelonMeter = lelonmeter.toLocaleString();
						
						
						//console.log(meter_reading);
						//console.log(cf_value);
						//console.log(actualLEL);
						
						//console.log(lelonmeter);
						
						
						if (locationValue === "" || meter_reading === "") {
							// If either field is empty, prevent the form submission
							event.preventDefault();
							alert("Please fill in both fields before submitting.");
						} else {
							//alert("Hello! Form Submitted.");

							var currentDate = new Date();
							var formattedDate = currentDate.toLocaleString();

							// Create a new record with a delete button
							
							
var newRecord = '<div class="record" >';
							
newRecord += '<input type="text" id="date-time" class="existing-record read-only-text" value="Time Stamp: ' + formattedDate + '" readonly>';
newRecord += '<input type="text" id="location-print" class="existing-record read-only-text" value="Location: ' + locationValue + '" readonly>';

if (actualLEL >= 100) {
    newRecord += '<input type="text" id="actual-lel" class="existing-record read-only-text" value="% of actual LEL: ' + actualLEL + ' %" readonly>';
    newRecord += '<input type="text" id="lel_warning" class="existing-record read-only-text red" value="DANGER - IN THE EXPLOSIVE RANGE." readonly>';
} else if (actualLEL < 100 && actualLEL > idlhnumericValue) {
    newRecord += '<input type="text" id="actual-lel" class="existing-record read-only-text" value="% of actual LEL: ' + actualLEL + ' %" readonly>';
    newRecord += '<input type="text" id="lel_warning" class="existing-record read-only-text red" value="Warning - Environment is above the IDLH. Wear protective gear." readonly>';
} else {
    newRecord += '<input type="text" id="actual-lel" class="existing-record read-only-text" value="% of actual LEL: ' + actualLEL + ' %" readonly>';
}
							
							// Remove commas and convert to a number
							var numericFormattedLelonMeter = parseFloat(formattedLelonMeter.replace(/,/g, ''));

							console.log('numericFormattedLelonMeter:', numericFormattedLelonMeter);
							console.log('first_idlh_numeric_value:', first_idlh_numeric_value);

							if (numericFormattedLelonMeter >= first_idlh_numeric_value) {
									console.log('hello');
									newRecord += '<input type="text" id="lel-on-meter" class="existing-record read-only-text" value="LEL on Meter: ' + formattedLelonMeter + ' PPM" readonly>';
									newRecord += '<input type="text" id="idlh_warning" class="existing-record read-only-text red" value="IDLH then warn: Warning - Environment is above the IDLH. Wear protective gear." readonly>';
								} else {
									console.log('world');
									newRecord += '<input type="text" id="lel-on-meter" class="existing-record read-only-text" value="LEL on Meter: ' + formattedLelonMeter + ' PPM" readonly>';
								}
							
							newRecord += '<button class="delete-button" id = "delete-button-new">Delete</button>';
							newRecord += '</div>';

							// Prepend the new record to the top of the container
							$(".extra-info-results").prepend(newRecord);

							$("#delete-button-new").click(function() {
								$(this).parent(".record").remove();
							});
							
							
							
							document.getElementById('location').value = '';
							document.getElementById('meter_reading').value = '';
							
							
							
							
						}
					});
	
	
	
	// Execute the action once, 1 seconds after page load
	$(document).ready(function() {
		setTimeout(performAction, 1000);
	});

	// Function to click a button by its ID
	function autoClickButton(buttonId) {
		$('#' + buttonId).click();
	}

	// Set interval to click the submit-save button every 3 seconds
	setInterval(() => autoClickButton('submit-save'), 3000);

	// Set interval to click the submit-history button only once after page load
	let historyButtonClicked = false;
	setTimeout(() => {
		autoClickButton('submit-history');
		historyButtonClicked = true;
	}, 2000);
	
	$(document).on("click", "#submit-extra", function() {		
			 $("#chemical").prop("disabled", true);
	});	
	  document.getElementById("logoImage").addEventListener("click", function() {
            window.location.href = "/";
        });
	
	
	
	
	
	
	
	
	

});	

