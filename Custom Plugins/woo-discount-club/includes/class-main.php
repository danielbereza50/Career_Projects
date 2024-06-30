<?php


add_shortcode('display_top_items', 'get_top_items');
function get_top_items(){
    ob_start();
	
	echo '<div class="loyalty-message-container">
		  <p class="loyalty-intro">Introducing Our Exclusive Loyalty Club Program!</p> 
		</div>
		';
	
	global $wpdb;
	
	if (is_user_logged_in()) {
		
		
	
		$user_id = get_current_user_id(); // Get the current logged-in user's ID
		
		require_once(__DIR__.'/../models/cart-queries.php');
		// 10123

		
		require_once(__DIR__.'/../includes/class-eligibility-check.php');
		
		
		// print_r($results_10);
		
		include('class-discount-sql.php');
		include('class-discount-ids.php');
		
		generateProductHTMLWithCondition($results_30, 30, LC_INDEX . 'public/images/save-30-v3.png', $total_spent_final);
		generateProductHTMLWithCondition($results_20, 20, LC_INDEX . 'public/images/save-20.png', $total_spent_final);
		generateProductHTMLWithCondition($results_10, 10, LC_INDEX . 'public/images/save-10.png', $total_spent_final);	
		
		
	}else{
		echo '<span class = "you-can-save">Look at all of the things you can save on your next order. If you like to place an order and get these savings, <a href = "/my-account/">login here</a></span>';

	    include('class-discount-sql.php');
		include('class-discount-ids.php');
		
		echo '<div class = "logged-out">';
		
			generateProductHTML($results_30, 30, LC_INDEX . 'public/images/save-30-v3.png');
			generateProductHTML($results_20, 20, LC_INDEX . 'public/images/save-20.png');
			generateProductHTML($results_10, 10, LC_INDEX . 'public/images/save-10.png');	
		
		echo '</div>';
		
	}

    return ob_get_clean();
}
function generateProductHTMLWithCondition($results, $percentage, $imagePath, $total_spent_final) {
    if (!empty($results)) {
        if ($total_spent_final > 500) {
            generateProductHTML($results, $percentage, $imagePath);
        } else {
            generateProductHTML($results, 0, $imagePath);
        }
    } else {
        echo 'No best-selling items found.';
    }
}
function generateProductHTML($results, $discountPercentage, $imageURL) {
	
	
			echo '<div class="loyalty-container">
					<div class="loyalty-row">';

			$counter = 0;

			foreach ($results as $result) {
				$product_id = $result->ID;
				$product_title = $result->post_title;
				$product_url = get_permalink($product_id);
				$featured_image_id = get_post_thumbnail_id($product_id);
  				$featured_image_url = wp_get_attachment_image_src($featured_image_id, array(180, 180));
				//$featured_image_url = get_the_post_thumbnail_url($product_id, array(300, 300));
				$original_price = $result->product_price;
				$discounted_price = $original_price - ($original_price * $discountPercentage / 100);

				if (!empty($featured_image_url)) {
					 $featured_image_url = $featured_image_url[0]; // Get the URL from the array
					
					echo '<a href="' . esc_url($product_url) . '" class="loyalty-column">'; // Wrap the entire column in an anchor link
					echo '<img class="sale-image" src="' . esc_url($imageURL) . '" alt="price" width="130" height="130">'; // Set width and height
					
					
					 // Output the featured image with the specified dimensions
					echo wp_get_attachment_image(
						$featured_image_id,
						array(180, 180),
						false,
						array('class' => 'loyalty-featured-image', 'alt' => esc_attr($product_title))
					);
					
					//cho '<img src="' . esc_url($featured_image_url) . '" alt="' . esc_attr($product_title) . '" width="180" height="180">'; // Set width and height
					
					echo '<h3>' . esc_html($product_title) . '</h3>';
					echo '<div class="price-display">';
					echo '<p class="original-price">$' . esc_html($original_price) . '</p>';
					echo '<p class="discounted-price">$' . (isset($discounted_price) ? number_format($discounted_price, 2) : '.00') . '</p>';
					echo '</div>';
					echo '</a>'; // Close the anchor link
					$counter++;

					if ($counter % 3 === 0) {
						echo '</div>
						<div class="loyalty-row">';
					}
				}
			}

			echo '</div>
				</div>';
	
}


