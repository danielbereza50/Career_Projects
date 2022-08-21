<?php 
   /**
    * Template Name: Reviews
    */ 
   get_header();
   ?>
<script>
   jQuery(document).ready(function(){	
   	var formstatus;
   	
   	jQuery( "label[for='user-submitted-name']" ).html('Name' ); 
   	jQuery( "label[for='user-submitted-email']" ).html('Email' ); 
   	jQuery( "label[for='user-submitted-content']" ).html('Message' ); 
   	jQuery( "#user-submitted-post" ).val('Submit Review' ); 
   	
   	   jQuery( "#createreview" ).click(function() {
   		    if (formstatus == 'open'){
   				jQuery( "#submit_review_form" ).css("display","none");
   		        formstatus = 'closed';
   				
   			}else{
   		    
   	        jQuery( "#submit_review_form" ).css("display","block");
   		    formstatus = 'open';
   				}
   	   });
   	
   	jQuery("#user-submitted-post").hover(function(){
   		var starrating = jQuery( '#user-submitted-custom' ).val();
    		if((starrating != '1') || (starrating != '2') || (starrating != '3') || (starrating != '4') || (starrating != '5') ){
   		   //jQuery( '#user-submitted-custom' ).val('');
   		   }
   		
       }); 	
   	
   });	
</script>
<div class="dropdown">
   <a href = "#"><button class="dropbtn">HOME</button></a>
</div>
<div class="dropdown">
   <a href = "/index.php/about-us/"><button class="dropbtn">ABOUT</button></a>
</div>
<div class="dropdown">
   <a href = "/index.php/services/"><button class="dropbtn1">SERVICES</button></a>
   <div class="dropdown-content">
      <a href="/index.php/roofings/">ROOFING</a>
      <a href="/index.php/sidings/">SIDING</a>
      <a href="/index.php/gutter/">GUTTERS</a>
      <a href="/index.php/decks/">DECKS</a>
      <a href="/index.php/basements/">BASEMENT</a>
      <a href="/index.php/doors-windows/">WINDOWS & DOORS</a>
      <a href="/index.php/bathrooms/">BATHROOM</a>
      <a href="/index.php/kitchens/">KITCHEN</a>
   </div>
</div>
<div class="dropdown">
   <a href = "/index.php/portfolio/"><button class="dropbtn">PORTFOLIO</button></a>
</div>
<div class="dropdown">
   <a href = "/index.php/reviews/"><button class="dropbtn">REVIEWS</button></a>
</div>
<div class="dropdown">
   <a href = "/index.php/contact/"><button class="dropbtn">CONTACT</button></a>
</div>
<div>
   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   <?php the_content(); ?>
   <?php endwhile; endif; ?>
</div>
<div class = "reviewHolder">
   <a id="createreview" href="#"><button class = "btn1" type="button">Create your own Review</button></a>
</div>
<?php  
   $CurrentPage = get_query_var('paged');  
     
   $args = array(
       'category_name' => 'Reviews',
       'posts_per_page' => '3',
     'paged' => $CurrentPage
   );
   $arr_posts = new WP_Query( $args );
    
   if ( $arr_posts->have_posts() ) :
    
       while ( $arr_posts->have_posts() ) :
           $arr_posts->the_post();
           ?>
<div class = "reviewsWrapper">
<li>
   <ul>
<li class = "postContent" id = "show"><?php 
   echo preg_replace('/<img[^>]+./','',get_the_content());
   
   ?></li>
<li class = "postImg"><img class = "thePostImg" src="<?php echo get_post_meta($post->ID, 'user_submit_image', true); ?>" /></li>
<li class = "postContent" id = "hide"><?php 
   echo preg_replace('/<img[^>]+./','',get_the_content());
   
   ?></li>
<div class = "clear"></div>
<li class = "postName">- <?php echo get_post_meta($post->ID, 'user_submit_name', true); ?></li>
<!-- Store the ACF field data in variable -->
<li class = "postField">
   <?php $starrating = get_post_meta($post->ID, 'usp_custom_field', true); 
      // print out as stars here
               for ($x = 1; $x <= $starrating; $x++) {
                       echo '<div class = "starz">&bigstar;</div>';
               }
               
	
      
               ?>
	</ul>
   <div class = "clear"></div>
</li>
<?php
   endwhile;
   endif;
   
   // Bottom pagination (pagination arguments)
   
   echo "<div class='page-nav-container1'>" . paginate_links(array(
   'total' => $arr_posts->max_num_pages,
   'prev_text' => __('<'),
   'next_text' => __('>')
   )) . "</div>";
	
   ?>
</div>   
	   
<?php 
   get_footer(); 
   ?>

