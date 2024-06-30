<?php

class puzzles extends Initialize{
	
	public function __construct() {
		parent::__construct();
		
        $this->submenu = &$GLOBALS['submenu'];
		
		add_action( 'init', array( $this, 'custom_sfwd_puzzle_post_type' ) );
		add_action( 'init', array( $this,'register_puzzle_category_taxonomy'));
        add_action( 'admin_menu', array( $this, 'add_sfwd_puzzles_to_ld_menu' ) );
		add_action('admin_footer',  array( $this,'add_categories_link_on_sfwd_puzzles_page'));

		
		add_action('add_meta_boxes', array( $this,'custom_sfwd_puzzles_meta_box'));
		add_action('save_post', array( $this,'custom_save_sfwd_puzzles_meta_box_data'));
		
		// hooks for the puzzles
		add_shortcode('display_puzzle', array( $this,'get_puzzle'));
	
		add_action('wp_ajax_get_crossword_data', array( $this,'get_crossword_data'));
		add_action('wp_ajax_nopriv_get_crossword_data', array( $this,'get_crossword_data'));
		
		add_action('wp_ajax_get_crossword_hint_data', array( $this,'get_crossword_hint_data'));
		add_action('wp_ajax_nopriv_get_crossword_hint_data', array( $this,'get_crossword_hint_data'));
		
		add_action('wp_ajax_get_wordsearch_data', array( $this,'get_wordsearch_data'));
		add_action('wp_ajax_nopriv_get_wordsearch_data', array( $this,'get_wordsearch_data'));
		
		
		
	
	}
	
