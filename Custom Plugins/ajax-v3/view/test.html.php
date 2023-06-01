<?php $the_query->the_post(); 
	  $featured_professional = get_post_meta( get_the_ID(), 'featured_professional', true ); 
	  $result = ($featured_professional == 'yes') ? "featured" : "";
?>
<div class = "professional-wrapper <?php echo $result; ?>">
	<?php
			$image = get_field( "image" ); 
			$designation_array = array();
	
			$field = get_field_object('designation');
			foreach ($field['value'] as $value)
			{
				$designation_array[$value]=$field['choices'][ $value ];
			}
			$cnt=0;
	
	?>
				<div class = "professional-item">
					<img src="<?php echo $image ?>" alt="" width="200" height="200"> 
				</div>
				<div class = "professional-item">
					<span class = "professional-name"><?php 
					 echo the_title(); 
					 if(!empty($designation_array)){
						 echo ', ';
						 foreach ($designation_array as $designation_key=>$designation_value)
						 {
							echo '<span class = "professional-designation">'.strtoupper($designation_value).'</span>'.($cnt == count($designation_array) - 1 ? '' : ', ');
							$cnt++;
						 }
					 }
					?></span>
					<?php
					$terms = get_the_terms($post->ID, 'expertise');
					if ($terms && !is_wp_error($terms)) {
						echo '<div class = "tag-wrapper"><div class="specialty_heading">Specialty</div>';
						foreach ($terms as $key => $term) {
							if ($key === key(array_slice($terms, -1, 1, true))) {
								// is the last element in the array
								echo '<span class = "specialty-tags">' . $term->name . '</span>';
							} else {
								//is not the last element in the array.
								echo '<span class = "specialty-tags">' . $term->name . '</span>, ';
							}
						}
						echo '</div>';
					}
					?>
					<?php echo the_excerpt(); ?>	
					<div class = "button-container">
						<a href = "<?php echo get_post_permalink() ?>">
							<div class = "read-more">Read More</div>
						</a>	
					</div>	
				</div>
</div>
<hr>