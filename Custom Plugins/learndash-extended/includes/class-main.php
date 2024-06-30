<?php 

function breadcrumbs_shortcode($atts) {
  $atts = shortcode_atts(array(
    'separator' => '/',
    'home_text' => 'Home'
  ), $atts);

  $output = '<div class="breadcrumbs">';
  $output .= '<a href="' . home_url() . '">' . $atts['home_text'] . '</a> ' . $atts['separator'] . ' ';

  if (is_category() || is_single()) {
    $categories = get_the_category();
    if ($categories) {
      foreach ($categories as $category) {
        $output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> ' . $atts['separator'] . ' ';
      }
    }
    $output .= get_the_title();
  } elseif (is_page()) {
    $ancestors = get_post_ancestors(get_the_ID());
    if ($ancestors) {
      foreach ($ancestors as $ancestor) {
        $output .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a> ' . $atts['separator'] . ' ';
      }
    }
    $output .= get_the_title();
  } elseif (is_search()) {
    $output .= 'Search Results';
  } elseif (is_404()) {
    $output .= 'Page Not Found';
  } else {
    $output .= get_the_title();
  }

  $output .= '</div>';

  return $output;
}

add_shortcode('breadcrumbs', 'breadcrumbs_shortcode');
add_shortcode( 'display_user_info', 'get_user_info' );
function get_user_info( $atts ) {
	ob_start();
    $user_id = get_current_user_id();
    $avatar_url = get_avatar_url( $user_id );
    if ( $avatar_url ) {
      echo '<div class = "avatar-img">
	 	 <img src="' . $avatar_url . '" />
	  </div>';
    }
	echo '<div class = "user-txt">
			<a href = "/login/">User Login</a>
		</div>';
	return ob_get_clean();
}
function my_course_price_shortcode() {
	ob_start();
    $course_id = get_the_ID(); // Get the ID of the current course
	$course_price = learndash_get_course_price($course_id);
   // print_r($course_price['price']);
    if ($course_price['price'] != 0) {
        $html .= '<p class = "course-txt"> $' . $course_price['price'] . '</p>';
    }else{
		 $html .= '<p class = "course-txt">No price set</p>';
	}
	return $html;
}
add_shortcode( 'course_price', 'my_course_price_shortcode' );
add_shortcode( 'enrollment_status', 'validate_user_enrolled' );
function validate_user_enrolled($courses, $current_user) {
	ob_start();
	
    $current_user = wp_get_current_user();
    $course_id = get_the_ID(); 
	
    if(sfwd_lms_has_access($course_id, $current_user->ID) ) { 
        echo '<div class = "enrolled-btn"><button>ENROLLED</button></div>';
    }else{
		 echo '<div class = "enrolled-btn"><button>NOT ENROLLED</button></div>';
	}
	
	return ob_get_clean();
}
add_shortcode('display_featured', 'featured_courses');
function featured_courses() {
	ob_start();
	
	$args = array(
	  'post_type' => 'sfwd-courses',
	  'posts_per_page' => 3,
	  'orderby' => 'date',
 	  'order' => 'ASC', 
	  'meta_query' => array(
        array(
            'key' => 'featured_course',
            'value' => 'yes',
            'compare' => '=',
        	),
    	),
	);
	$query = new WP_Query($args);

	if ($query->have_posts()) :
		echo '<div class = "featured-container">';
		  while ($query->have_posts()) :
			$query->the_post();

			$post_url = get_permalink();
			$content = get_the_content();
			$trimmed_content = wp_trim_words( $content, 5, '' );
			$thumbnail = get_the_post_thumbnail();
			$title = get_the_title();
	
			echo '<div class = "featured-wrapper">';
			   echo '<div class="featured-left">' . $thumbnail . '</div>';
				echo '<div class = "featured-right">';
					echo '<div class = "featured-title">'.$title.'</div>';
					echo '<p class = "featured-excerpt">' . esc_html($trimmed_content) . '</p>';
					echo '<div class = "featured-button"><a href="' . esc_url($post_url) . '">View Course</a></div>';
				echo '</div>';

			echo '</div>';
		  endwhile;
		echo '</div>';
	endif;
	wp_reset_postdata();

	return ob_get_clean();
}	
add_shortcode('display_related_courses', 'get_related_courses');
function get_related_courses() {
	ob_start();
	$args = array(
	  'post_type' => 'sfwd-courses',
	  'posts_per_page' => 3,
	  'orderby' => 'date',
 	  'order' => 'ASC', 
		
		
	);
	$query = new WP_Query($args);
    //print_r($query);
    
	if ($query->have_posts()) :
		echo '<div class = "related-container">';
		  while ($query->have_posts()) : $query->the_post();
		  $current_categories = get_the_terms( get_the_ID(), 'ld_course_category' );
			if ( $current_categories && ! is_wp_error( $current_categories ) ) :
				foreach ( $current_categories as $current_category ) :
				  if ( $current_category->taxonomy === 'ld_course_category' ) :
					$current_category_name = $current_category->name;
					break;
				  endif;
				endforeach;
			  endif;

		  $course_id = get_the_ID(); 
		  $course_price = learndash_get_course_price($course_id);
		  $post_url = get_permalink();
		  $content = get_the_content();
		  $trimmed_content = wp_trim_words( $content, 5, '' );
		  $thumbnail = get_the_post_thumbnail();
		  $title = get_the_title();
		  $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	      $isPriceSet = $course_price['price'] = (!empty($course_price['price'])) ? '$'.$course_price['price'] : '';
		  //print_r($course_price);
		  
	 	   if (!empty($course_id)) {
				$course_id = intval($course_id);
				$lessons = learndash_course_get_steps_by_type($course_id, 'sfwd-lessons');
				//print_r($lessons);
				$count = count($lessons);
			}
	
			echo '<div class = "related-wrapper">';
	
			   echo '<div class="related-left">
			   <div class="image-container">
				  <img src="' . $thumbnail_url . '" alt="">';
					if(!empty($isPriceSet)){
						echo '<div class="price-text">'.$isPriceSet.'</div>';
					}
				echo '</div>
				
			   </div>';
	
				echo '<div class = "related-right">';
					echo '<div class = "related-title">'.$title.'</div>';
					echo '<p class = "related-excerpt">' . ($count != 0 ? $count . ' Lessons / ' : 'No Lessons / ') . $current_category_name . '</p>';
					echo '<div class = "related-button"><a href="' . esc_url($post_url) . '">View Course</a></div>';
				echo '</div>';
	
	
			echo '</div>';
		  endwhile;
		echo '</div>';
	endif;
	wp_reset_postdata();

	return ob_get_clean();
}	
add_shortcode('display_custom_lesson_list', 'custom_ld_lesson_list');
function custom_ld_lesson_list() {
	ob_start();
	$course_id = get_the_ID();
    if (!empty($course_id)) {
        $course_id = intval($course_id);
        $lessons = learndash_course_get_steps_by_type($course_id, 'sfwd-lessons');
		//print_r($lessons);
		
		$count = 0;
		if(empty($lessons)){
			echo 'No Lessons found';
		}
		
		foreach($lessons as $lesson){
			//echo $lesson;
			$lesson = get_post( $lesson );
			//print_r($lesson);
			if(!empty($lesson)){
				
			  echo '<div class = "lessons-txt">';
				echo '<a href = "/lessons/'.$lesson->post_name.'/">
							<input type="radio" name="option-'.$count.'" value="option-'.$count.'">
							<span class = "lesson-title">' . $lesson->post_title . '</span>
					  </a>'; 
			  echo '</div>';
			  echo '<br>';
			}
			$count++;
		}
	}
	return ob_get_clean();
}
add_shortcode('display_custom_topic_list', 'custom_ld_topic_list');
function custom_ld_topic_list() {
		ob_start();
	
    	$course_id = get_the_ID();
   		if (!empty($course_id)) {
			$course_id = intval($course_id);
			global $wpdb;
			$results = $wpdb->get_results(
				"SELECT DISTINCT p.post_title, p.post_content, p.post_name
				 FROM {$wpdb->posts} p
				 INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
				 WHERE p.post_type = 'sfwd-topic'
				 AND pm.meta_key = '_sfwd-topic'
				 AND pm.meta_value LIKE '%{$course_id}%'
				 "
				);
		}

		$count = 0;
		if(!empty($results)){
		foreach ($results as $result) {
			//echo $count;
			echo '<div id = "course-wrapper-'.$count.'" class = "course-wrapper-topics">';
				echo '<a href = "/topic/'.$result->post_name.'/">';
					echo '<input type="radio" name="option-'.$count.'" value="option-'.$count.'">';
				echo '</a>';
			echo '<span id = "course-top-title-'.$count.'" class = "course-title-topics">'. $result->post_title . 
				 '</span> 
				 <i id = "arrow-course-'.$count.'" class="arrow down"></i>
					' . $result->post_content.'
				 <br>';
			echo '</div>';
		$count++;
		}	
	}else{
			echo 'No topics found';
	}
	return ob_get_clean();
}

















