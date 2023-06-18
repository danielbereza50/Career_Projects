<?php


/*
	add_action( 'woocommerce_admin_order_data_after_order_details', 'add_print_pdf_button' );
	add_action( 'admin_footer', 'add_print_pdf_script' );
	add_action( 'wp_ajax_print_pdf', 'print_pdf' );
	add_action( 'wp_ajax_nopriv_print_pdf', 'print_pdf' );
*/
function add_print_pdf_button( $order ) {
    $order_id = $order->get_id();
    ?>
    <button onclick="printPDF(<?php echo $order_id; ?>)">PDF Invoice</button>
    <?php
}
function add_print_pdf_script() {
    ?>
    <script>
        function printPDF(order_id) {
            var url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
            url += '?action=print_pdf&order_id=' + order_id;
            window.open(url, '_blank');
            //window.print();
        }
    </script>
    <?php
}
function print_pdf() {
    $order_id = isset( $_GET['order_id'] ) ? intval( $_GET['order_id'] ) : 0;
    $order = wc_get_order( $order_id );

    if ( ! $order ) {
        wp_die( 'Invalid order' );
    }
            
            $pdf = new FPDF();
            $pdf->AddPage();
              // Add the customer details
            $pdf->SetFont( 'Arial', 'B', 16 );
            $pdf->Cell( 0, 10, 'Customer Details:', 0, 1 );
            $pdf->SetFont( 'Arial', '', 12 );
            $pdf->Cell( 0, 10, 'Name: ' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(), 0, 1 );
            $pdf->Cell( 0, 10, 'Email: ' . $order->get_billing_email(), 0, 1 );
            $pdf->Cell( 0, 10, 'Phone: ' . $order->get_billing_phone(), 0, 1 );
	
			$pdf->Cell( 0, 10, 'Address 1: ' . $order->get_billing_address_1(), 0, 1 );
			$pdf->Cell( 0, 10, 'Address 2: ' . $order->get_billing_address_2(), 0, 1 );
	
			$pdf->Cell( 0, 10, 'City: ' . $order->get_billing_city(), 0, 1 );
			$pdf->Cell( 0, 10, 'State: ' . $order->get_billing_state(), 0, 1 );
			
			$pdf->Cell( 0, 10, 'Postcode: ' . $order->get_billing_postcode(), 0, 1 );
			$pdf->Cell( 0, 10, 'Country: ' . $order->get_billing_country(), 0, 1 );
	
			$order_total = $order->get_formatted_order_total(); // Get formatted order total
			$order_total_stripped = strip_tags( $order_total ); // Strip HTML tags
			$order_total_cleaned = str_replace('&#36;', '', $order_total_stripped); // Remove "&#36;" characters
			$payment_method = $order->get_payment_method();

            // Add the order details
            $pdf->SetFont( 'Arial', 'B', 16 );
            $pdf->Cell( 0, 10, 'Order Details:', 0, 1 );
            $pdf->SetFont( 'Arial', '', 12 );
            $pdf->Cell( 0, 10, 'Order ID: ' . $order_id, 0, 1 );
            $pdf->Cell( 0, 10, 'Order Date: ' . $order->get_date_created()->format( 'F j, Y' ), 0, 1 );
            $pdf->Cell( 0, 10, 'Order Total: ' . $order_total_cleaned, 0, 1 );
			$pdf->Cell( 0, 10, 'Payment Method: ' . $payment_method, 0, 1 );

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Order Items', 0, 1, 'C');

            foreach ($order->get_items() as $item_id => $item) {
                $product = $item->get_product();
				$stripped_product_price = strip_tags($order->get_formatted_line_subtotal($item));
                $decoded_product_price = html_entity_decode($stripped_product_price);
				
				
				// variation sample: https://www.wandersproducts.com/wp-admin/post.php?post=29031&action=edit
				// gravity sample: https://www.wandersproducts.com/wp-admin/post.php?post=29078&action=edit
				// Check if the product is a variation
				if ($product->is_type('variation')) {
					  $variation_id = $item->get_variation_id();
					  $variation = wc_get_product($variation_id);
					  $pdf->Cell(0, 10, 'Variation ID: ' . $variation_id, 0, 1);
				}
				// Print out all metadata associated with the item
				foreach ($item->get_meta_data() as $meta_data) {
					   $attribute_name = wc_attribute_label(str_replace('attribute_', '', $meta_key));
					   $data_key = $meta_data->key;
					   $data_key = str_replace(['&quot;', 'â„¢'], '', $data_key);
					
					   $data_value = $meta_data->value;
				       $data_value = str_replace(['&quot;', 'â„¢'], '', $data_value);

					   $pdf->Cell(0, 10, 'Name: ' . $data_key . ' Value: ' . $data_value, 0, 1);
				}
				//print out gravity forms data to pdf file
				// wp_rg_lead_meta
				// wp_rg_lead_detail
				
                $pdf->SetFont('Arial', '', 12);
				$product_name = $product->get_name();
				$product_name = str_replace(['&quot;', 'â„¢'], '', $product_name);
				
               // $pdf->Cell(0, 10, 'Product: ' . $product_name, 0, 1);
				
                //$pdf->Cell(0, 10, 'SKU: ' . $product->get_sku(), 0, 1);
                $pdf->Cell(0, 10, 'Quantity: ' . $item->get_quantity(), 0, 1);
                $pdf->Cell(0, 10, 'Price: ' . $decoded_product_price, 0, 1);
            }
	
            // add more cells with order details as needed
            $pdf->Output('Order #' . $order_id . '.pdf', 'D');

        exit;
}
function enqueue_admin_styles() {
    wp_enqueue_style( 'admin-custom-style', get_stylesheet_directory_uri() . '/admin/admin-style.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles' );


/*
.print_pdf_button button{
    display: inline-block;
    text-decoration: none;
    font-size: 13px;
    line-height: 2.15384615;
    min-height: 30px;
    margin: 0;
    padding: 0 10px;
    cursor: pointer;
    border-width: 1px;
    border-style: solid;
    -webkit-appearance: none;
    border-radius: 3px;
    white-space: nowrap;
    box-sizing: border-box;
    color: #2271b1;
    border-color: #2271b1;
    background: #f6f7f7;
    vertical-align: top;
    margin-top: 5%;
}



*/


