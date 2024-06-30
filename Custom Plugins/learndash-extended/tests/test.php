<?php

// http://elearning.13waysinc.com/test/

add_shortcode('display_test', 'custom_ld_lesson_list1');
function custom_ld_lesson_list1($atts) {
	
	$atts = shortcode_atts(array(
        'course_id' => '',
    ), $atts, 'ld_lesson_list');

	
	
	
	ob_start();
	
    //if (!empty($atts['course_id'])) {
      $course_id = intval($atts['course_id']);
 		global $wpdb;
		$results = $wpdb->get_results(
			"SELECT DISTINCT p.post_title, p.post_content, p.post_name
			 FROM {$wpdb->posts} p
			 INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
			 WHERE p.post_type = 'sfwd-topic'
			 AND pm.meta_key = '_sfwd-topic'
			 AND pm.meta_value LIKE '%{$atts['course_id']}%'
			 "
		);
	?>


	
<?php	
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







