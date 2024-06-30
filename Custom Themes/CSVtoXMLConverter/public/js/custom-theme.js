// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    
      console.log( "ready!" );

	  $body = $("body");

	  $(document).on({
			ajaxStart: function() { $body.addClass("loading");    },
			 ajaxStop: function() { $body.removeClass("loading"); }    
	  });

	
      // Add event listener to form submit
	  $('#csv-upload-form').submit(function(event) {
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
					$('.xml-container').css('display', 'block');
					
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});
	
	
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
						$('.sync-container').css('display', 'block');
						
						
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
			});

			var dropZone = document.getElementById('drop-zone');

			dropZone.addEventListener('dragover', function(e) {
				e.preventDefault();
				dropZone.classList.add('drag-over');
			});

			dropZone.addEventListener('dragleave', function() {
				dropZone.classList.remove('drag-over');
			});

			dropZone.addEventListener('drop', function(e) {
				e.preventDefault();
				dropZone.classList.remove('drag-over');
				var files = e.dataTransfer.files;
				handleFiles(files);
			});

			// Handling file upload
			function handleFiles(files) {
				var formData = new FormData();
				for (var i = 0; i < files.length; i++) {
					formData.append('action', 'xml_upload'); // Adding action parameter
					formData.append('xml_files[]', files[i]);
				}

				// Sending AJAX request
				$.ajax({
					url: ajax_object.ajax_url,
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						console.log(response);
						// Handle response here
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
				
			}
	
	
	
	    // Add event listener to form submit
	     $('#sync').click(function(event) {
			  event.preventDefault(); // Prevent default form submission

				$.ajax({
					url: ajax_object.ajax_url,
					type: 'POST',
					data: {
						action: 'sync_files'
					},
					success: function(response) {
						alert('Success, Please download folder');
						$('.download-container').css('display', 'block');
						//uploadStatus.html(response);
					},
					error: function(xhr, status, error) {
						alert('Failure');
						console.error(xhr.responseText);
					}
				});
			 
			 
			});

			 $('#downloadButton').on('click', function() {
				// AJAX request to trigger the server-side action
				$.ajax({
					url: ajax_object.ajax_url,
					method: 'POST',
					data: {
						action: 'download_xml_folder'
					},
					success: function(response) {
						// Handle the response from the server if needed
						alert('Folder created');
						// Initiate download of the zip file
            			window.location.href = '/wp-content/themes/incident/XML_Data/xml_folder.zip';
					}
				});
				 
			});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
