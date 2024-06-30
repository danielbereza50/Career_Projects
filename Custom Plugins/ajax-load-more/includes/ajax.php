<?php
// https://artisansweb.net/load-wordpress-post-ajax/
add_shortcode('my_ajax_load', 'blog_videos');
function blog_videos($atts)
{
    ob_start();
?>
<div class="entry-content">
    <?php
	extract(shortcode_atts(array(
            'class_name'    => 'cat-post',
            'totalposts'    => '-1',
            'category'      => '',
            'thumbnail'     => 'false',
            'excerpt'       => 'true',
            'orderby'       => 'post_date'
            ), $atts));

    global $post;
    $args = array(
        'posts_per_page' => '2', 
        'orderby' => $orderby,
        'post_type' => 'video',
        'tax_query' => array(
            array(
                'taxonomy' => 'video-category',
                'field' => 'slug',
				// terms is category
                'terms' => array( $category)
            )
        ));
    // print_r($args);
    $blog_posts = new WP_Query($args);
?>
    <?php if ($blog_posts->have_posts()): ?>
        <div class="blog-posts">
            <?php while ($blog_posts->have_posts()):
            $blog_posts->the_post(); ?>
			 <div class = "post-wrapper">
                <style>h2 a{display:none !important;}</style>
				 <?php
            if (get_field('video_network') == 'Vimeo')
            {
                the_field('video_embed');
            }
            else
            {
                the_field('youtube_embed');
            }
?>
			</div>
            <?php
        endwhile; ?>
        </div>
	<div class="loadmore" data-category="<?php echo $category ?>"><button>Load More...</button></div>
	<!-- data-category="' . esc_attr( $custom_category ) . '" -->
    <?php
    endif; ?>
</div>
<?php
    return ob_get_clean();
}
function blog_scripts()
{
    // Register the script
    wp_register_script('custom-script', '/wp-content/plugins/ajax-load-more/includes/js/core.js', array(
        'jquery'
    ) , false, true);
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php') ,
        'security' => wp_create_nonce('load_more_posts') ,
    );
    wp_localize_script('custom-script', 'blog', $script_data_array);

    // Enqueued script with localized data.
    wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts', 'blog_scripts');
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
function load_posts_by_ajax_callback()
{
    check_ajax_referer('load_more_posts', 'security');

    $paged = $_POST['page'] + 1;
	
	 $args = array(
	 'posts_per_page' => '1', 
	 'post_status' => 'publish',
     'post_type' => 'video',
	 'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'video-category',
                'field' => 'slug',
				// terms is category
                'terms' => $_POST['category'],
            )
        ));

    //print_r($args);
    $blog_posts = new WP_Query($args);
    ob_start();
?>
    <?php if ($blog_posts->have_posts()): ?>
        <?php while ($blog_posts->have_posts()):
            $blog_posts->the_post(); ?>
 <div class = "post-wrapper">
           <h2>
			   <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;">
			  <style>h2 a{display:none !important;}</style>
				   <?php
            if (get_field('video_network') == 'Vimeo')
            {
                the_field('video_embed');
            }
            else
            {
                the_field('youtube_embed');
            }
?>
			   </div>
				   </h2>
</div>
        <?php
        endwhile; ?>
        <?php
    endif;
    wp_die();
    return ob_get_clean();
}