jQuery(document).ready(function($){
	
		console.log('hello calculator');

		/*

		 0 values:
		 CFA
		 CPA
		 CRA

		*/

		// Retrieve total recruiting cost and annual hours worked from hidden fields
		var totalRecruitingCost = parseFloat($('#totalRecruitingCostROI').val());
		var annualHoursWorked = parseFloat($('#annualHoursWorkedROI').val());

		console.log('Total Recruiting Cost ROI: ' + totalRecruitingCost);
		console.log('Annual Hours Worked ROI: ' + annualHoursWorked);

		// Calculate the hourly recruiting cost
		var hourlyRecruitingCost = (totalRecruitingCost / annualHoursWorked).toFixed(2);

		// Function to format a number as currency
		function formatCurrency(value) {
			return Number(value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
		}

		// Function to calculate formatted yearly savings and update the display
		function updateYearlySavings(selector, footerSelector) {
			// Retrieve the value and parse it as a float
			var value = parseFloat($(selector).text()) || 0;

			// Manually format it to two decimal points without rounding up
			var formattedValue = Math.floor(value * 100) / 100; // This will floor the value to two decimal points
			console.log(selector + ' Value formatted to two decimal points: ' + formattedValue);

			// Calculate the yearly savings
			var yearlySavings = (formattedValue * 2080).toFixed(2);
			console.log('Yearly Savings for ' + selector + ': ' + yearlySavings); // Log the calculated yearly savings

			// Format the yearly savings for display
			var formattedYearlySavings = formatCurrency(yearlySavings);

			// Update the footer yearly savings display
			$(footerSelector).text(formattedYearlySavings);
		}
	
		// Generic function to update calculated values
		function updateValues(inputSelector, outputSelector, targetSelector) {
			// Get the values from ITA and target elements
			var ITAValue = parseFloat($(inputSelector).text()) || 0;
			var targetValue = parseFloat($(targetSelector).text()) || 0;

			// Perform the subtraction
			var resultValue = (ITAValue - targetValue).toFixed(2);
			console.log('Result is', resultValue);

			
			//CSOA
			//CSFA
			
			/*
				// Check if the resultValue is negative
				if (resultValue < 0) {
					// Make the result positive for display
					resultValue = Math.abs(resultValue).toFixed(2);
				}
			*/
			
			// Write the result to the output element
			$(outputSelector).text(resultValue);

			// Log the values and result for debugging
			console.log('ITA Value: ' + ITAValue);
			console.log('Target Value (' + targetSelector + '): ' + targetValue);
			console.log('Calculated Result Value (' + outputSelector + '): ' + resultValue);

			
			// Update CSOA yearly savings
			updateYearlySavings('.CSOA', '.footer-yearly-savings');
			
			// Update CSFA yearly savings
			updateYearlySavings('.CSFA', '.footer-yearly-field');
			

		}
	
		// Function to handle input events and update values
		function handleInputChange(selector, targetClass, updateFunction) {
			$(selector).on('keyup', function() {
				// Get the current input value
				 var inputValue = parseFloat($(this).val()) || 0;

				// Write the value to the target element
				$(targetClass).text(inputValue);

				// Log the current input value for debugging
				console.log('Current input value: ' + inputValue);

				// Call the update function if provided
				if (typeof updateFunction === 'function') {
					updateFunction();
				}
			});
		}


		// Handle input changes
    	handleInputChange('#internal-hourly-pay', null, function() {
			// Get the current input value
			var IHP = parseFloat($('#internal-hourly-pay').val()) || 0;
            var TOA = parseFloat($('#temporary-office-pay').val()) || 0;
            var TFA = parseFloat($('#temporary-field-pay').val()) || 0;
			
			
			console.log('IHP', IHP);
			console.log('TOA', TOA);
			console.log('TFA', TFA);
			
			 // Check if the input is empty or not a valid number
			if (isNaN(IHP) || IHP === 0) {
				//alert('Hello');
				// Reset the displayed values to zero if the input is empty
				$('.IFA, .IPA, .IRA, .ITA, .CSOA, .CSFA, .footer-yearly-savings').text('0.00');
				return;
			}

			// Multiply the input value by 0.38 and 0.12 and round the results to 2 decimal places
			var result1 = (IHP * 0.38).toFixed(2);
			var result2 = (IHP * 0.12).toFixed(2);

			// Write the rounded results to the respective span elements
			$('.IFA').text(result1);
			$('.IPA').text(result2);
			$('.IRA').text(hourlyRecruitingCost);

			// Parse the calculated results as floats
			var result1Float = parseFloat(result1);
			var result2Float = parseFloat(result2);
			var hourlyRecruitingCostFloat = parseFloat(hourlyRecruitingCost);

			// Calculate the total
			var total = (IHP + result1Float + result2Float + hourlyRecruitingCostFloat).toFixed(2);

			// Write the total to the span with class "ITA"
			$('.ITA').text(total);

			// Log the current input value and results for debugging
			console.log('Current input value: ' + IHP);
			console.log('Calculated and rounded result for IFA: ' + result1);
			console.log('Calculated and rounded result for IPA: ' + result2);
			console.log('Hourly Recruiting Cost: ' + hourlyRecruitingCost);
			console.log('Total: ' + total);

			
			
			
			
			// Update CSOA and CSFA
			updateValues('.ITA', '.CSOA', '.CTOA');
			updateValues('.ITA', '.CSFA', '.CTFA');
			
			
			
			
    	});

		handleInputChange('#temporary-office-pay', '.CTOA', function() {
			
			
			
			
			// Update CSOA and CSFA
			updateValues('.ITA', '.CSOA', '.CTOA');
			updateValues('.ITA', '.CSFA', '.CTFA');
			
			
			
		});

		// function updateValues(inputSelector, outputSelector, targetSelector) {
		handleInputChange('#temporary-field-pay', '.CTFA', function() {

			
			
			
			// Update CSOA and CSFA
			updateValues('.ITA', '.CSOA', '.CTOA');
			updateValues('.ITA', '.CSFA', '.CTFA');
			
			
			
		});

	
	
	
	
	
	
	
	
	
	
	
	
	
	


});