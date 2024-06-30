<?php

			// Determine if the button should be enabled or disabled
			$button_class = !empty($_POST['input_access_code']) ? 'enabled-btn' : 'disabled-btn';

				$html .= "<div class = 'join-class-container' id = 'join-class-container'>";
						$html .= "<div class = 'join-class-row'>";
							$html .= "<div class = 'join-class-column'>";
								$html .= "<div class = 'join-the-class-wrapper'>";
									$html .= "<img src='/wp-content/uploads/2024/03/Icon-school-transparent.png' alt='School Icon'>";

									$html .= '<div class = "student_name_wrapper">';

										 $html .= "<input type='text' class='class-student-input' name='input_student_first_name' id='input_student_first_name' value='" . ($input_student_first_name !== '' ? $input_student_first_name : '') . "' placeholder='Please enter your first name'>";
		$html .= "<input type='text' class='class-student-input' name='input_student_last_name' id='input_student_last_name' value='" . ($input_student_last_name !== '' ? $input_student_last_name : '') . "' placeholder='Please enter your last name'>";

									$html .= '</div>';


								$html .= "<input type='text' class='class-student-input' name='input_access_code' id='input_access_code' value='" . ($input_access_code !== '' ? $input_access_code : '') . "' placeholder='Please enter the code'>";


									$html .= "<input type='submit' class='join-code-by-name join-class-item $button_class' value='Submit'>";



								//	$html .= "<button class='begin_session begin_session_" . $lesson_number . " disabled-btn' id='begin_session' disabled>Continue</button>";


								$html .= "</div>"; // end of wrapper 
							$html .= "</div>"; // end of  column 
						$html .= "</div>"; // end of row

					


				$html .= "</div>"; // end of container
				//$html .= "<div id = 'replace-test-final'></div>"; // end of row

				


	/*
				$access_code = '6BF1kuw9YK4AjP4wo34P'; // Example access code
				$result = get_ids_from_lesson_code($access_code);

				if ($result !== false) {
					echo "Lesson ID: " . $result['lesson_id'] . " User ID: " . $result['user_id'];
				} else {
					echo "No matching lesson found for the access code.";
				}
			

	*/




