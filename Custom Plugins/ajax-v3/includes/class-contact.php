<?php

add_shortcode('contact_form', 'simple_form');
function simple_form(){
    ob_start(); ?>
    <!-- Google recaptcha API library -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php
        // Google reCAPTCHA API key configuration 
        $siteKey     = ''; 
        $secretKey     = ''; 
            /*
                    CREATE TABLE wpey_custom_form (
                    entry_id int NOT NULL AUTO_INCREMENT,
                    
                    FirstName varchar(255) NOT NULL,
                    LastName varchar(255) NOT NULL,
                    Email varchar(255),
                    Phone varchar(255),
                    Message varchar(255),
                    
                    PRIMARY KEY (entry_id)
                ); 
            */
            global $wpdb;
    
            $name = $_POST['full_name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

              // Validate reCAPTCHA box 
              if(isset($_POST['submit_request'])){
                //if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                    // Verify the reCAPTCHA response 
                    //$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
                    // Decode json data 
                  //  $responseData = json_decode($verifyResponse); 

                    // If reCAPTCHA response is valid 
                    //if($responseData->success){ 
                        $table_name = $wpdb->prefix . "custom_form";
                        $wpdb->insert($table_name, array(
                            'Name' => $name,
                            'Email' => $email,
                            'Message' => $message,
                        )); 
                        
                        $email_from = 'admin@domain.com';
                        $email_subject = "Hello";
                        $email_body = "You have received a new request for access:\n".
                                       "Name: $name.\n".
                                       "Email: $email.\n".
                                       "Message:\n $message.\n".

                        $to = "noreply@gmail.com";
                        $headers = "From: $email_from \r\n";
                        $headers .= "Reply-To: $email \r\n";
                        mail($to,$email_subject,$email_body,$headers);
               // }   
                    echo ' <style>.form-container{display:none;}</style>';
                    echo ' <div class="container" id = "custom_form">';
                        echo 'Your request has been sent. These requests are typically reviewed within 24 hours. Thank you!';
                    echo '</div>';
           // }else{
                    //echo '<div class = "recaptcha" id = "custom_form">Please check on the reCAPTCHA box.</div>'; 
            //}
        } ?>
        <div class = "form-container">
                 <form method="post" action = '#custom_form'>
                    <div class = "request-form">
                    <div class="input-group request">
                        <input type="text" name="full_name" value="" placeholder = "Please enter Name" required>
                    </div>
                     <div class="input-group request">
                        <input type="email" name="email" value="" placeholder = "Please enter Email" required>
                    </div>
                     <div class="input-group requesttextarea">
                        <textarea name="message" rows="4" cols="50" placeholder = "Comment or Question"></textarea>
                    </div>
                    <!--<div class="form-input">
                        <!-- Google reCAPTCHA box -->
                         <!--<div class="g-recaptcha" data-sitekey="<?php //echo $siteKey; ?>"></div>
                    </div>-->
                    <div class = "submit-button">   
                        <input type="submit" name="submit_request" value="SUBMIT" class="button pwbutton">
                    </div>  
                </div> 
                </form>
    </div>
    <?php           
        $html = ob_get_clean();
        return $html;
}
add_action('admin_menu', function(){
    add_menu_page( 
        'Form Entries',              //page_title, 
        'Form Entries',   //menu_title, 
        'manage_options',       // capability, 
        'form-entries',             // $menu_slug, 
        'view_form_entries',      //callable $function = '', 
        'dashicons-forms', // $icon_url = '', 
        5                      //int $position = null 
    );
});
function view_form_entries(){ 
    global $wpdb;
	
    echo '<table>';
    echo '</tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
    </tr>';
	
	$table_name = $wpdb->prefix . 'custom_form';
	$results = $wpdb->get_results( "SELECT * FROM $table_name" );
	
    foreach ( $results as $row ) {
        echo '<tr>';
        // Modify these to match the database structure
        echo '<td>' . $row->Name . '</td>';
        echo '<td>' . $row->Email . '</td>';
        echo '<td>' . $row->Message . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}



