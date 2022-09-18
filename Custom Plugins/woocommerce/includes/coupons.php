<?php 

add_action('woocommerce_cart_calculate_fees', 'buy_five_get_one_free', 10, 1 );
function buy_five_get_one_free( $wc_cart ){
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    $cart_item_count = $wc_cart->get_cart_contents_count();
    if ( $cart_item_count < 5 ) return;

    // Set HERE your coupon codes
    $coupons_codes = array('onefree', 'anothercouponcode');
    $discount = 0; // initializing

    $matches = array_intersect( $coupons_codes, $wc_cart->get_applied_coupons() );
    if( count($matches) == 0 ) return;

    // Iterating through cart items
    foreach ( $wc_cart->get_cart() as $key => $cart_item ) {
        $qty = intval( $cart_item['quantity'] );
        // Iterating through item quantities
        for( $i = 0; $i < $qty; $i++ )
            $items_prices[] = floatval( wc_get_price_excluding_tax( $cart_item['data'] ) );
    }
	
	//print_r($items_prices);
    asort($items_prices); // Sorting cheapest prices first

    // Get the number of free items (detecting odd or even number of prices)
    if( $cart_item_count % 2 == 0 ) 
		$free_item_count = ($cart_item_count - 1) / 4.75;
    else  $free_item_count = ($cart_item_count - 1) / 4.75;
	
	if($cart_item_count === 5){
		$free_item_count = 1;
	}
	if($cart_item_count === 10){
		$free_item_count = 2;
	}
	if($cart_item_count === 39){
		$free_item_count = 7;
	}
	if($cart_item_count === 49){
		$free_item_count = 9;
	}
    // keeping only the cheapest free items prices in the array
    $free_item_prices = array_slice($items_prices, 0, $free_item_count);

    // summing prices for this free items
    foreach( $free_item_prices as $key => $item_price )
        $discount -= $item_price;

    if( $discount != 0 ){
        // The discount
        $label = '"'. strtoupper(reset($matches)) .'" '.__("discount");
        $wc_cart->add_fee( $label, number_format( $discount, 2 ), true, 'standard' );
        # Note: Last argument in add_fee() method is related to applying the tax or not to the discount (true or false)
    }
}
remove_filter( 'woocommerce_coupon_code', 'strtolower' ); // Remove coupons case-insensitive filter