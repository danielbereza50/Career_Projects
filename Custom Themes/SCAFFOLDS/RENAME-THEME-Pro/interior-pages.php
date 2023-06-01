<?php 
/**
 * Template Name: Interior Pages 
 */ 
get_header();






$content = apply_filters('the_content', $post->post_content);
echo $content;
 

get_footer(); ?>