	public function custom_sfwd_puzzle_post_type() {
        $labels = array(
            'name'                  => _x( 'Puzzles', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Puzzle', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Puzzles', 'text_domain' ),
            'name_admin_bar'        => __( 'Puzzle', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'All Items', 'text_domain' ),
            'add_new_item'          => __( 'Add New Item', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'view_items'            => __( 'View Items', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Puzzle', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'menu_icon'             => 'dashicons-networking', // Add this line to set the menu icon
			'rewrite'               => array( 'slug' => 'puzzles' ), // Set the rewrite slug
        );
        register_post_type( 'sfwd-puzzles', $args );
    }
	
	public function register_puzzle_category_taxonomy() {
		$labels = array(
			'name' => 'Puzzle Categories',
			'singular_name' => 'Puzzle Category',
			'search_items' => 'Search Puzzle Categories',
			'all_items' => 'All Puzzle Categories',
			'parent_item' => 'Parent Puzzle Category',
			'parent_item_colon' => 'Parent Puzzle Category:',
			'edit_item' => 'Edit Puzzle Category',
			'update_item' => 'Update Puzzle Category',
			'add_new_item' => 'Add New StatPuzzleion Category',
			'new_item_name' => 'New Puzzle Category Name',
			'menu_name' => 'Puzzle Categories',
		);

		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => false,
			'rewrite' => array('slug' => 'puzzle-category'), // Custom rewrite slug for the taxonomy
		);

		register_taxonomy('puzzle_category', 'sfwd-puzzles', $args);
	}
	
	
	
	public function add_categories_link_on_sfwd_puzzles_page(){
		 global $pagenow;

			// Check if the current page is the "sfwd-stations" edit page
			if ($pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'sfwd-puzzles') {
				?>
				<script type="text/javascript">
					document.addEventListener('DOMContentLoaded', function() {
						// Find the element to insert after (in this case, it's .wp-header-end)
						var insertAfterElement = document.querySelector('.wp-header-end');

						// Create a new element for the button-like link
						var linkElement = document.createElement('a');
						linkElement.textContent = 'Puzzle Categories';
						linkElement.href = 'edit-tags.php?taxonomy=puzzle_category&post_type=sfwd-puzzles';
						linkElement.classList.add('button', 'button-primary');

						// Create a new line element
						var newLineElement = document.createElement('br');

						// Insert the new line element and the button-like links after the insertAfterElement
						insertAfterElement.parentNode.insertBefore(newLineElement.cloneNode(), insertAfterElement.nextSibling);
						insertAfterElement.parentNode.insertBefore(linkElement.cloneNode(true), insertAfterElement.nextSibling);

						// Insert additional line break for spacing
						insertAfterElement.parentNode.insertBefore(newLineElement.cloneNode(), insertAfterElement.nextSibling);

						// Insert the new line element and the button-like link for station_tag after the insertAfterElement
						insertAfterElement.parentNode.insertBefore(newLineElement.cloneNode(), insertAfterElement.nextSibling);

						// Insert another line break for spacing
						insertAfterElement.parentNode.insertBefore(newLineElement.cloneNode(), insertAfterElement.nextSibling);
					});
				</script>

				<?php
			}
	}
	
	
    public function add_sfwd_puzzles_to_ld_menu() {
		// Define the submenu items
		$submenu_items = array(
			array( 'Puzzles', 'manage_options', 'edit.php?post_type=sfwd-puzzles' ),
			// Add other submenu items here
		);

		array_splice( $this->submenu['learndash-lms'], 5, 0, $submenu_items );
	}
	
	
	public function custom_sfwd_puzzles_meta_box() {
		add_meta_box(
			'custom_sfwd_puzzles_meta_box',
			'Word and Hint',
			array($this, 'custom_sfwd_puzzles_meta_box_callback'),
			'sfwd-puzzles',
			'normal',
			'high'
		);
	}
	
	public function custom_sfwd_puzzles_meta_box_callback($post) {
		// Retrieve existing word-hint pairs from post meta
		$puzzles = get_post_meta($post->ID, 'puzzle_meta', true);

		// Output HTML for meta box fields
		?>
		<div class="custom-meta-fields">
			<?php wp_nonce_field('custom_sfwd_puzzles_meta_box_nonce', 'custom_sfwd_puzzles_meta_box_nonce'); ?>
			<table id="custom-word-hint-table">
				<tr>
					<th>Word</th>
					<th>Hint</th>
					<th>Action</th> <!-- New column for delete button -->
				</tr>
				<?php
				// Check if there are existing word-hint pairs
				if (!empty($puzzles) && is_array($puzzles)) {
					// Loop through each pair
					foreach ($puzzles as $index => $pair) {
						// Output a row for each pair with the word and hint fields filled
						echo '<tr class="custom-word-hint-row">';
						echo '<td><input type="text" name="word[]" value="' . esc_attr($pair['word']) . '" placeholder="Enter Word"></td>';
						echo '<td><input type="text" name="hint[]" value="' . esc_attr($pair['hint']) . '" placeholder="Enter Hint"></td>';
						echo '<td><button class="custom-delete-row-button">Delete</button></td>'; // Delete button
						echo '</tr>';
					}
				} else {
					// Output an empty row for new entries if no existing pairs found
					echo '<tr class="custom-word-hint-row">';
					echo '<td><input type="text" name="word[]" placeholder="Enter Word"></td>';
					echo '<td><input type="text" name="hint[]" placeholder="Enter Hint"></td>';
					echo '<td><button class="custom-delete-row-button">Delete</button></td>'; // Delete button
					echo '</tr>';
				}
				?>
			</table>
			<!-- Add Word Hint Group button -->
			<button id="custom-add-row-button">Add Word Hint Group</button>
		</div>
		<?php
	}

	public function custom_save_sfwd_puzzles_meta_box_data($post_id) {
		// Check if nonce is set and valid
		if (!isset($_POST['custom_sfwd_puzzles_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_sfwd_puzzles_meta_box_nonce'], 'custom_sfwd_puzzles_meta_box_nonce')) {
			return;
		}

		// Check if autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		// Check permissions
		if ('sfwd-puzzles' !== $_POST['post_type'] || !current_user_can('edit_post', $post_id)) {
			return;
		}

		// Initialize an empty array to store puzzle data
		$puzzles = array();
		
		// Retrieve and sanitize word and hint arrays
		$words = array_map('sanitize_text_field', $_POST['word']);
		$hints = array_map('sanitize_text_field', $_POST['hint']);

		// Initialize puzzles array
		$puzzles = array();

		// Combine word and hint arrays into puzzle data array
		for ($i = 0; $i < count($words); $i++) {
			// Remove foreign characters from words
			$word = preg_replace('/[^A-Za-z0-9\s\-]/', '', $words[$i]);

			// Remove foreign characters from hints
			$hint = preg_replace('/[^A-Za-z0-9\s\-]/', '', $hints[$i]);

			// Check if both word and hint are not empty before adding to puzzles array
			if (!empty($word) && !empty($hint)) {
				$puzzles[] = array(
					'word' => $word,
					'hint' => $hint
				);
			}
		}

		// Save puzzle data array as post meta with meta key "puzzle_meta"
		update_post_meta($post_id, 'puzzle_meta', $puzzles);
		
		
	}
	
	public function get_puzzle() {
		
		$current_post_id = get_the_ID(); // Get the current post ID
		$current_term = wp_get_post_terms($current_post_id, 'puzzle_category');

		if (!empty($current_term) && !is_wp_error($current_term)) {
			$term_slug = $current_term[0]->slug; // Get the name of the first term (assuming one term per post)
			//echo 'Current Puzzle Category: ' . $term_slug;
		} else {
			//echo 'No Puzzle Category found for the current post.';
		}
		
			/* 
				SELECT `meta_value`
				FROM `wp_g3mmvh_postmeta` 
				WHERE `meta_key` = 'puzzle_meta'
				AND `post_id` = 1696
			*/

		//$results = $wpdb->get_results("SELECT word, hint FROM {$wpdb->prefix}puzzles WHERE parent_id = 1491");
		//$page_id = 1696;
		
		$user_id = get_current_user_id(); // Get the current user ID
		
		// Check if the user has an active WooCommerce membership
		if (wc_memberships_is_user_active_member($user_id)) {
		
		$page_id = get_the_ID();
		$results = $this->wpdb->get_results(
			$this->wpdb->prepare(
				"SELECT `meta_value`
				FROM `{$this->wpdb->prefix}postmeta`
				WHERE `meta_key` = 'puzzle_meta'
				AND `post_id` = %d",
				$page_id
			)
		);
		//print_r($results);

		//$results = $wpdb->get_results("SELECT ID, puzzle_meta FROM {$wpdb->prefix}puzzles WHERE parent_id = 1491 AND ID = 1");
		//print_r($results);
		
				if($term_slug == 'crossword'){	
			
					include(THEME_PATH . '/views/puzzles/crossword.html.php');
			
				}elseif($term_slug == 'word-search'){

					include(THEME_PATH . '/views/puzzles/word-search.html.php');
			
				}else{
					
				}
			
		}else{

			// Generate the HTML content based on the query results
			$html = 'Sorry, you need to purchase a membership to access this content. Please <a href=\'/memberships/\'>visit our shop</a> to subscribe.';

		}
				
		return $html; // Return HTML string
	}

	public function get_crossword_data(){

		// Retrieve the page ID from the AJAX request
		$page_id = $_GET['currentPageId'];
		//$page_id_variable = 1696; // Replace 1696 with your actual variable or value

		// Construct the SQL query to fetch puzzle data
		$query = $this->wpdb->prepare(
			"SELECT `meta_value`
			FROM `{$this->wpdb->prefix}postmeta`
			WHERE `post_id` = %d
			AND `meta_key` = 'puzzle_meta'",
			$page_id
		);

		// Execute the query
		$crossword_data = $this->wpdb->get_results($query);

		// Initialize an empty array to store the word-hint pairs
		$wordBank = array();

		// Iterate over the $crossword_data array to construct the wordBank array
		foreach ($crossword_data as $crossword) {
			// Unserialize the PHP serialized data to an array
			$word_hint_pairs = unserialize($crossword->meta_value);

			// Check if unserialization was successful and $word_hint_pairs is an array
			if (is_array($word_hint_pairs)) {
				// Add each word-hint pair to the wordBank array
				foreach ($word_hint_pairs as $pair) {
					$wordBank[] = array('word' => $pair['word'], 'hint' => $pair['hint']);
				}
			} else {
				// Handle case where unserialization fails
				wp_send_json_error('Error: Unable to unserialize puzzle_meta field');
			}
		}


		// Return JSON response
		wp_send_json($wordBank);
	}
	public function get_crossword_hint_data(){
		
	  // Retrieve the parameters sent via AJAX
		$clue = $_POST['clue'];
		$clue = ucwords(strtolower($clue));
		
		//$clue = 'Cinderella';
		$page_id = $_POST['pageId'];

		// Formulate your SQL query
		$query = $this->wpdb->prepare(
			"SELECT meta_value
			FROM {$this->wpdb->postmeta}
			WHERE post_id = %d
			AND meta_key = 'puzzle_meta'",
			$page_id
		);

		// Execute the query
   		$result = $this->wpdb->get_results( $query );

		// Check if the query was successful
		if ($result) {
			// Output the raw serialized data for inspection
			$raw_serialized_data = $result[0]->meta_value;

			// Unserialize the serialized data
			$unserialized_data = maybe_unserialize($raw_serialized_data);

			// Check if unserialization was successful
			if ($unserialized_data !== false) {
				// Convert the unserialized data to JSON
				$json_data = json_encode($unserialized_data);

				// Decode the JSON string into an associative array
				$formatted_result = json_decode($json_data, true);

				// Check if decoding was successful
				if ($formatted_result !== null) {
					// Find the hint associated with the clue
					$hint = '';
					foreach ($formatted_result as $pair) {
						if ($pair['word'] === $clue) {
							$hint = $pair['hint'];
							break;
						}
					}

					// Output the hint
					if (!empty($hint)) {
						echo $hint;
					} else {
						echo json_encode(array('error' => 'Hint not found for the given clue'));
					}
				} else {
					// If decoding failed
					echo json_encode(array('error' => 'Decoding failed: ' . json_last_error_msg()));
				}
			} else {
				// If unserialization failed
				echo json_encode(array('error' => 'Unserialization failed'));
			}
		} else {
			// Handle errors if the query failed
			echo json_encode(array('error' => 'Query failed'));
		}
		
		
		
		
		
		   wp_die();
	}

	public function get_wordsearch_data(){

		
	$page_id = $_GET['currentPageId'];
		//$page_id_variable = 1696; // Replace 1696 with your actual variable or value

		// Construct the SQL query to fetch puzzle data
		$query = $this->wpdb->prepare(
			"SELECT `meta_value`
			FROM `{$this->wpdb->prefix}postmeta`
			WHERE `post_id` = %d
			AND `meta_key` = 'puzzle_meta'",
			$page_id
		);

		// Execute the query
		$wordsearch_data = $this->wpdb->get_results($query);
		//print_r($wordsearch_data);
		
		// Initialize an empty array to store the word-hint pairs
		$wordBank = array();

		// Iterate over the $crossword_data array to construct the wordBank array
		foreach ($wordsearch_data as $wordsearch) {
			// Unserialize the PHP serialized data to an array
			$words = unserialize($wordsearch->meta_value);

			// Check if unserialization was successful and $word_hint_pairs is an array
			if (is_array($words)) {
				// Add each word-hint pair to the wordBank array
				foreach ($words as $word) {
					$wordBank[] = array('word' => $word['word']);
				}
			} else {
				// Handle case where unserialization fails
				wp_send_json_error('Error: Unable to unserialize puzzle_meta field');
			}
		}

		// Return JSON response
		wp_send_json($wordBank);

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
$puzzle_obj = new puzzles;