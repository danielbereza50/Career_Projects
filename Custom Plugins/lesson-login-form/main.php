<?php
/*
    Plugin Name: Custom code
    Plugin URI:  
    Description: Added on functionality. 
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

include __DIR__.'/includes/class-pw-hash.php';




add_shortcode('display_join_the_class', 'get_join_the_class');
function get_join_the_class(): string {
        global $wpdb;
        
        include(THEME_PATH . '/views/join-the-class-student-code.html.php');    
        
        ?>
          <script>
              
                    /*
                    $(document).on('click', '.begin_session_2', function(event) {
                        beginSession('lesson_2_waiting_room', 'lesson-container-2');
                    });
                */
              
              $(document).on('click', '.join-code-by-name', function() {
                    var input_student_first_name = $('#input_student_first_name').val();
                    var input_student_last_name = $('#input_student_last_name').val();
                    var input_access_code = $('#input_access_code').val();
                    
                    console.log('Input First Name: ', input_student_first_name);
                    console.log('Input Last Name: ', input_student_last_name);
                    console.log('Input Lesson Code: ', input_access_code);
                    
                    jQuery.ajax({
                        type: 'POST',
                        url: al.ajaxurl,
                        data: { 
                            action: 'locate_teacher_lesson',
                            input_student_first_name: input_student_first_name,
                            input_student_last_name: input_student_last_name,
                            input_access_code: input_access_code,
                        },
                         success: function(data) {
                             
                             
                             // Find the starting index of the JSON data
                                var jsonStartIndex = data.indexOf('{');

                                // Find the ending index of the JSON data
                                var jsonEndIndex = data.lastIndexOf('}');

                                // Extract the JSON substring from the response
                                var jsonData = data.substring(jsonStartIndex, jsonEndIndex + 1);

                                // Parse JSON response
                                var responseData = JSON.parse(jsonData);

                                // Log the parsed JSON data
                                console.log('Parsed JSON Data:', responseData);
                             
                                 // Get the lesson_url value from the responseData object
                                var lessonUrl = responseData.data.lesson_url;

                                // Log the extracted lesson_url
                                console.log('Lesson URL:', lessonUrl);

                                // Check the value of the "success" key
                                var isSuccess = responseData.success;

                                // Check status property
                                if (isSuccess) {
                                    jQuery('#join-class-container').html(data);
                                    var lesson_id = $('#page_id').val();
                                    var user_id = $('#user_id').val();              

                                    console.log('Lesson ID',lesson_id);
                                    console.log('User ID', user_id);
                                    
                                    alert('You have joined the class!');
                                    
                                    // Redirect to a different URL
                                    window.location.href = lessonUrl;

                                    /*
                                     
                                    jQuery.ajax({
                                        url: al.ajaxurl,
                                        type: 'post',
                                        data: { 
                                            action: '<?php //echo urlencode($last_lesson_screen); ?>',

                                            userId: user_id,
                                            lesson_id:lesson_id,

                                            courseId:courseId,


                                        },
                                        success: function(data) {
                                            jQuery('#lesson-container-<?php //echo $lessonNumber; ?>').html(data);
                                            console.log('Last Lesson Code: <?php //echo urlencode($last_lesson_screen); ?>');


                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.error("AJAX Request Error:", textStatus, errorThrown);
                                    }
                                });
                                
                               */
                                    
                                    //$('#begin_session').removeClass('disabled-btn').removeAttr('disabled');
                                } else {
                                    alert('Invalid code');
                                    //$('#begin_session').addClass('disabled-btn').attr('disabled', 'disabled');
                                }
                             
                            console.log(data);
                         
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX request failed:', status, error);
                        }
                    });
                });
            </script>

        
        
        <?php
        
        return $html;
    }




add_action('wp_ajax_generate_lesson_codes', 'generate_lesson_codes');
add_action('wp_ajax_nopriv_generate_lesson_codes', 'generate_lesson_codes');
function generate_lesson_codes() {
    global $wpdb;

    // Ensure it's a logged-in user
    if (!is_user_logged_in()) {
        wp_send_json_error('User is not logged in.');
    }

	 // Call the function to include the config.php file
    $secretKey = include_config_file();
	
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : get_current_user_id();

    // Check if user ID is valid
    if (!$user_id) {
        wp_send_json_error('Invalid user ID.');
    }

    // Get post IDs from sfwd-lessons post type with 'publish' status
	$lessons_query = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_status = %s",
			'sfwd-lessons',
			'publish'
		)
	);

    // Check if there are lessons
    if (empty($lessons_query)) {
        wp_send_json_error('No lessons found.');
    }

    // Retrieve existing lesson codes or initialize as empty array
    $existing_lesson_codes = get_user_meta($user_id, '_generated_lesson_codes', true);
    $lesson_ids_array = $existing_lesson_codes ? unserialize($existing_lesson_codes) : array();

    $new_lesson_generated = false; // Flag to track if any new lesson codes were generated

    // Loop through lessons
    foreach ($lessons_query as $lesson_id) {
        $existing = false;
        // Check if lesson ID already exists
        foreach ($lesson_ids_array as $lesson_data) {
            if ($lesson_data['ID'] == $lesson_id) {
                $existing = true;
                break;
            }
        }

        // If lesson ID doesn't exist, generate code and add to array
        if (!$existing) {
            $generated_lesson_code = generate_random_code(10);
			// Call the function to encrypt and decrypt the password
			//$encrypted_lesson_code = encrypt_decrypt_password($generated_lesson_code, $secretKey, 'encrypt');
			
			$encrypted_lesson_code = encrypt_password($generated_lesson_code, $secretKey);
            $lesson_ids_array[] = array('ID' => $lesson_id, 'generated_lesson_code' => $encrypted_lesson_code);
			
            $new_lesson_generated = true; // Set flag to true if new lesson code is generated
        }
    }

    // If no new lesson codes were generated and user already has codes, send error
    if (!$new_lesson_generated && !empty($lesson_ids_array)) {
        wp_send_json_error('Lesson codes already exist for the user.');
    }

    // Serialize the array
    $serialized_lesson_ids = serialize($lesson_ids_array);

    // Update user meta with serialized lesson IDs
    update_user_meta($user_id, '_generated_lesson_codes', $serialized_lesson_ids);

    // Send success response
    wp_send_json_success('Lesson codes generated and saved successfully.');

    // Make sure to die to end the AJAX request
    wp_die();
}












