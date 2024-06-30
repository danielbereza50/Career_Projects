<div class = "course-wrapper">
			<?php 
		  $the_query->the_post(); 
		  $course_id = get_the_ID(); 
		  $course_price = learndash_get_course_price($course_id);
		  $post_url = get_permalink();
		  $content = get_the_content();
	//echo $content;
		  $trimmed_content = wp_trim_words( $content, 5, '' );
		  $thumbnail = get_the_post_thumbnail();
		  $title = get_the_title();
		  $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	      $isPriceSet = $course_price['price'] = (!empty($course_price['price'])) ? '$'.$course_price['price'] : '';	
		  $current_categories = get_the_terms( get_the_ID(), 'ld_course_category' );
			if ( $current_categories && ! is_wp_error( $current_categories ) ) :
				foreach ( $current_categories as $current_category ) :
				  if ( $current_category->taxonomy === 'ld_course_category' ) :
					$current_category_name = $current_category->name;
					break;
				  endif;
				endforeach;
			 endif;
			if (!empty($course_id)) {
				$course_id = intval($course_id);
				$lessons = learndash_course_get_steps_by_type($course_id, 'sfwd-lessons');
				//print_r($lessons);
				$count = count($lessons);
			}
	
	
	

	
		?>
				<div class = "course-left">
				<?php echo '<div class="image-container">
				  <img src="' . $thumbnail_url . '" alt="">';
					if(!empty($isPriceSet)){
						echo '<div class="price-text">'.$isPriceSet.'</div>';
					}
				echo '</div>'; ?>
					
				</div>
				<div class = "course-right">
					<div class = "course-title"><?php echo the_title(); ?></div>
					<?php echo '<p class = "related-excerpt">' . ($count != 0 ? $count . ' Lessons / ' : 'No Lessons / ') . $current_category_name . '</p>'; ?>	
					<?php echo '<div class = "related-button"><a href="' . esc_url($post_url) . '">View Course</a></div>'; ?>
				</div>
	
</div>