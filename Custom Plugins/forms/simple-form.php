<?php
	add_shortcode('contact_form', 'simple_form');
	function simple_form(){
		if(isset($_POST['submit_request'])){  
			if($_POST['email'] != $_POST['email_confirm']){
				echo '<div class="test">';
					echo ' <div class="container">';
						echo 'Emails do not match, try again';
					echo '</div>';
				echo '</div>';
			}
			if($_POST['email'] === $_POST['email_confirm']){
				$first_name = $_POST['first_name'];
	  			$last_name = $_POST['last_name'];
	 		    $email = $_POST['email'];
				$hear_out = $_POST['hear_out'];
				$message = $_POST['message'];
				
				
				$email_from = 'noreply@domain.com';
				$email_subject = "Hello";
				$email_body = "You have received a new request for access:\n".
	                           "First Name: $first_name.\n".
							   "Last Name: $last_name.\n".
					 		   "Email: $email.\n".
							   "Hear About:\n $hear_out.\n".
							   "Message:\n $message.\n".
				
				$to = "noreply@gmail.com";
	  			$headers = "From: $email_from \r\n";
	 			$headers .= "Reply-To: $email \r\n";
	  			mail($to,$email_subject,$email_body,$headers);
				
			    echo '<div class="test">';
					echo ' <div class="container">';
					echo 'Your request has been sent. These requests are typically reviewed within 24 hours. Thank you!';
					echo '</div>';
				echo '</div>';
			}
		}  
		  ob_start(); ?>
		  <!-- start of request -->
				 <h3 class = "access">Request Login Access</h3>
				 <form method="post">
					<div class = "request-form">
					<div class="input-group request">
						<input type="text" name="first_name" value="" placeholder = "First Name" required>
					</div>
					 <div class="input-group request">
						<input type="text" name="last_name" value="" placeholder = "Last Name" required>
					</div>
					 <div class="input-group request">
						<input type="email" name="email" value="" placeholder = "Email" required>
					</div>
					 <div class="input-group request">
						<input type="email" name="email_confirm" value="" placeholder = "Confirm Email" required>
					</div>
					<div class="input-group request hearabout">
						<input type="text" name="hear_out" value="" placeholder = "How did you find out about this App?" required>
					</div>
					 <div class="input-group requesttextarea">
						<textarea name="message" rows="4" cols="50" placeholder = "Comment or Question"></textarea>
					</div>
					<input type="submit" name="submit_request" value="SUBMIT" class="button pwbutton">
				</div> 
				</form>
				<!-- end of request -->
	<?php			
		$html = ob_get_clean();
		return $html;
	}
