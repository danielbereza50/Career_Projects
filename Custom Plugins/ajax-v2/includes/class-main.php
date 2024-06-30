<?php 
// Class Name
class professionals
{
    // Methods
    public function __construct()
    {
      $this->init();
    } 
    public function init()
    {
        add_action('init', array($this, 'create_professional_cpt'));
        add_action('init', array($this, 'be_register_taxonomies'));
    }
    public function create_professional_cpt()
    {
        $labels = array(
            'name' => _x('Professional', 'post type general name') ,
            'singular_name' => _x('Professional', 'post type singular name') ,
            'add_new' => _x('Add New', 'Professional') ,
            'add_new_item' => __('Add New Professional') ,
            'edit_item' => __('Edit Professional') ,
            'new_item' => __('New Professional') ,
            'all_items' => __('All Professionals') ,
            'view_item' => __('View Professional') ,
            'search_items' => __('Search Professionals') ,
            'not_found' => __('No Professionals found') ,
            'not_found_in_trash' => __('No Professionals found in the Trash') ,
            'parent_item_colon' => '',
            'menu_name' => 'Professionals'
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Professionals',
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
            'publicly_queryable' => true,
        );
        register_post_type('professionals', $args);
    }
    public function be_register_taxonomies() {
		$taxonomies = array(
			array(
				'slug'         => 'expertise',
				'single_name'  => 'Expertise',
				'plural_name'  => 'Expertises',
				'post_type'    => 'professionals',
				'rewrite'      => array( 'slug' => 'expertise' ),
			),
			array(
				'slug'         => 'state',
				'single_name'  => 'State',
				'plural_name'  => 'States',
				'post_type'    => 'professionals',
				'rewrite'      => array( 'slug' => 'state' ),
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
				'show_admin_column' => true,
				'hierarchical' => $hierarchical,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => $rewrite,
			));
		}
	}
}
$obj = new professionals();