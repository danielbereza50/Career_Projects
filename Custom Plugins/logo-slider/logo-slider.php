<?php
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Logos', 'Post Type General Name'),
        'singular_name'       => _x( 'Logo', 'Post Type Singular Name'),
        'menu_name'           => __( 'Logos'),
        'parent_item_colon'   => __( 'Parent Logo'),
        'all_items'           => __( 'All Logos'),
        'view_item'           => __( 'View Logo'),
        'add_new_item'        => __( 'Add New Logo'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Logo'),
        'update_item'         => __( 'Update Logo'),
        'search_items'        => __( 'Search Logo'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'logos'),
        'description'         => __( 'Logos'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'logos', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );
/*
* Add Image sizes
*/
if ( !function_exists('lhl_add_image_sizes') ){

  function lhl_add_image_sizes() {
        add_image_size(
            'logo_slider',  // name of image style                    
            200,             // width in px         
            59,             // height in px         
            false            // image crop 
                                    // false: image will be scaled
                                    // true : image will be cemter cropped to the specified dimensions
        );        

    }
}
add_action( 'after_setup_theme', 'lhl_add_image_sizes' );

function logo_slider(){
?>
  <style>
    .logoMarqueeSection{
      overflow: hidden;
    }
    
#logoMarqueeSection {
  max-width: 1920px!important;
  margin: 0 auto;
}

.default-content-container {
    margin-left: auto;
    margin-right: auto;
    margin-top: 0;
    margin-bottom: 0;
    padding-left: 5rem;
    padding-right: 5rem;
    padding-top: 4.5rem;
    padding-bottom: 4.5rem;
    width: 100%;
    min-height: 100vh;
}

div.marquee>a>img {
  height: 120px;
}

.logoMarqueeSection>div>div {
    padding-top: 0;
    padding-bottom: 0;
    min-height: 0;
}

.marquee-wrapper {
  display:  inline-block;
  white-space: nowrap;
}

.marquee {
    display:  inline-block;
    white-space: nowrap;
    position: relative;
    transform: translate3d(0%, 0, 0);
    animation-name: marquee;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

.marquee a {
    display:  inline-block;
    white-space: nowrap;
    padding-right: 1rem;
}

.marquee-wrapper:hover .marquee {
    animation-play-state: paused !important;
}

@keyframes marquee {
    0% {
        transform: translate3d(0%, 0, 0);
    }

    100% {
        transform: translate3d(-100%, 0, 0);
    }
}
    </style>
  
<?php
  ob_start();
  
  $args = array( 
    'post_type' => 'logos',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby' => 'title', 
      'order' => 'ASC',
  );

    $query = new WP_Query($args);
  
  global $post;
  
  ?>
<section class="logoMarqueeSection">
  <div class="container" id="logoMarqueeSection">
    <div class="default-content-container flex items-center">
      <div class="default-content-container-inner marquee-wrapper relative overflow-hidden inline-block">
        <div class="marquee" style="animation-duration: 40s;">
  <?php
    while($query->have_posts()) : $query->the_post();

  $url = get_post_meta($post->ID, 'website_url', true);
  
  ?>
  <a href="<?php echo $url; ?>" target = "_blank">
  <?php echo the_post_thumbnail('logo_slider');?>
    </a>
    <?php endwhile; ?>
        </div>
    </div>
      </div>
</div><!-- end of container -->
       </section>
    <?php

    wp_reset_postdata();

  $html = ob_get_clean(); 
  return $html;
}

add_shortcode('logos', 'logo_slider');



















