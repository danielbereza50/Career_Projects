<?php
/*

	Live Email address: 
	Live Merchant Id: 
	Live Client Id: 
	Live Secret Key: 

*/
// Add a hook to initialize the custom PayPal gateway after WooCommerce has been loaded.
add_action('plugins_loaded', 'custom_paypal_gateway_init');

function custom_paypal_gateway_init() {
    if (!class_exists('WC_Payment_Gateway')) {
        return;
    }

    // Define the custom payment gateway class.
    class Custom_PayPal_Gateway extends WC_Payment_Gateway {

        // Initialize the gateway.
        public function __construct() {
            $this->id = 'custom_paypal_gateway';
            $this->method_title = 'Custom PayPal Gateway';
            $this->icon = ''; // Add the URL to your gateway icon.
            $this->has_fields = false;

            // Define the gateway settings.
            $this->init_form_fields();
            $this->init_settings();

            // Define the actions and filters for the gateway.
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
        }

        // Define the gateway settings.
        public function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title' => 'Enable/Disable',
                    'type' => 'checkbox',
                    'label' => 'Enable Custom PayPal Gateway',
                    'default' => 'no',
                ),
                'title' => array(
                    'title' => 'Title',
                    'type' => 'text',
                    'description' => 'This controls the title that the user sees during checkout.',
                    'default' => 'Custom PayPal Gateway',
                    'desc_tip' => true,
                ),
                'description' => array(
                    'title' => 'Description',
                    'type' => 'textarea',
                    'description' => 'This controls the description that the user sees during checkout.',
                    'default' => 'Pay securely with Custom PayPal Gateway.',
                ),
            );
        }

        // Process the payment and redirect to PayPal.
        public function process_payment($order_id) {
            $order = wc_get_order($order_id);

            // Mark the order as on-hold (payment pending).
            $order->update_status('completed', __('Payment made via Custom PayPal Gateway.', 'woocommerce'));

            // Redirect to PayPal.
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order),
            );
        }
	
    }

    // Register the custom PayPal gateway.
    function add_custom_gateway($gateways) {
        $gateways[] = 'Custom_PayPal_Gateway';
        return $gateways;
    }

    add_filter('woocommerce_payment_gateways', 'add_custom_gateway');
	
	function add_custom_js_to_head() { ?>
	<script src="https://www.paypal.com/sdk/js?client-id={ID}></script>
		<?php
	}
	// Hook the function to the wp_head action
	add_action('wp_head', 'add_custom_js_to_head');
}
// Add hidden field for order total in WooCommerce checkout form
function add_hidden_order_total_field() {
    // Get the order total
    $order_total = WC()->cart->get_cart_contents_total();

    // Output the hidden field
    echo '<input type="hidden" name="order_total" value="' . esc_attr($order_total) . '" />';
}

add_action('woocommerce_review_order_before_payment', 'add_hidden_order_total_field');

