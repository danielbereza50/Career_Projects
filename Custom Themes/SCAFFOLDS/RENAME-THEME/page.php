
<?php 
get_header(); 
?>

<!-- Start of sub page template -->

 <!-- Simple PHP interface 


      <?php 
        wp_nav_menu(array( 'theme_location' => 'main-menu',
         
        )); 
      ?>

-->

<!--

<hr style="
    border-top: 1px solid #f5f2f2;
    margin-left: 15px;
    margin-right: 15px;
	  margin-bottom: 0px;
    color: #f5f2f2;
">

-->

<?php  
// bring in the WYSSYWIG content
$content = apply_filters('the_content', $post->post_content);
echo $content;
?>


<!-- End of section -->


<!-- Tail goes here -->

<!--
<hr style="
    border-top: 1px solid #f5f2f2;
    margin-left: 15px;
    margin-right: 15px;
	  margin-bottom: 0px;
    color: #f5f2f2;
">
-->

<?php get_footer(); ?>
