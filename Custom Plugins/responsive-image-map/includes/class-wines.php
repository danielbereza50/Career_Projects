<?php 

// Class Name
class wines
{
    // Methods
    public function __construct()
    {
      $this->init();
    }
    public function init()
    {
      add_action('init', array($this, 'create_wines_location_cpt'));
      add_action('init', array($this, 'be_register_taxonomies'));
      add_shortcode('display_wines_by_region', array($this, 'print_wines_by_region')); 
    }
  	public function print_wines_by_region($atts){
        ob_start();
	
        include(__DIR__.'/../view/print-wines.html.php');

        return ob_get_clean();
    }
	public function create_wines_location_cpt()
	{
		$labels = array(
			'name' => _x('Wines', 'post type general name') ,
			'singular_name' => _x('Wines', 'post type singular name') ,
			'add_new' => _x('Add New', 'Wines') ,
			'add_new_item' => __('Add New Wines') ,
			'edit_item' => __('Edit Wines') ,
			'new_item' => __('New Wines') ,
			'all_items' => __('All Wines') ,
			'view_item' => __('View Wine') ,
			'search_items' => __('Search Wines') ,
			'not_found' => __('No Wines Location found') ,
			'not_found_in_trash' => __('No Wines found in the Trash') ,
			'parent_item_colon' => '',
			'menu_name' => 'Wines'
		);
		$args = array(
			'labels' => $labels,
			'description' => 'Wines',
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-list-view',
			'supports' => array(
				'title',
				'thumbnail',
				'comments',
				'editor',
				'page-attributes',
				'author',
				'custom-fields', 
			) ,
			'has_archive' => true,
			'publicly_queryable' => true,
		);
		register_post_type('wines', $args);
	}
	public function be_register_taxonomies() {
		$taxonomies = array(
			array(
				'slug'         => 'wine-region',
				'single_name'  => 'Region',
				'plural_name'  => 'Regions',
				'post_type'    => 'wines',
				'rewrite'      => array( 'slug' => 'region' ),
			),
		);
		foreach( $taxonomies as $taxonomy ) {
			$labels = array(
				'name' => $taxonomy['plural_name'],
				'singular_name' => $taxonomy['single_name'],
				'search_items' =>  'Search ' . $taxonomy['plural_name'],
				'all_items' => 'All ' . $taxonomy['plural_name'],
				'parent_item' => 'Parent ' . $taxonomy['single_name'],
				'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
				'edit_item' => 'Edit ' . $taxonomy['single_name'],
				'update_item' => 'Update ' . $taxonomy['single_name'],
				'add_new_item' => 'Add New ' . $taxonomy['single_name'],
				'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
				'menu_name' => $taxonomy['plural_name']
			);
			
			$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
			$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
		
			register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
				'hierarchical' => $hierarchical,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => $rewrite,
			));
		}
	}
}
$obj_wines = new wines();




