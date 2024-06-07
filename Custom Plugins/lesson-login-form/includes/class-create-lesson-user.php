<?php


function get_ids_from_lesson_code($input_access_code) {
    // Get all users
    $users = get_users(array('fields' => array('ID')));

    // Loop through each user
    foreach ($users as $user) {
        $user_id = $user->ID;

        // Retrieve the serialized data from the user meta
        $serialized_data = get_user_meta($user_id, '_generated_lesson_codes', true);

        // Unserialize the data
        $lesson_codes = unserialize($serialized_data);

        // Check if unserialization was successful and if data exists
        if ($lesson_codes !== false && !empty($lesson_codes)) {
            // Loop through the array to find the matching access code
            foreach ($lesson_codes as $lesson) {
				$secretKey = include_config_file();
				$decrypted_lesson_code = decrypt_password($lesson['generated_lesson_code'], $secretKey);
                if (isset($lesson['generated_lesson_code']) && $decrypted_lesson_code === $input_access_code) {
                    return array(
                        'lesson_id' => $lesson['ID'],
                        'teacher_id' => $user_id
                    );
                }
            }
        }
    }

    // If no match is found, return false or a suitable default value
    return false;
}

/*
	 Jorge 
	 Doe
	 Lesson ID: 1308 / Lesson Code: YmAoTSTlIPKL6mcpxNvS / Cinderella Lesson 1
	 old leson code Lesson2CIND
	 Teacher is User ID 1 Josh Tull
	 user meta key _generated_lesson_codes
*/


