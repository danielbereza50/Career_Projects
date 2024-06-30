<?php


class ChemicalsCustomPostType {

	
    public function __construct() {
        // Hook into the 'init' action to register the custom post type and taxonomy
        add_action('init', array($this, 'register_custom_post_type_and_taxonomy'));

        // Hook into the 'add_meta_boxes' action to add custom fields meta box
        add_action('add_meta_boxes', array($this, 'add_custom_fields_meta_box'));

        // Hook into the 'save_post' action to save custom fields
        add_action('save_post', array($this, 'save_custom_fields'));
    }

    public function register_custom_post_type_and_taxonomy() {
        // Custom post type
        $this->register_custom_post_type();

        // Custom taxonomy
        $this->register_custom_taxonomy();
    }

    private function register_custom_post_type() {
        // Custom post type labels
           $labels = array(
        'name'                  => _x( 'Chemicals', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Chemical', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Chemicals', 'text_domain' ),
        'name_admin_bar'        => __( 'Chemical', 'text_domain' ),
        'archives'              => __( 'Chemical Archives', 'text_domain' ),
        'attributes'            => __( 'Chemical Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Chemical:', 'text_domain' ),
        'all_items'             => __( 'All Chemicals', 'text_domain' ),
        'add_new_item'          => __( 'Add New Chemical', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Chemical', 'text_domain' ),
        'edit_item'             => __( 'Edit Chemical', 'text_domain' ),
        'update_item'           => __( 'Update Chemical', 'text_domain' ),
        'view_item'             => __( 'View Chemical', 'text_domain' ),
        'view_items'            => __( 'View Chemicals', 'text_domain' ),
        'search_items'          => __( 'Search Chemical', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Chemical', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Chemical', 'text_domain' ),
        'items_list'            => __( 'Chemicals list', 'text_domain' ),
        'items_list_navigation' => __( 'Chemicals list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Chemicals list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Chemical', 'text_domain' ),
        'description'           => __( 'Chemical Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon' => 'dashicons-filter',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

        // Register the custom post type
        register_post_type('chemicals', $args);
    }

    private function register_custom_taxonomy() {
        // Custom taxonomy labels
       $labels = array(
        'name'                       => _x( 'Chemical Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Chemical Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Chemical Category', 'text_domain' ),
        'all_items'                  => __( 'All Categories', 'text_domain' ),
        'parent_item'                => __( 'Parent Category', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
        'new_item_name'              => __( 'New Category Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Category', 'text_domain' ),
        'edit_item'                  => __( 'Edit Category', 'text_domain' ),
        'update_item'                => __( 'Update Category', 'text_domain' ),
        'view_item'                  => __( 'View Category', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Categories', 'text_domain' ),
        'search_items'               => __( 'Search Categories', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No categories', 'text_domain' ),
        'items_list'                 => __( 'Categories list', 'text_domain' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );

        // Register the custom taxonomy
        register_taxonomy('chemical_category', array('chemicals'), $args);
    }

    public function add_custom_fields_meta_box() {
        // Add meta box for custom fields
        add_meta_box(
            'chemicals_custom_fields',
            'Chemicals Custom Fields',
            array($this, 'render_custom_fields_meta_box'),
            'chemicals', // Post type
            'normal',
            'default'
        );
    }

    public function render_custom_fields_meta_box($post) {
        // Output custom fields
        $this->render_custom_fields($post);
    }

    public function save_custom_fields($post_id) {
        // Save custom fields
        $this->save_custom_fields_data($post_id);
    }

    private function render_custom_fields($post) {
         // Get existing values
    $lel_value = get_post_meta($post->ID, '_lel_value', true);
    $uel_value = get_post_meta($post->ID, '_uel_value', true);
    $idlh_value = get_post_meta($post->ID, '_idlh_value', true);
    $cf_value = get_post_meta($post->ID, '_cf_value', true);
    $flash_point_value = get_post_meta($post->ID, '_flash_point_value', true);
    $vapor_density_value = get_post_meta($post->ID, '_vapor_density_value', true);

    // Output fields
    ?>

	<div class="custom-field">
		<label for="lel_value">LEL: (percentage)</label>
		<input type="text" id="lel_value" name="lel_value" value="<?php echo esc_attr($lel_value); ?>">
	</div>

	<div class="custom-field">
		<label for="uel_value">UEL: (percentage)</label>
		<input type="text" id="uel_value" name="uel_value" value="<?php echo esc_attr($uel_value); ?>">
	</div>

	<div class="custom-field">
		<label for="idlh_value">IDLH: (PPM)</label>
		<input type="text" id="idlh_value" name="idlh_value" value="<?php echo esc_attr($idlh_value); ?>">
	</div>

	<div class="custom-field">
		<label for="cf_value">CF:</label>
		<input type="text" id="cf_value" name="cf_value" value="<?php echo esc_attr($cf_value); ?>">
	</div>

	<div class="custom-field">
		<label for="flash_point_value">Flash Point: (F)</label>
		<input type="text" id="flash_point_value" name="flash_point_value" value="<?php echo esc_attr($flash_point_value); ?>">
	</div>

	<div class="custom-field">
		<label for="vapor_density_value">Vapor Density:</label>
		<input type="text" id="vapor_density_value" name="vapor_density_value" value="<?php echo esc_attr($vapor_density_value); ?>">
	</div>
<?php
    }

    private function save_custom_fields_data($post_id) {
         // Save LEL value
		if (isset($_POST['lel_value'])) {
			update_post_meta($post_id, '_lel_value', sanitize_text_field($_POST['lel_value']));
		}

		// Save UEL value
		if (isset($_POST['uel_value'])) {
			update_post_meta($post_id, '_uel_value', sanitize_text_field($_POST['uel_value']));
		}

		// Save IDLH value
		if (isset($_POST['idlh_value'])) {
			update_post_meta($post_id, '_idlh_value', sanitize_text_field($_POST['idlh_value']));
		}

		// Save CF value
		if (isset($_POST['cf_value'])) {
			update_post_meta($post_id, '_cf_value', sanitize_text_field($_POST['cf_value']));
		}

		// Save Flash Point value
		if (isset($_POST['flash_point_value'])) {
			update_post_meta($post_id, '_flash_point_value', sanitize_text_field($_POST['flash_point_value']));
		}

		// Save Vapor Density value
		if (isset($_POST['vapor_density_value'])) {
			update_post_meta($post_id, '_vapor_density_value', sanitize_text_field($_POST['vapor_density_value']));
		}
    }
}

// Initialize the class
new ChemicalsCustomPostType();
