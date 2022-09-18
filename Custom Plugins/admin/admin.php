<?php

add_action('admin_menu', function(){
    add_menu_page( 
        'smsauth',              //page_title, 
        'SMS Authentication',   //menu_title, 
        'manage_options',       // capability, 
        'sms-auth',             // $menu_slug, 
        'manage_sms_keys',      //callable $function = '', 
        'dashicons-admin-network', // $icon_url = '', 
        10                      //int $position = null 
    );
});
function manage_sms_keys()
{ 
    $id     = get_option('twillio_account_id');
    $token  = get_option('twillio_account_token');
    $number = get_option('twillio_number');
    ?>
	<style>
		.input-group{ margin:20px 0px; }
		.lbl{ display: inline-block;    width: 100px; }
	</style>

    <h2>Twilio Credentials</h2>
    <form method="post">
        <div class="input-group">
            <label class="lbl">Account ID</label>
            <input type="text" name="twillio_account_id" value="<?php echo $id ;?>">
        </div>

        <div class="input-group">
            <label class="lbl">Account Token</label>
            <input type="text" name="twillio_account_token" value="<?php echo $token ;?>" >
        </div>

        <div class="input-group">
            <label class="lbl">Twilio Number</label>
            <input type="text" name="twillio_number" value="<?php echo $number ;?>">
        </div>
        <input type="submit" name="update_twillio_option" value="Save" class="button">
    </form>
<?php
	if(isset($_POST['update_twillio_option'])){
		update_option('twillio_account_id', $_POST['twillio_account_id']);
		update_option('twillio_account_token', $_POST['twillio_account_token']);
		update_option('twillio_number', $_POST['twillio_number']);

		echo '<h2>Keys Saved Successfully </h2>';
	}
}

add_action('admin_menu', function(){
    add_menu_page( 
        'logo',              //page_title, 
        'Affiliate Logo',   //menu_title, 
        'manage_options',       // capability, 
        'affiliate-image',             // $menu_slug, 
        'manage_affiliate_image',      //callable $function = '', 
        'dashicons-format-image', // $icon_url = '', 
        10                      //int $position = null 
    );
});
function manage_affiliate_image()
{ 
    $profilepicture     = get_option('profilepicture');
    ?>
    <style>
        .input-group{ margin:20px 0px; }
        .lbl{ display: inline-block;    width: 100px; }
    </style>

    <h2>Affiliate Logo</h2>
<form action="" method="post" enctype="multipart/form-data">
    Your Photo: <input type="file" name="profilepicture" size="25" />
    <input type="hidden" name="test" value="<?php echo $profilepicture ;?>">
    <input type="submit" name="submit" value="Submit" />
    </form>
<?php
    
    // WordPress environment
require( dirname(__FILE__) . '/../../../wp-load.php' );

$wordpress_upload_dir = wp_upload_dir();
// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
$i = 1; // number of tries when the file with the same name is already exists

$profilepicture = $_FILES['profilepicture'];
$new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );

if( empty( $profilepicture ) )
    die( 'File is not selected.' );

if( $profilepicture['error'] )
    die( $profilepicture['error'] );
    
if( $profilepicture['size'] > wp_max_upload_size() )
    die( 'It is too large than expected.' );
    
if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
    die( 'WordPress doesn\'t allow this type of uploads.' );
    
while( file_exists( $new_file_path ) ) {
    $i++;
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
}

// looks like everything is OK
if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
    

    $upload_id = wp_insert_attachment( array(
        'guid'           => $new_file_path, 
        'post_mime_type' => $new_file_mime,
        'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ), $new_file_path );

    // wp_generate_attachment_metadata() won't work if you do not include this file
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Generate and save the attachment metas into the database
    wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

    // Show the uploaded file in browser
    $test = $wordpress_upload_dir['url'] . '/' . basename( $new_file_path );
    //echo $test;
    //wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
     
    update_option('profilepicture', $test);
    echo 'Your logo has been updated!';
    
    }
