<?php
function user_search(){
    ob_start();
    ?>
    
<form id = "ajax" class="ajax" enctype="multipart/form-data" action="" method="post">

    <input class="form-control" type="text" name="search_by1" id="search_by1"/>
    <input class="btn btn-primary" type="submit" name = "submit" value = "Search"><i class="fa fa-search"></i></input>

</form>

<div id="datafetch"></div>

 <script type="text/javascript">
 jQuery(document).ready(function($){

$( "#ajax" ).submit(function( event ) {

    event.preventDefault();

    var search_by1 = jQuery("#search_by1").val();
    
    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: {
          action: 'data_fetch2',
          search_by1: search_by1, 
        },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });
       console.log(search_by1);
      });
});
 </script>

<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('custom-search', 'user_search');


add_action('wp_ajax_data_fetch2' , 'data_fetch2');
add_action('wp_ajax_nopriv_data_fetch2','data_fetch2');

function data_fetch2() {

//if (!empty($_POST["searching"])) {
    
$search_term = $_POST['search_by1'];

// WP_User_Query arguments
$args_authors = array (
    'role__in' => array( 'Contributor', 'Administrator' ),
    'order' => 'ASC',
    'orderby' => 'display_name',
    //'search' => $search_term,
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'first_name',
            'value'   => $search_term,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'last_name',
            'value'   => $search_term,
            'compare' => 'LIKE'
        ),      
    )
);
 
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args_authors);
 
// Get the results
$authors = $wp_user_query->get_results();
 
// start of author results
if (!empty($authors)) {
    echo '<ul>';
    // loop through each author
    foreach ($authors as $author)
    {
                // get all the user's data
        $author_info = get_userdata($author->ID);
        
        
        echo '<div class="flex-container1">';
        
        
        $author_info = get_userdata($author->ID);
        
        $link = '<a href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '" title="' . esc_attr( sprintf(__("Author Bio for %s"), $author->display_name) ) . '">'; // Create the link to their author page
        echo $link;
        echo '</a>';
        
        echo '<h2><a href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '">'.$author_info->first_name.' '.$author_info->last_name . ' ' . get_user_meta($author->ID, 'title', true) .'</a></h2>';
        echo '<p>';
        echo '</div>';
    }
    echo '</ul>';
} else {
    //echo 'No authors found';
}
wp_reset_query(); 
// end of author results

$args_posts = array(  
        'post_type' => 'video',
        'post_status' => 'publish',
        //'posts_per_page' => 1, 
        's' => $search_term,
        //'s_meta_keys' => array('short_desc','tags'),
    'orderby' => 'date',
    'order'   => 'DESC',
    );

    $loop = new WP_Query( $args_posts ); 
        
    // start of video results 

    if($loop->have_posts()){   
        while ( $loop->have_posts() ) : $loop->the_post(); 
        echo '<div class="flex-container1">';
    ?>
    <a href = "<?php the_permalink(); ?>">
        <h2><?php  the_title(); ?></h2>
        </a>      
    <?php
    echo '</div>';
        endwhile;
    }
 // end of video results    
    
    wp_reset_postdata(); 
die();
//}
}




