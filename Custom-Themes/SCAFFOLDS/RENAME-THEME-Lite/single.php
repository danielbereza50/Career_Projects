<?php 
  get_header(); 
?>


<?php  
the_title('<h2>', '</h2><br />');
the_post_thumbnail('medium');
$content = apply_filters('the_content', $post->post_content);
echo $content;
?>

<?php 
  get_footer(); 
?>
