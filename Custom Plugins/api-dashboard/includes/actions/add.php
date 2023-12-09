<?php
	  $author_id = get_current_user_id();	

      if (!empty($_POST['title'])) { 
            $title =  $_POST['title']; 
        } else { 
            echo 'Please enter a title'; 
        }       
        $post = array(
            'post_title'    => $title,
            'post_content'  => $description,
            'post_status'   => 'published', 
            'post_type'     => 'urls',
			'post_author'   => $author_id,
        );
        $post_id = wp_insert_post($post);

		/* send email message*/
		$to = get_option('admin_email');     
		//$to = 'danielbereza50@gmail.com';
		$subject = 'New URL submitted';

		$body .= "A new url post has been submitted to Quimonit." . "\n";
		$body .= "URL Title: " . $_POST['title'] . "\n";
		$body .= "Content: " . $_POST['description'] . "\n";
		$body .= "This new post is awaiting your approval." . "\n";
		$headers = array('Content-Type: text/html; charset=UTF-8');

		$sent = wp_mail( $to, $subject, $body, $headers );
		if($sent) {
			
		} else {  
			
		}