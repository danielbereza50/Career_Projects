<?php



add_action('save_post', 'sync_featured_image_and_create_identical_post', 30, 3);
function sync_featured_image_and_create_identical_post($post_id, $post, $update) {
    // Check if it's an auto-save routine
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check if the post is being restored
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    // Prevent infinite loop
    remove_action('save_post', 'sync_featured_image_and_create_identical_post', 30, 3);

    // Check if the post is one of our custom post types
    if ($post->post_type == 'sfwd-courses' || $post->post_type == 'sfwd-stations') {
        // Get the new featured image ID
        $new_thumbnail_id = get_post_thumbnail_id($post_id);

        // Get the value of the _small_featured field
        $new_small_featured = get_post_meta($post_id, '_small_featured', true);

        // Get the post title and sanitize it
        $post_title = wp_kses_post($post->post_title);

        // Determine the other post type
        $other_post_type = ($post->post_type == 'sfwd-courses') ? 'sfwd-stations' : 'sfwd-courses';

        // Use WP_Query to find the post in the other post type with the same title
        $args = array(
            'post_type' => $other_post_type,
            'title'     => $post_title,
            'post_status' => 'any',
        );

        $query = new WP_Query($args);
        $other_post = null;

        if ($query->have_posts()) {
            $other_post = $query->posts[0];
        }

        if ($other_post) {
            // Get the current featured image ID of the other post
            $current_thumbnail_id = get_post_thumbnail_id($other_post->ID);

            // Check if the featured image has changed
            if ($new_thumbnail_id != $current_thumbnail_id) {
                // Update the featured image of the other post
                set_post_thumbnail($other_post->ID, $new_thumbnail_id);
            }

            // Get the current value of the _small_featured field in the other post
            $current_small_featured = get_post_meta($other_post->ID, '_small_featured', true);

            // Check if the _small_featured field has changed
            if ($new_small_featured !== $current_small_featured) {
                // Update the _small_featured field in the other post
                update_post_meta($other_post->ID, '_small_featured', $new_small_featured);
            }
        } else {
            // If no matching post is found, create the identical post in the other post type
            $new_post_id = wp_insert_post(array(
                'post_title'   => $post->post_title,
                'post_content' => $post->post_content,
                'post_status'  => $post->post_status,
                'post_type'    => $other_post_type,
            ));

            // If the original post has a featured image, set it for the new post as well
            if ($new_thumbnail_id) {
                set_post_thumbnail($new_post_id, $new_thumbnail_id);
            }

            // Set the _small_featured field for the new post
            update_post_meta($new_post_id, '_small_featured', $new_small_featured);

			// Assign the term to the post
			$result = wp_set_object_terms(26019, 'Coming Soon', 'ld_course_tag', true);
			//$is_success = wp_set_post_terms($new_post_id, 'Coming Soon', 'ld_course_tag');

			
			
			
        }
    }

    // Re-hook the action
   add_action('save_post', 'sync_featured_image_and_create_identical_post', 30, 3);

}



// Function to sync terms between posts with the same title.
function sync_terms_by_title($post_id, $post_type_taxonomy_map) {
    $current_post_type = get_post_type($post_id);
    //echo 'Current post type: ' . $current_post_type . '<br>';

    $current_taxonomies = isset($post_type_taxonomy_map[$current_post_type]) ? $post_type_taxonomy_map[$current_post_type] : array();
    //echo 'Current taxonomies: ' . implode(', ', $current_taxonomies) . '<br>';

    if (!empty($current_taxonomies)) {
        // Get the title of the current post.
        $title = get_post_field('post_title', $post_id);
        //echo 'Post title: ' . $title . '<br>';

        // Query for posts of the other post types with the same title.
        $query_args = array(
            'post_type'      => array_diff(array_keys($post_type_taxonomy_map), array($current_post_type)),
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'title'          => $title,
            'exclude'        => $post_id, // Exclude the current post from the query.
        );

        // Get posts with similar titles in other post types.
        $other_posts = get_posts($query_args);
        //echo 'Number of other posts found: ' . count($other_posts) . '<br>';

        if ($other_posts) {
            $other_post_id = $other_posts[0]->ID;
            //echo 'Other post ID: ' . $other_post_id . '<br>';

            // Get the post type of the other post.
            $other_post_type = get_post_type($other_post_id);
            $other_taxonomies = isset($post_type_taxonomy_map[$other_post_type]) ? $post_type_taxonomy_map[$other_post_type] : array();
            //echo 'Other taxonomies: ' . implode(', ', $other_taxonomies) . '<br>';

            foreach ($current_taxonomies as $index => $current_taxonomy) {
                $other_taxonomy = $other_taxonomies[$index] ?? '';
                //echo 'Mapping ' . $current_taxonomy . ' to ' . $other_taxonomy . '<br>';

                if ($current_taxonomy && $other_taxonomy) {
                    // Get the terms for the current post in the specified taxonomy.
                    $terms = wp_get_post_terms($post_id, $current_taxonomy, array("fields" => "names"));
                    //echo 'Term names in ' . $current_taxonomy . ' for post ID ' . $post_id . ': ' . implode(', ', $terms) . '<br>';

                    if (!empty($terms) && !is_wp_error($terms)) {
                        // Set the terms for the other post, overriding any existing terms.
                        wp_set_object_terms($other_post_id, $terms, $other_taxonomy, false);
                        //echo 'Set terms for post ID ' . $other_post_id . ' in taxonomy ' . $other_taxonomy . ': ' . implode(', ', $terms) . '<br>';
                    } else {
                        // If no terms are set for the current post, remove all terms from the other post's taxonomy.
                        wp_set_object_terms($other_post_id, array(), $other_taxonomy, false);
                        //echo 'Removed all terms for post ID ' . $other_post_id . ' in taxonomy ' . $other_taxonomy . '<br>';
                    }
                }
            }
        }
    }
}



add_action( 'save_post', 'set_taxonomy_term_in_other_post_type', 30, 2 );
function set_taxonomy_term_in_other_post_type( $post_id, $post ) {
 
      // Define an array to map post types to their respective taxonomy names.
		$post_type_taxonomy_map = array(
			'sfwd-courses' => array('ld_course_tag', 'ld_course_category'),
			'sfwd-stations' => array('station_tag', 'station_category'),
		);
	
	
		// Sync terms for the course post
		sync_terms_by_title($post_id, $post_type_taxonomy_map);

		// Sync terms for the station post
		sync_terms_by_title($other_post_id, $post_type_taxonomy_map);
	
	
}




function create_term_in_other_taxonomy( $term_id, $tt_id, $taxonomy ) {
    // Define an array mapping the taxonomies to each other
    $taxonomy_mapping = array(
        'ld_course_category' => 'station_category',
        'station_category' => 'ld_course_category',
    );

    // Check if the created term's taxonomy is mapped
    if ( array_key_exists( $taxonomy, $taxonomy_mapping ) ) {
        // Get the term object
        $term = get_term( $term_id, $taxonomy );

        // Check if the term exists and is not a WP_Error object
        if ( ! is_wp_error( $term ) && $term ) {
            // Create a term in the mapped taxonomy with the same name
            wp_insert_term( $term->name, $taxonomy_mapping[ $taxonomy ] );
        }
    }
}

// Hook into the create_term action for both taxonomies
add_action( 'create_term', 'create_term_in_other_taxonomy', 10, 3 );







