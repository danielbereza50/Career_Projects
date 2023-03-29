
  Libraries / Snippets Used

  Name: 

  Version: 

  Purpose: 

  License: MIT

  Website: https://github.com/
  




  Future Features:
  
  1. 




-----------------------

	Basic function structure

	// returns a string value
	// [display_add_to_cart_button ID=""]
	add_shortcode('display_add_to_cart_button', 'custom_add_to_cart_button');
	function custom_add_to_cart_button($atts){
	
	extract( shortcode_atts( array(
        'id' => '',
    ), $atts ) );
	
	global $wp;
	$url = home_url( $wp->request );
	$post_id = $atts['id'];
	$html .= ' <div class = "custom_button_container">
					<button type="button">
					<a href = "'.$url.'/?add-to-cart='.$post_id.'">Add to Cart</a>
					</button>
				</div>';
	return $html;
}



How to 'hack' a plugin

1. Change the plugin version number to 999.999.999 in the plugin header 
2. Create a backup of every file that was touched with an extrension of .bk in the same directory
