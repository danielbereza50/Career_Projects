<?php

add_action( 'wp_head', 'scripts' );
function scripts() { ?>
<style>
.slide-container{
  max-width: 1120px;
  width: 100%;
  padding: 40px 0;
}
.slide-content{
  margin: 0 40px;
  overflow: hidden;
  border-radius: 25px;
}
.card{
  border-radius: 25px;
  background-color: #FFF;
}
.image-content,
.card-content{
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 10px 14px;
}
.image-content{
  position: relative;
  row-gap: 5px;
  padding: 25px 0;
}
.overlay{
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  background-color: #4070F4;
  border-radius: 25px 25px 0 25px;
}
.overlay::before,
.overlay::after{
  content: '';
  position: absolute;
  right: 0;
  bottom: -40px;
  height: 40px;
  width: 40px;
  background-color: #4070F4;
}
.overlay::after{
  border-radius: 0 25px 0 0;
  background-color: #FFF;
}
.card-image{
  position: relative;
  height: 150px;
  width: 150px;
  border-radius: 50%;
  background: #FFF;
  padding: 3px;
}
.card-image .card-img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #4070F4;
}
.name{
  font-size: 18px;
  font-weight: 500;
  color: #333;
}
.description{
  font-size: 14px;
  color: #707070;
  text-align: center;
}
.button{
  border: none;
  font-size: 16px;
  color: #FFF;
  padding: 8px 16px;
  background-color: #4070F4;
  border-radius: 6px;
  margin: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
}
.button:hover{
  background: #265DF2;
}

.swiper-navBtn{
  color: #6E93f7;
  transition: color 0.3s ease;
}
.swiper-navBtn:hover{
  color: #4070F4;
}
.swiper-navBtn::before,
.swiper-navBtn::after{
  font-size: 38px;
}
.swiper-button-next{
  right: 0;
}
.swiper-button-prev{
  left: 0;
}
.swiper-pagination-bullet{
  background-color: #6E93f7;
  opacity: 1;
}
.swiper-pagination-bullet-active{
  background-color: #4070F4;
}

@media screen and (max-width: 768px) {
  .slide-content{
    margin: 0 10px;
  }
  .swiper-navBtn{
    display: block;
  }
}
</style>
 <script>
	 jQuery( document ).ready(function($) {
		 	
	var swiper = new Swiper(".slide-content", {
		slidesPerView: 3,
		spaceBetween: 25,
		loop: true,
		centerSlide: 'true',
		fade: 'true',
		grabCursor: 'true',
		pagination: {
		  el: ".swiper-pagination",
		  clickable: true,
		  dynamicBullets: true,
		},
		navigation: {
		  nextEl: ".swiper-button-next",
		  prevEl: ".swiper-button-prev",
		},

		breakpoints:{
			0: {
				slidesPerView: 1,
			},
			520: {
				slidesPerView: 2,
			},
			950: {
				slidesPerView: 3,
			},
		},
	  });
		 
		 

});
	</script>
	
	<?php
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  
   wp_enqueue_script( 'Swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), '3.6.0', true );
   wp_enqueue_style( 'Swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), '1.0' );
  
}
add_shortcode( 'show-featured', 'featured' );
function featured() {
	ob_start();
    global $post;

	$args = array(
      'post_type'  => 'video',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => -1,
	);
  
	//print_r($args);
    $post_query = new WP_Query( $args );  
?>                       
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
					<?php
						while($post_query->have_posts()) : $post_query->the_post(); 
						  $post_image = get_the_post_thumbnail_url();
	
	
					?>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
								<?php echo '<img src="'.$post_image.'" class="card-img"/>'; ?>
                            </div>
                        </div>
                        <div class="card-content"><!-- plugin custom fields here -->
                            <h2 class="name"><?php echo  the_title(); ?></h2>
                            <p class="description">The lorem text the section that contains header with having open functionality.</p>
                            <button class="button">View More</button>
                        </div>
                    </div><!-- end of car swiper -->
					<?php endwhile; ?>	
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
   <?php 		 
		return ob_get_clean();
}
add_action('init', 'create_video_post_type');
function create_video_post_type() {
    $labels = array(
        'name' => __('Videos'),
        'singular_name' => __('Video'),
        'menu_name' => __('Videos'),
        'all_items' => __('All Videos'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Video'),
        'edit_item' => __('Edit Video'),
        'new_item' => __('New Video'),
        'view_item' => __('View Video'),
        'search_items' => __('Search Videos'),
        'not_found' => __('No videos found'),
        'not_found_in_trash' => __('No videos found in trash')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'video'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-video-alt3'
    );
    register_post_type('video', $args);
}



