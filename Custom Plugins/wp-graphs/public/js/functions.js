jQuery(document).ready(function($){


	function initializeChart(day_totals_array) {
			// Define x and y values based on the day_totals_array
			var xValues = Object.keys(day_totals_array);
			var yValues = Object.values(day_totals_array);
			
			console.log(xValues);
			console.log(yValues);
			

			// Define other variables as before
			var barColors = ["#2e8dff", "#2e8dff", "#2e8dff", "#2e8dff", "#2e8dff", "#2e8dff", "#2e8dff"];

			// Initialize the chart using the updated xValues and yValues
			new Chart("user_activity_graph", {
				type: "bar",
				data: {
					labels: xValues,
					datasets: [{
						backgroundColor: barColors,
						data: yValues
					}]
				},
				options: {
					legend: { display: false },
					title: {
						display: false,
						text: "User Activity"
					},
					scales: {
						yAxes: [{
							scaleLabel: {
								display: true,
								labelString: 'Seconds'
							}
						}]
					}
				}
			});
		}


			$(document).on('click', '#activity-summary', function(e) {
					e.preventDefault();
					//alert('afsd');

					// Retrieve the value of the hidden field
					var day_totals_data = document.getElementById('day_totals_data').value;

					// Parse the JSON string to convert it back to an array
					var day_totals_array = JSON.parse(day_totals_data);
			
					console.log(day_totals_array);				
					// Object { Sunday: 0, Monday: 1085, Tuesday: 365, Wednesday: 0, Thursday: 0, Friday: 0, Saturday: 0 }
				

			
					jQuery.ajax({
						url: al.ajaxurl,
						type: 'post',
						data: {
							action: 'data_fetch_activity',
							day_totals_array:day_totals_array,

							
							
						},
						success: function(data) {
							console.log(data);
							jQuery('#replace').html(data);
							initializeChart(day_totals_array);

	
						},
						error: function(jqXHR, textStatus, errorThrown) {
							console.error("AJAX Request Error:", textStatus, errorThrown);
							// Additional logic specific to the error callback
							alert('Error');
						}
					});
			

				});
	
          


});