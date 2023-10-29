
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
	// usage: [display_add_to_cart_button ID=""]
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


	function updateLinkedListAndOption($results, $optionName) {
	    $linked_list = array(); // Initialize the linked list
	
	    if (!empty($results)) {
	        foreach ($results as $row) {
	            $ID = $row->ID;
	            $node = array('ID' => $ID, 'next' => null);
	
	            // Insert the node into the linked list
	            if (empty($linked_list)) {
	                $linked_list = $node;
	            } else {
	                $current = &$linked_list;
	                while (!empty($current['next'])) {
	                    $current = &$current['next'];
	                }
	                $current['next'] = $node;
	            }
	        }
	
	        // Initialize an array to store the IDs
	        $idsArray = array();
	
	        // Traverse the linked list and store the IDs in the array
	        $current = &$linked_list;
	        while (!empty($current)) {
	            $idsArray[] = $current['ID'];
	            $current = &$current['next'];
	        }
	
	        // Serialize the array to a string
	        $serializedIds = serialize($idsArray);
	
	        // Store the serialized string in the specified option
	        update_option($optionName, $serializedIds);
	
	        // Traverse the linked list and print the IDs
	        $current = &$linked_list;
	        while (!empty($current)) {
	            // echo $current['ID'];
	
	            // Add a comma and space for separation, except for the last item
	            if (!empty($current['next'])) {
	                // echo ', ';
	            }
	
	            $current = &$current['next'];
	        }
	    } else {
	        echo 'No results found.';
	    }
	}
	
	updateLinkedListAndOption($results_30, 'discount_ids_30');
	updateLinkedListAndOption($results_20, 'discount_ids_20');
	updateLinkedListAndOption($results_20, 'discount_ids_10');


How to 'hack' a plugin

1. Change the plugin version number to 999.999.999 in the plugin header 
2. Create a backup of every file that was touched with an extrension of .bk in the same directory
