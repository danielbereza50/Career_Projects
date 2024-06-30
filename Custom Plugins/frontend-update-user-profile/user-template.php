<?php
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */

get_header();

/* Get user info. */
global $current_user, $wp_roles;

/* Load the registration file. */
$error = array();    

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Redirect so the page will show updated info.*/
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink() );
        exit;
    }
}

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<style>
	
	h3{display:none !important;}
	.form-table{display:none !important;}
	
	#menu-item-browse{display:none !important;}
    .userfrm {max-width:700px;padding:20px;border:2px solid #7a451b; margin-bottom: 40px;}
	#wpua-remove-button-existing{padding: 2% 2% 2% 2%;}
	#wpua-add-button-existing{padding: 2% 2% 2% 2%;}
	#wpua-undo-existing{
    color: #FFFFFF !important;
    background-color: red;
    width: 120px;
    border: 1px solid #000;
    padding: 3px;
    border-radius: 3px;
    }
	#updateuser{
		color: #FFFFFF !important;
background-color: #7A451B;
font-size: 20px;
font-weight: 500;
padding: .3em 1em;
line-height: 1.7em !important;
cursor: pointer;
border: none;
	}
	#wpua-thumbnail-existing{
		display:none !important;
	}
	.form-submit {
    text-align: center !Important;
}
	.wpua-edit-container h3{
		display:none !important;
	}
	#user-image{  display: flex;
  justify-content: center;}
	.wpua-edit-container{  display: flex;
  justify-content: center;flex-wrap:wrap;}
	@media screen and (max-width:900px){
		#user-image{width: 100%;float: none;}
	.wpua-edit-container{width: 100%;float: none;}
	}
    div#user-image {
    color: transparent;
}
.userfrm label {
    color: #7A451B;
    display:block;
}
.userfrm textarea{
    min-height:160px;
}
div#user-image:before {
    content: "Profile Picture:";
    position: absolute;
    color: #7A451B;
}
#wpua-preview-existing img{margin:auto;}
#wpua-images-existing {order:1;width:100%;}
#wpua-add-button-existing {order:2;}
#wpua-remove-button-existing {order:3;}
#wpua-preview-existing img {
    border: 2px solid #C3772A;
    border-radius: 50%;
}
	@media screen and (max-width:900px){
		
	#edit{width:100% !important;}

	#edit-profile{width:100% !important;}
	
	}
	</style>

 <script>
	 // button id = "edit"
  jQuery( function() {
	   jQuery('#wpua-images-existing').draggable( {
			cursor: 'move',
			containment: '#post-video',
         } );
	  jQuery('.form-textarea label:contains("Biographical Information")').text("Bio Text:");
      jQuery('button:contains("Choose Image")').text("Change Image");
	  jQuery('button:contains("Change Image")').text("Add/ Edit Profile Picture");
	  jQuery('#wpua-preview-existing .description:contains("Original Size")').text("");
	  //jQuery('.description:contains("Original Size")').text("");
	  jQuery( "#wpua-remove-button-existing" ).insertBefore( jQuery( "#wpua-add-button-existing" ) );
	  
	  
	  jQuery("#post-video").hide();
	  
      jQuery("#edit").click(function() {
    	  jQuery("#post-video").show();
  	  });
  
  
  });
  </script>

<?php the_content(); ?>

<center id = "post-video">   
<div id="post-<?php the_ID(); ?>">
        <div class="entry-content entry">
            <?php if ( !is_user_logged_in() ) : ?>
			<style>
				.warning{display:none !important;}
			</style>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
			<div class = "userfrm" id = "contain">
				<script>
					function validate(form) {
						alert('Your changes have been saved');
						// var x = document.getElementsByClassName("userfrm");
                        // x.style.display = "none";	
					}
				</script>
                <form method="post" id="adduser" action="" onsubmit="return validate(this);">
                    <p class="form-textarea">
                        <label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                        <textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                    </p><!-- .form-textarea -->
                    	<div id = "user-image">Select Image:</div>
                    <?php 
                        //action hook for plugin and extra fields
                        do_action('edit_user_profile',$current_user); 
                    ?>
                    <p class="form-submit">
                        <?php echo $referer; ?>
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="Save" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                </form><!-- #adduser -->
			</div>
            <?php endif; ?>
        </div><!-- .entry-content -->
    </div><!-- .hentry .post -->
</center>
    <?php endwhile; ?>
<?php else: ?>
    <p class="no-data">
        <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
    </p><!-- .no-data -->
<?php endif; 



get_footer();

?>