add_action('wp_ajax_locate_teacher_lesson', 'locate_teacher_lesson');
add_action('wp_ajax_nopriv_locate_teacher_lesson', 'locate_teacher_lesson');
function locate_teacher_lesson() {
		global $wpdb;

		$table_prefix = $wpdb->prefix;

		$input_student_first_name = isset($_POST['input_student_first_name']) ? sanitize_text_field($_POST['input_student_first_name']) : '';
		$input_student_last_name = isset($_POST['input_student_last_name']) ? sanitize_text_field($_POST['input_student_last_name']) : '';
	
		$standardized_first_name = strtolower($input_student_first_name);
	    $standardized_last_name = strtolower($input_student_last_name);
	
	
		$input_access_code = isset($_POST['input_access_code']) ? sanitize_text_field($_POST['input_access_code']) : '';

		$result = get_ids_from_lesson_code($input_access_code);

       	$lesson_id = $result['lesson_id'];
		$lesson_url = get_permalink($lesson_id);
	
        $teacher_id = $result['teacher_id'];

        $post_title = get_the_title($lesson_id);
		
		if ($post_title) {
			// Use regular expression to extract any numeric value from the post title
			preg_match('/\d+/', $post_title, $matches);
			if (!empty($matches)) {
						$lesson_number = $matches[0];
			}
  	 	}
		
		$teacher_name = get_userdata($teacher_id)->display_name;
		$html .= "";
	
		include(THEME_PATH . '/views/join-the-class-student-code.html.php');
	
		if (!empty($result)) {
			
			// update user data
			
			// Check if user exists based on first name and last name
			// user_login
			$user_login = $standardized_first_name . '_' . $standardized_last_name;
			$student_id = username_exists($user_login);

			// If user does not exist, create a new user
			if (!$student_id) {
				// Generate a random password
				$random_password = wp_generate_password(20);

				// Create new user
				$student_id = wp_insert_user(array(
					'user_login'    => $standardized_first_name . '_' . $standardized_last_name,
					'user_pass'     => $random_password,
					'user_email'    => '', // Add email if available
					'first_name'    => $standardized_first_name,
					'last_name'     => $standardized_last_name,
					'nickname'      => $standardized_first_name . ' ' . $standardized_last_name,
					'display_name'  => $standardized_first_name . ' ' . $standardized_last_name
				));

				if (!is_wp_error($student_id)) {
					// Update user meta data
					update_user_meta($student_id, 'first_name', $standardized_first_name);
					update_user_meta($student_id, 'last_name', $standardized_last_name);
					update_user_meta($student_id, 'nickname', $standardized_first_name . ' ' . $standardized_last_name);
					update_user_meta($student_id, $table_prefix . 'capabilities', array('students' => true));
					update_user_meta($student_id, $table_prefix . 'user_level', 0);
					
					update_user_meta($student_id, '_associated_content', null);
					update_user_meta($student_id, '_sfwd-course_progress', null);
					
				}
				
			} // end of user ID if
			
			// update membership data
			 // Get the count of unique user IDs with the specified parent_id
	        $existing_relationships_count = $wpdb->get_var(
	            $wpdb->prepare(
	                "SELECT COUNT(DISTINCT user_id) FROM $wpdb->usermeta
	                WHERE meta_key = 'parent_id'
	                AND meta_value = %d",
	                $teacher_id
	            )
	        );
			
			$existing_relationships_count = $existing_relationships_count;
			
	      //  echo 'Existing Users: ' . $existing_relationships_count . '<br>';
	       // echo 'End Limit: ' . $end_number . '<br>';
			
			$active_memberships_teacher = wc_memberships_get_user_active_memberships($teacher_id);
			
			// Assuming the user has only one active membership
			$membership = current($active_memberships_teacher);

			// Check if $membership is an object
			if (is_object($membership)) {
				$membership_plan_id = $membership->get_plan_id();

			// Your existing code for processing memberships here
			} else {
					//echo 'No valid membership found for the user.';
			}
			// Your SQL query to retrieve product ID
						$sql = $wpdb->prepare("
							SELECT meta_value
							FROM {$wpdb->prefix}postmeta
							WHERE meta_key = %s
							AND post_id = %d
						", '_product_ids', $membership_plan_id);

						// Retrieve meta value from the database
						$meta_value = $wpdb->get_var($sql);

						// Unserialize the meta value
						$product_ids = unserialize($meta_value);

						// Check if product_ids is an array and not empty
						if (is_array($product_ids) && !empty($product_ids)) {
							// Get the first element of the array
							$product_id = reset($product_ids);

							// Query for the start_number meta value using product_id
							$start_number_meta_key = 'start_number';
							$start_number_sql = $wpdb->prepare("
								SELECT meta_value
								FROM {$wpdb->prefix}postmeta
								WHERE meta_key = %s
								AND post_id = %d
							", $start_number_meta_key, $product_id);
							$start_number = $wpdb->get_var($start_number_sql);
							//$start_number = 1;

							// Query for the end_number meta value using product_id
							$end_number_meta_key = 'end_number';
							$end_number_sql = $wpdb->prepare("
								SELECT meta_value
								FROM {$wpdb->prefix}postmeta
								WHERE meta_key = %s
								AND post_id = %d
							", $end_number_meta_key, $product_id);
							$end_number = $wpdb->get_var($end_number_sql);
							//$end_number = 2;

							// Output the values
							//echo "Start Number: $start_number<br>";
							//echo "End Number: $end_number<br>";
						} else {
							//echo "No product ID found.";
						}

			// Check if the child user already has an active membership
	        $active_memberships_student = wc_memberships_get_user_active_memberships($student_id);

			 if (!empty($active_memberships_student)) {
	            // If the child user already has a membership, display relevant information
	            $first_membership = reset($active_memberships_student);
	            //echo 'Child user already has an active membership. Membership ID: ' . $first_membership->get_id();
	        } else {
	            // Limit the number of child accounts underneath a licensed user to 2
	            if ($existing_relationships_count < $end_number) {
	
					update_user_meta($student_id, 'parent_id', $teacher_id);

					// Get the existing serialized string from user meta
					$existing_serialized_child_ids = get_user_meta($teacher_id, 'child_ids', true);

					// If there's no existing serialized string, initialize an empty array
					$child_ids = !empty($existing_serialized_child_ids) ? unserialize($existing_serialized_child_ids) : array();

					// Add the new child user ID to the array
					$child_ids[] = $student_id;

					// Serialize the updated array
					$serialized_child_ids = serialize($child_ids);

					// Update user meta with the serialized string
					update_user_meta($teacher_id, 'child_ids', $serialized_child_ids);

	                $args = array(
	                    'plan_id' => $membership_plan_id,
	                    'user_id' => $student_id,
	                );
	                wc_memberships_create_user_membership($args);

	            } else {
	                // Optionally, provide a message to the user that the limit has been reached
	                echo '<p>Sorry, the maximum number of child accounts has been reached for this parent.</p>';
	            }
	        }
					
			// update session data
			$session_id = md5(uniqid());
			$device_identifier = $_SERVER['HTTP_USER_AGENT']; // Example device identifier, you may need to use a more robust method
			
			$sessions_table_name = $wpdb->prefix . 'custom_sessions';
       		$meta_table_name = $wpdb->prefix . 'custom_session_meta';
			
			// Delete existing session record in sessions table
			$wpdb->delete($sessions_table_name, array('user_id' => $student_id));
			$wpdb->delete($meta_table_name, array('user_id' => $student_id));

			// Update or insert session record in sessions table
			if ($existing_session = $wpdb->get_row($wpdb->prepare("SELECT * FROM $sessions_table_name WHERE user_id = %d AND device_identifier = %s", $student_id, $device_identifier))) {
				$wpdb->update($sessions_table_name, array('session_id' => $session_id), array('id' => $existing_session->id));
			} else {
				$wpdb->insert($sessions_table_name, array('session_id' => $session_id, 'user_id' => $student_id, 'device_identifier' => $device_identifier));
			}

			// Update or insert session record in meta table
			if ($existing_meta) {
				$wpdb->update($meta_table_name, array('user_id' => $user_id), array('user_id' => $student_id));
			} else {

					// Retry mechanism for inserting record in meta table
					$max_retries = 3;
					$attempt = 0;
					$insert_success = false;

					while ($attempt < $max_retries && !$insert_success) {
						$insert_success = $wpdb->insert($meta_table_name, array('user_id' => $student_id, 'user_id' => $student_id));
						if (!$insert_success) {
							$attempt++;
							// Optionally, you can add a small delay between retries
							usleep(500000); // 500ms delay
						}
					}

				   if (!$insert_success) {
						// Handle the error accordingly
						error_log("Failed to insert record into meta table for user_id: $student_id after $max_retries attempts.");
						return false;
				   }
			}
			
			// SELECT * FROM `wp_g3mmvh_custom_session_meta` 
			// $input_access_code
			// lesson_code
			$secretKey = include_config_file();
			// Sanitize input
			$input_access_code = $wpdb->prepare('%s', $input_access_code);

			// Remove single quotes from input
			$input_access_code = str_replace("'", "", $input_access_code);
			
			$decrypted_lesson_code = decrypt_password($input_access_code, $secretKey);
			

			// Run the SQL query
			$query = $wpdb->prepare("UPDATE $meta_table_name SET lesson_code = %s WHERE user_id = %d", $decrypted_lesson_code, $student_id);

			// Execute the query
			$result = $wpdb->query($query);
			
			 // Log in the user
            $user = get_user_by('id', $student_id);
            if ($user) {
                wp_clear_auth_cookie();
                wp_set_current_user($student_id, $user->user_login);
                wp_set_auth_cookie($student_id);
               // do_action('wp_login', $user->user_login);
            }
			
			// Data found, create JSON response
			$response = array(
				'success' => true,
				'message' => 'Lesson found',
				'data' => array(
					'student' => "$input_student_first_name $input_student_last_name",
					'lesson_id' => $lesson_id,
					'lesson_code' => $input_access_code,
					'lesson_title' => $post_title,
					'lesson_number' => $lesson_number,
					'teacher_id' => $teacher_id,
					'teacher_name' => $teacher_name,
					'lesson_url' => $lesson_url,
				)
			);
				$html .=  '<div class = "lesson_teacher_response" style = "display:none;">' . json_encode($response). '</div>';
		} else {
			// No data found, create JSON response
			$response = array(
				'success' => false,
				'message' => 'No lesson found'
			);
			$html .=  '<div class = "lesson_teacher_response" style = "display:none;">' . json_encode($response). '</div>';
		}
	
			
	
	
	
    echo $html;
   