<?php 
/**
 * Template Name: Home 
 */ 
get_header();?>


<!--Start Coding Here -->



<?php  
// bring in the WYSSYWIG content
$content = apply_filters('the_content', $post->post_content);
echo $content;
?>



<?php 
   get_footer(); 
?>


