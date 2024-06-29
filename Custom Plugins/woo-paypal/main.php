<?php
/*
    Plugin Name: Woo Paypal Gateway
    Plugin URI:  -
    Description: Connects to Paypal API from woo.
    Version:     100.0.0
    Author:      -
    Author URI:  -
    License:     GPL2
    License URI: Licence URl
*/

include __DIR__.'/includes/class-main.php';
add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');   
}




//// SDK stuff below

include __DIR__.'/vendor/autoload.php';

// import namespace
use PayPal\Http\Environment\SandboxEnvironment;
use PayPal\Http\PayPalClient;

use PayPal\Checkout\Requests\OrderCreateRequest;
use PayPal\Checkout\Orders\AmountBreakdown;
use PayPal\Checkout\Orders\Item;
use PayPal\Checkout\Orders\Order;
use PayPal\Checkout\Orders\PurchaseUnit;



// http://localhost:8888/wordpress/product/paypal-test-product/
// http://localhost:8888/wordpress/test-paypal-api/


// https://developer.paypal.com/dashboard/dashboard/sandbox
//

/*


	/*
	
    try {
        // client id and client secret retrieved from PayPal
        $clientId = "";
        $clientSecret = "";

        // create a new sandbox environment
        $environment = new SandboxEnvironment($clientId, $clientSecret);

        // create a new client
        $client = new PayPalClient($environment);
		
		// Create a purchase unit with the total amount
		$purchase_unit = new PurchaseUnit(AmountBreakdown::of('100.00'));

		// Create & add item to purchase unit
		$purchase_unit->addItem(Item::create('Item 1', '100.00', 'USD', 1));

		// Create a new order with intent to capture a payment
		$order = new Order();

		// Add a purchase unit to order
		$order->addPurchaseUnit($purchase_unit);

		// Create an order create http request
		$request = new OrderCreateRequest($order);

		// Send request to PayPal
		$response = $client->send($request);

		// Parse result
		$result = json_decode((string) $response->getBody());
		
		echo '<pre>';
			print_r($result);
		echo '</pre>';
		


       
    } catch (Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
	
	*/




add_shortcode('display_obj', 'test_api');
function test_api(){
	ob_start(); 

?>
<!-- danielbereza24@gmail.com -->
<script src="https://www.paypal.com/sdk/js?client-id={ID}"></script>
<!-- Add a form with an input field for the payment amount -->
<form id="paymentForm">
  <label for="amount">Enter Amount:</label>
  <input type="text" id="amount" name="amount" required>
  <button type="submit" id="submitBtn">Submit</button>
</form>
<div id="paypal-button-container"></div>
<script>
  document.getElementById('paymentForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission
	  
	  alert('afdsfasdfsd');
	  
    // Get the amount from the form field
    var amountValue = document.getElementById('amount').value;

    // Check if the amount is a valid number
    if (isNaN(amountValue) || parseFloat(amountValue) <= 0) {
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
                value: amountValue,
              },
            },
          ],
        });
      },
      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          alert('Transaction completed by ' + details.payer.name.given_name);
        });
      },
    }).render('#paypal-button-container');
	  
	  
  });
</script>

<?php
	 return ob_get_clean();
	
}


