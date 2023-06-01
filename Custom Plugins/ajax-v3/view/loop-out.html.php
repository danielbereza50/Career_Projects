<?php
	if ( count( $results ) > 0 ) {
	  foreach ( $results as $row ) {
		$post_id = $row->ID; 
		$post_title = $row->post_title;
		$post_url = get_permalink( $post_id );	
		$excerpt = get_the_excerpt($post_id);  

		$first_name = get_post_meta( $post_id, 'first_name', true );
		$last_name = get_post_meta( $post_id, 'last_name', true );
		$designations = get_post_meta( $post_id, 'designation', true );
		$location_city_state = get_post_meta( $post_id, 'location_city_state', true );
		$website_url = get_post_meta( $post_id, 'website_url', true );
		$image  = get_field('image', $post_id);
		$prof_email = get_post_meta( $post_id, 'prof_email', true );  

		//print_r($expertises);
		  
		$featured_professional = get_post_meta( $post_id, 'featured_professional', true ); 
		$result = ($featured_professional == 'yes') ? "featured" : "";  
?>
	<div class = "professional-wrapper <?php echo $result; ?>">
					<div class = "professional-item">
						<img src="<?php echo $image ?>" alt="" width="200" height="200"> 
					</div>
					<div class = "professional-item">
						<span class = "professional-name"><?php 
							 echo $post_title; 
							 $cnt=0;	 
							 if(!empty($designations)){
								echo ', ';
								foreach ($designations as $designation ) {
									echo '<span class = "professional-designation">'.strtoupper($designation).'</span>'.($cnt == count($designations) - 1 ? '' : ', ');
									$cnt++;

								} 
							}	?> 
						  </span>
							<?php
						$terms = get_the_terms($post_id, 'expertise');
						echo '<div class = "tag-wrapper">
								<div class="specialty_heading">Specialty</div>';
										if ($terms && !is_wp_error($terms)) {
										  // Loop through each term object and output its name and link
										  foreach ($terms as $term) {
											  if ( $term === end( $terms ) ) {
												// This is the last element of the array
												echo '<span class = "specialty-tags">' . $term->name . '</span>';
											} else {
												// This is not the last element of the array
												echo '<span class = "specialty-tags">' . $term->name . '</span>, ';
											}  
										  }
										}
						echo '</div>';
						?>
						<?php echo $excerpt ?>	
						<div class = "button-container">
							<a href = "<?php echo $post_url ?>">
								<div class = "read-more">Read More</div>
							</a>	
						</div>	
					</div>
	</div>
<hr>
<?php
		}
}else{
		//echo 'No results returned';
}