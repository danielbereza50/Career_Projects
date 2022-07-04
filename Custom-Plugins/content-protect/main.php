<?php
/*
    Plugin Name: Content Protect
    Plugin URI:  
    Description: Disbales copy / paste for specific paid-for content.  
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

class widget
{ 
    public function init()
    {
        // echo do_shortcode("[blog]");
        add_shortcode('blog', array(
            $this,
            'blog_page'
        ));
        add_action('widgets_init', array(
            $this,
            'pn_widgets_init'
        ));
        add_action('wp_footer', array(
            $this,
            'readyPosts'
        ));
        add_action('template_redirect', array(
            $this,
            'my_callback'
        ));
    }
 
    public function pn_widgets_init() {
     register_sidebar( array(
         'name' => __( 'Product Category Sidebar', 'Therapy Blog Library' ),
         'id' => 'sidebar-blog',
         'description' => __( 'The Blog Page Sidebar Area', 'Therapy Blog Library' ),
         'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
         'after_widget' => '</li>',
         'before_title' => '<h3 class="widget-title">',
         'after_title' => '</h3>',
     ));
    }

    public function readyPosts()
    {
        global $current_user; // Use global
        get_currentuserinfo(); // Make sure global is set, if not set it.

        // Check user object has not got subscriber role
        // (user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ) ) &&        
        global $post;

        if(!(user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ) ) && (in_category('ready-post')) ){
            ?>
            <script>
        // disable copy/paste
        jQuery(document).ready(function(){
            jQuery(document).bind("contextmenu", function(e){
                alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('copy', function(e) {
                alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('paste', function(e) {
                alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('cut', function(e) {
                alert("Please do not copy our content!");
                return false;
            }); 
        });
        </script>
        <?php
            }
    
        // the browse page
       if(!(user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ) )) {
      
              ?>
    <script>
        // disable copy/paste
        jQuery(document).ready(function(){
            jQuery(document).bind("contextmenu", function(e){
               return true;
            });
            jQuery(document).bind('copy', function(e) {
                return true;
            });
            jQuery(document).bind('paste', function(e) {
                return true;
            });
            jQuery(document).bind('cut', function(e) {
                return true;
            }); 
        });
        </script>

<?php
            } // end of if statement for login
  
    
         if((user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ) ) && !(in_category('ready-post'))) {
              ?>
    <script>
        // disable copy/paste
        jQuery(document).ready(function(){
            jQuery(document).bind("contextmenu", function(e){
               alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('copy', function(e) {
               alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('paste', function(e) {
                alert("Please do not copy our content!");
                return false;
            });
            jQuery(document).bind('cut', function(e) {
                alert("Please do not copy our content!");
                return false;
            }); 
        });
        </script>

<?php
            } // end of if statement for login
     }// end of function

   public function blog_page() { 
      get_header(); 
    ?>
    <style>
    @media screen and (max-width:900px){
     .postWrapper {
        /*max-width: 1280px;*/
        width:100% !important;
        float:left !important;
        min-height: 1150px;
        /*background-color: #ebebeb;*/
        /*overflow: hidden;*/
        }

    .sidebarWrapper{
        width:100% !important;
        float:left !important;
        }
    }
    .postWrapper {
        /*max-width: 1280px;*/
        width:70%;
        float:left;
        min-height: 1150px;
        /*background-color: #ebebeb;*/
        /*overflow: hidden;*/
    }

    .sidebarWrapper{
        width:30%;
        float:left;
        z-index: 999999999999999999;
        position: relative;
    }

    .page-nav-container {
        float: left;
        width: 100%;
        padding-bottom: 1%;
    }

    .next,
    .page-numbers {
        color: #20567c !important;
    }

    .feedWrapper img {
        width: 100%;
        height: 200px !important;
        margin-bottom: 10px;
        border: 2px solid #999 !important;
        border-radius: 10px !important;
    }


    .feedWrapper {
        width: 100%;
        float: left;
        max-width: 1140px;
        margin-right: auto;
        margin-left: auto;
        position: relative;
        margin: 2% 1% 2% 1%;
        text-align: left;
    }


   </style>
    <div class="postWrapper">
       <?php    
          $CurrentPage = get_query_var('paged');    
          $args = array(
              'category_name' => 'ready-post',
              'posts_per_page' => '10',
              'paged' => $CurrentPage
          );
          $arr_posts = new WP_Query( $args );
          if ( $arr_posts->have_posts() ) :
              while ( $arr_posts->have_posts() ) :
                  $arr_posts->the_post();
                  ?>
       <div class = "feedWrapper">
          <header class="entry-header" style="background: none;">
             <h1 class="entry-title" style="width: 50%;"><?php the_title(); ?></h1>
             <p><em><?php the_time('l, F jS, Y') ?></em></p>
          </header>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
             <div class="entry-content" style="margin: 15px 0px 40px 0px; padding: 0px 0px 30px 0px; border-bottom: 3px solid #ccc;width: 100%;">
                <?php 
                the_content(); 
                
                if (!(user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ))){ 
                ?>
                 <a style="color: #20567c !important;" href="<?php the_permalink(); ?>">Read the original article</a>
    <?php
                }

                if ((user_can( $current_user, "administrator" ) || user_can( $current_user, "subscriber" ))){ 
                ?>

                <a style="color: #20567c !important;" href="/oops-this-content-is-members-only/">Please sign-in</a>
    <?php
                }
             
    ?>
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


    <div class="sidebarWrapper">
    <?php
         dynamic_sidebar( 'sidebar-blog' );
    ?>
    </div>
        
        
<?php
get_footer();
   }

}// end of class
    
// 18 is the browse page - Exclude pages
// 105 is the category for 'ready posts' - Exclude posts
// Please do not copy our content!

// reading > posts page

$my_plugin = new widget('', '');
$my_plugin -> init();
