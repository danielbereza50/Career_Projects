<?php
   /**
    * Template Name: Blog 
    */ 
   get_header(); 
   ?>
<?php
   echo do_shortcode('[smartslider3 slider=13]'); 
   ?>	
<div class="postWrapper">
   <?php	
      $CurrentPage = get_query_var('paged');	
      	
      $args = array(
          //'category_name' => 'Test',
          'posts_per_page' => '6',
      	  'paged' => $CurrentPage
      );
      $arr_posts = new WP_Query( $args );
       
      if ( $arr_posts->have_posts() ) :
       
          while ( $arr_posts->have_posts() ) :
              $arr_posts->the_post();
              ?>
   <div class = "feedWrapper">
      <header class="entry-header">
         <h1 class="entry-title"><?php the_title(); ?></h1>
         <p><em><?php the_time('l, F jS, Y') ?></em></p>
      </header>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <?php
            $postid = $post->ID;
            
            $thumburl = get_the_post_thumbnail_url($postid, 'full');
                     
            ?>
         <a href="<?php the_permalink(); ?>">
            <div style="background-image: url(<?php echo $thumburl;?>); width: 100%; height: 400px; background-position: center; background-size: cover;background-repeat: no-repeat; border: 1px solid #ccc; 	width: 100%;
               height: 200px !important;
               margin-bottom: 10px;
               border: 2px solid #999 !important;
               border-radius: 10px !important; ">
            </div>
         </a>
         <div class="entry-content" style="margin: 15px 0px 40px 0px; padding: 0px 0px 30px 0px; border-bottom: 3px solid #ccc">
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>">Read More</a>
         </div>
      </article>
   </div>
   <?php
      endwhile;
      endif;
      
      // Bottom pagination (pagination arguments)
      
      echo "<div class='page-nav-container'>" . paginate_links(array(
      'total' => $arr_posts->max_num_pages,
      'prev_text' => __('<'),
      'next_text' => __('>')
      )) . "</div>";
      ?>
</div>


<?php  
// bring in the WYSSYWIG content
$content = apply_filters('the_content', $post->post_content);
echo $content;
?>
<?php get_footer(); ?>

