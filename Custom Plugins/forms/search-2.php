<?php

add_action('admin_menu', 'admin_page_create2');
function admin_page_create2() {
   
      $page_title = 'Reviews Search';
      $menu_title = 'Reviews Search';
      $capability = 'edit_posts';
      $menu_slug = 'Reviews Search';
      $function = 'admin_page_display2';
      $icon_url = 'dashicons-awards';
      $position = 3;
   
      add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
$function = 'admin_page_display2';

function admin_page_display2() {
	global $wpdb; ?>
    <h2>Product Reviews Search</h2>
    <form name="comment_search" method="post" action="<?php the_permalink();?>">
			<div class = "field_wrap">  
			  	<h2>Search JUST by Product Name</h2>
              <input type="text" id="search" name="search" placeholder="Enter Product Name"> 
			</div>
		 <hr style = "border-bottom: 2px solid black;">
			<div class = "field_wrap">  
			  	<h2>Or Search JUST by User Name</h2>
              <input type="text" id="user_name" name="user_name"  placeholder="Enter User Name"> 
			</div>
		   <hr style = "border-bottom: 2px solid black;">
			<div class = "field_wrap">  
				<h2>Search JUST by Date</h2>
              <input type="date" id="comment_date" name="comment_date" placeholder="Enter Start Date">
			</div>
		<div class = "field_wrap">  
			<input type="submit" value="Search" name = "submit"/>
		</div>	
	</form>
	<?php
	$product_title = '';
	$date = '';
	$user_name = '';
	if(!empty($_POST['submit'])){
		$product_title = $_POST['search'];
		// remove plural phrases
		$product_title_no_s = substr($product_title, 0, -1);
		//echo $product_title_no_s;
		
		$user_name = $_POST['user_name'];
		$date = $_POST['comment_date'];	
		//echo $product_title;
		//echo $user_name;
		//echo $date;
		
		// Sample Data:
		// Stair Climber™ Universal Strap
		// Keven Snyder
		// 2021-05-05 04:58:24
		// 2019-07-02 09:24:55
		
		if(!empty($date)){
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT `post_title` AS Product, 
					`comment_author` AS 'Customer_Name', 
					`comment_author_email` AS 'Customer_Email', 
					`comment_date` , 
					`comment_content` AS 'Comment' 
					FROM `wp_comments` 
					INNER JOIN `wp_posts` ON `comment_post_ID`=`ID` 
					WHERE `comment_author` != 'WooCommerce' 
					AND `comment_approved` = '1'
					
					AND comment_date LIKE '%$date%'

					ORDER BY `wp_comments`.`comment_date` DESC
					",
					$product_title,
					$user_name
					)
				);
		}elseif(!empty($user_name)){
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT `post_title` AS Product, 
					`comment_author` AS 'Customer_Name', 
					`comment_author_email` AS 'Customer_Email', 
					`comment_date` , 
					`comment_content` AS 'Comment' 
					FROM `wp_comments` 
					INNER JOIN `wp_posts` ON `comment_post_ID`=`ID` 
					WHERE `comment_author` != 'WooCommerce' 
					AND `comment_approved` = '1' 

					AND comment_author LIKE '%$user_name%' 

					ORDER BY `wp_comments`.`comment_date` DESC
					",
					$user_name
					)
				);
		}
		else{
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT `post_title` AS Product, 
					`comment_author` AS 'Customer_Name', 
					`comment_author_email` AS 'Customer_Email', 
					`comment_date` , 
					`comment_content` AS 'Comment' 
					FROM `wp_comments` 
					INNER JOIN `wp_posts` ON `comment_post_ID`=`ID` 
					WHERE `comment_author` != 'WooCommerce' 
					AND `comment_approved` = '1' 

					AND post_title LIKE '%$product_title%' 
					OR post_title LIKE '%$product_title_no_s%' 
					
					
					

					ORDER BY `wp_comments`.`comment_date` DESC
					",
					$product_title,
					)
				);
			}
		//print_r($results);
		if ( $results ) {
			foreach ( $results as $pointer ) {
				echo '<br>';
				echo $pointer->Product;
				echo '<br>';
				echo $pointer->Customer_Name;
				echo '<br>';
				echo $pointer->Customer_Email;
				echo '<br>';
				echo $pointer->comment_date;
				echo '<br>';
				echo $pointer->Comment;
				echo '<hr>';
			}
	   }
		
	}

}




