jQuery(document).ready(function($) {
	
			// Get the value of the hidden order total field
			var orderTotal = $('input[name="order_total"]').val();

			// Log the order total to the console (you can replace this with your desired logging method)
			console.log('Order Total: ' + orderTotal);
	
			function applyCustomContent() {
				// Your custom content to be added to the label
				var customContent = 'Paypal';

				// Find the label with the specified for attribute
				var labelElement = $('label[for="payment_method_custom_paypal_gateway"]');

				// Add the custom content to the label
				labelElement.html(customContent);
			}

			// Apply custom content on page load
			applyCustomContent();

			// Reapply custom content after WooCommerce checkout form initialization
			$(document.body).on('updated_checkout', applyCustomContent);
	
		   // Enable the "Place Order" button when a non-PayPal payment method is selected
		   $(document).on('change', 'input[name="payment_method"]', function() {
				var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();

				// Check if the selected payment method is not "custom_paypal_gateway"
				if (selectedPaymentMethod !== 'custom_paypal_gateway') {
					  $('.payment_method_custom_paypal_gateway #paypal-button-container').remove();
					  $('#place_order').prop('disabled', false);
				} else {
				  // If PayPal is selected, disable the "Place Order" button
				  $('#place_order').prop('disabled', true);
				}
		    });

			function initializePayPalButton() {
			  // Check if the amount is a valid number
			  if (isNaN(orderTotal) || parseFloat(orderTotal) <= 0) {
				alert('Please enter a valid positive amount.');
				return;
			  }
			  // Render PayPal button with the dynamically set amount
			  paypal.Buttons({
				createOrder: function (data, actions) {
				  return actions.order.create({
					purchase_units: [
					  {
						amount: {
						  value: orderTotal,
						},
					  },
					],
				  });
				},
				onApprove: function (data, actions) {
				  return actions.order.capture().then(function (details) {
					alert('Transaction completed by ' + details.payer.name.given_name);
					$('#place_order').prop('disabled', false);
					$('#place_order').trigger('click');
				  });
				},
				onError: function (err) {
				  // Handle errors here
				  console.error('Error during PayPal transaction:', err);
				  alert('There was an error processing your order. Please try again.');
				},
			  }).render('#paypal-button-container');
			}
			// Using event delegation for dynamically loaded elements
			$(document).on('change', '.payment_method_custom_paypal_gateway', function () {
			  //alert('asfdfaasdf');
			  $('#place_order').prop('disabled', true);

			  // Check if the message is already appended
			  if ($(this).find('div').length === 0) {
				// Append a new HTML element underneath the clicked li
				$(this).append('<div id="paypal-button-container"></div>');
				initializePayPalButton();
			  }
			});
			// setTimeout function to check radio button on page load
			setTimeout(function () {
			  // Check if the radio button is initially checked on page load
			  if ($('#payment_method_custom_paypal_gateway').prop('checked')) {
				  $('#place_order').prop('disabled', true);

				// Append the HTML only if the radio button is selected
				$('.payment_method_custom_paypal_gateway').append('<div id="paypal-button-container"></div>');
				initializePayPalButton();
			  }
			}, 5000);

			  
			  
	
	
	
	
	
	
	
	
			  
			  
			  
			  
});