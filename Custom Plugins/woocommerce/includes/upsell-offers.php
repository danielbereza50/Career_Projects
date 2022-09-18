<?php 

class Upsell
{
    public function init()
   {
        $my_plugin = new Upsell();
        add_action('woocommerce_review_order_before_submit', array($my_plugin, 'microkit_checkout_add_on'));
    }// end of init
 
    public function microkit_checkout_add_on()
    {
         $product_ids = array( 36851 );
   $in_cart = false;
	global $woocommerce; $woocommerce->cart->get_cart();
   foreach( WC()->cart->get_cart() as $cart_item ) {
      $product_in_cart = $cart_item['product_id'];
      if ( in_array( $product_in_cart, $product_ids ) ) {
         $in_cart = true;
         break;
      }
   }
	//print_r($product_in_cart);
   if ( ! $in_cart ) {
	  echo '<div class = "micro_kit">';
      echo '<h4>Add a Micro Kit?</h4>';
      echo '<p><a class="button" style="margin-right: 1em; width: auto" href="?add-to-cart=36851"> $10 </a></p>';
	   echo '</div>';
	   echo '<style>
	   .micro_kit{
	   padding: 1% 1% 1% 1%;
	   }
	   </style>';
   }
    }// end of microkit_checkout_add_on
}

$my_plugin = new Upsell();
$my_plugin->init();
