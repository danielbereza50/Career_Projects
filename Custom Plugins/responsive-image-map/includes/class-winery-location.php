<?php 

// Class Name
class winery
{
    // Methods
    public function __construct()
    {
      $this->init();
    }
    public function init()
    {
        add_shortcode('winery_map', array($this, 'print_map')); 
		add_action('init', array($this, 'create_winery_location_cpt'));
		add_action('init', array($this, 'create_category_custom_taxonomy'));
    }
    public function print_map(){
        ob_start();
	
        require_once(__DIR__.'/../view/info.html.php');

        return ob_get_clean();
    }
	public function create_winery_location_cpt()
	{
		$labels = array(
			'name' => _x('Winery Location', 'post type general name') ,
			'singular_name' => _x('Winery Location', 'post type singular name') ,
			'add_new' => _x('Add New', 'Winery Location') ,
			'add_new_item' => __('Add New Winery Location') ,
			'edit_item' => __('Edit Winery Location') ,
			'new_item' => __('New Winery Location') ,
			'all_items' => __('All Winery Locations') ,
			'view_item' => __('View Winery Location') ,
			'search_items' => __('Search Winery Locations') ,
			'not_found' => __('No Winery Location found') ,
			'not_found_in_trash' => __('No Winery Location found in the Trash') ,
			'parent_item_colon' => '',
			'menu_name' => 'Winery Location'
		);
		$args = array(
			'labels' => $labels,
			'description' => 'Winery Location',
			'public' => true,
			'show_ui' => false,
			'capability_type' => 'post',
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-flag',
			'supports' => array(
				'title',
				'thumbnail',
				'comments',
				'editor',
				'page-attributes',
				'author',
			) ,
			'has_archive' => true,
			'publicly_queryable' => true,
		);
		register_post_type('winery-location', $args);
	}
	public function create_category_custom_taxonomy() {
	  $labels = array(
		'name' => _x( 'Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Category' ), 
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
		'menu_name' => __( 'Categories' ),
	  ); 	
	  register_taxonomy('categories',array('winery-location'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'categories' ),
	  ));
	}
}
$obj = new winery();




