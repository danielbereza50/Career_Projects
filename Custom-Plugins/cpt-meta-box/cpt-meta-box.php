<?php
/*
    Plugin Name: GCH - Custom code
    Plugin URI:  https://212creative.com/
    Description: Added website functionality. 
    Version:     100.0.0
    Author:      212creative
    Author URI:  https://212creative.com/
    License:     GPL2
    License URI: Licence URl
*/

// https://developer.wordpress.org/resource/dashicons/

function create_staff_cpt()
{
    $labels = array(
        'name' => _x('Staff', 'post type general name') ,
        'singular_name' => _x('Staff', 'post type singular name') ,
        'add_new' => _x('Add New', 'Staff') ,
        'add_new_item' => __('Add New Staff') ,
        'edit_item' => __('Edit Staff') ,
        'new_item' => __('New Staff') ,
        'all_items' => __('All Staff') ,
        'view_item' => __('View Staff') ,
        'search_items' => __('Search Staff') ,
        'not_found' => __('No Staff found') ,
        'not_found_in_trash' => __('No Staff found in the Trash') ,
        'parent_item_colon' => '',
        'menu_name' => 'Staff'
    );

    $args = array(
        'taxonomies'   => array( 'staff',  'post_tag' ),
        'labels' => $labels,
        'description' => 'Staff',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'menu_position' => 5,
		'menu_icon'           => 'dashicons-businessperson',
        'supports' => array(
            'title',
            'thumbnail',
            'comments',
            'editor',
            'page-attributes',
            'author',
        ) ,
        'has_archive' => true,
    );
    register_post_type('staff', $args);
}
add_action('init', 'create_staff_cpt');
add_action( 'init', 'create_departments_custom_taxonomy', 0 );
 
function create_departments_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Departments', 'taxonomy general name' ),
    'singular_name' => _x( 'Department', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Departments' ),
    'all_items' => __( 'All Departments' ),
    'parent_item' => __( 'Parent Department' ),
    'parent_item_colon' => __( 'Parent Department:' ),
    'edit_item' => __( 'Edit Department' ), 
    'update_item' => __( 'Update Department' ),
    'add_new_item' => __( 'Add New Department' ),
    'new_item_name' => __( 'New Department Name' ),
    'menu_name' => __( 'Departments' ),
  ); 	
 
  register_taxonomy('departments',array('staff'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'department' ),
  ));
}

add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type() {
    remove_post_type_support( 'staff', 'editor' );
}

/**
 * Register meta boxes.
 */
function hcf_register_meta_boxes() {
    add_meta_box( 
		'dep-1', __( 'Department Information', 'dep' ), 'show_your_fields_meta_box', 'staff' 
	);
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function show_your_fields_meta_box( $post ) {
    global $post;  
    $meta = get_post_meta( $post->ID, 'your_fields', true ); ?>


<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
<p>
    	<label for="your_fields[name]">Name</label>
    	<br>
    	<input type="text" name="your_fields[name]" id="your_fields[name]" class="regular-text" value="<?php echo $meta['name']; ?>" required>
    </p>

<p>
<label for="your_fields[postion]">Postion</label>
    	<br>
    	<input type="text" name="your_fields[postion]" id="your_fields[postion]" class="regular-text" value="<?php echo $meta['postion']; ?>" required>
    </p>

<p>
<label for="your_fields[email]">Email</label>
    	<br>
    	<input type="text" name="your_fields[email]" id="your_fields[email]" class="regular-text" value="<?php echo $meta['email']; ?>">
    </p>

<p>
    	<label for="your_fields[bio]">Bio</label>
    	<br>
    	<textarea name="your_fields[bio]" id="your_fields[bio]" rows="5" cols="30" style="width:500px;" required><?php echo $meta['bio']; ?></textarea>
    </p>

<?php 
}

function save_your_fields_meta( $post_id ) {   
// verify nonce
if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
    return $post_id; 
}
// check autosave
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
}
// check permissions
if ( 'page' === $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }  
}

$old = get_post_meta( $post_id, 'your_fields', true );
$new = $_POST['your_fields'];

if ( $new && $new !== $old ) {
    update_post_meta( $post_id, 'your_fields', $new );
} elseif ( '' === $new && $old ) {
    delete_post_meta( $post_id, 'your_fields', $old );
}
}
add_action( 'save_post', 'save_your_fields_meta' );

// [staff_member department="Admin"]
function departments_categories ($atts) {

	extract( shortcode_atts( array(
        'department' => '',
    ), $atts ) );

    $args = array(
	'post_type' => 'staff',
	'posts_per_page' => -1,
	'orderby' => 'date',
     'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'departments',
          'field' => 'slug',
          'terms' => $department,
        ),
      ),
     );
	
     $loop = new WP_Query($args);
	//print_r($loop);
	
	ob_start();  
	
     if($loop->have_posts()) {
		 
?>
<div class="staff_container">
<?php while($loop->have_posts()) : $loop->the_post(); 
	$post_id = get_the_ID();	 
	$meta = get_post_meta( $post_id, 'your_fields', true ); 
	?>
	<div class="staff_member">
		<div class="staff_headshot"> 
       <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
		</div>
		<div class="staff_name"> 
		<?php
          echo $meta['name'];
			?> 
			<?php
         if(!empty($meta['email'])){ ?>
            <a href="mailto:<?php echo $meta['email']; ?>">
            <span class='et-pb-icon'>&#xe010;</span>
            </a><?php 
            }else{  
             //
            }
            ?>
		</div>
		<div class="staff_position"> 
		<?php
		  echo $meta['postion'];
		 ?>
		</div>
		<div class="staff_show_bio">Show Bio</div>
		<div class = "bio-display">
        <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
        <?php echo $meta['bio'];  ?>
     <div class="staff_hide_bio" >Hide Bio</div>
        </div>
        <!--<div class="staff_bio"> 
      </div>-->
	</div>
	<?php endwhile; ?>	 
	<!-- loop the staff member container --> 
</div>
			<?php
     }
	
	if(!$loop->have_posts()) {
		echo 'No staff were found';
	}
	
	$html = ob_get_clean();
	return $html;
}
add_shortcode( 'staff_member','departments_categories' );
?>

<script>

    // A $( document ).ready() block.
jQuery( document ).ready(function($) {
    
    console.log( "ready!" );
    
    jQuery('.staff_show_bio').click(function(){
        var $depCov = jQuery(this).next('.bio-display');
        
        $depCov.addClass( "visible" );
        
    });

    jQuery('.staff_hide_bio').click(function(){
    
        jQuery( ".bio-display" ).removeClass( "visible" );
    });

});
    


</script>



<style>


.staff_show_bio {
  background: #E02B20;
  color: #fff;
  width: 100px;
  margin: 0 auto;
  margin-top: 10px;
  border-radius: 20px;
    cursor:pointer;
}
.staff_hide_bio {
  position: absolute;
  bottom: 3px;
  width: 100px;
  left: calc(50% - 50px);
  background: #E02B20;
  border-radius: 20px;
    cursor:pointer;
}

.bio-display{
    position:absolute;
    bottom:0;
    top:0;
    left:0;
    right:0;
    background:#456181!important;
    color:#fff;
    padding:0%;
    max-height:0px;
    max-width:0px;
    overflow:hidden;
    transition:all 300ms ease-in-out;
    font-size:0px}
.bio-display.visible{
    padding:2%;
    max-height:100%;max-width:100%;
    overflow-y:auto;
    font-size:13px
}

</style>


