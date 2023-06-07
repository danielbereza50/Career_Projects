<?php

// Add menu item to the admin menu
function add_csv_import_menu_item() {
    add_menu_page(
        'CSV Import',
        'CSV Import',
        'manage_options',
        'csv-import',
        'csv_import_page',
        'dashicons-upload',
        25
    );
}
add_action('admin_menu', 'add_csv_import_menu_item');

// CSV Import page content
function csv_import_page() {
    ?>
    <div class="wrap">
        <h1>CSV Import</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv">
            <input type="submit" name="submit" value="Import">
        </form>
    </div>
    <?php
}

// Handle CSV file import
function handle_csv_import() {
    if (isset($_POST['submit'])) {
        if ($_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
            $csv_file = $_FILES['csv_file']['tmp_name'];
            if (($handle = fopen($csv_file, "r")) !== false) {
                $columnHeadings = fgetcsv($handle); // Read and ignore the column headings
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
					
					
                    $title = sanitize_text_field($data[0]);
                    $price = floatval($data[1]);
                    $image_url = $data[2];
					$attribute_values_sizes_with_pipe = $data[3];
					$attribute_values_flavors_with_pipe = $data[4];
                    $product_type = sanitize_text_field($data[5]);
					$category = sanitize_text_field($data[6]);
					
					

                    // Prepare the post data
                    $post = array(
                        'post_title'   => $title,
                        'post_type'    => 'product', // Replace 'products' with the actual custom post type slug
                        'post_status'  => 'publish'
                    );

                    // Insert the post
                    $postID = wp_insert_post($post);
					
					// Set the product category (taxonomy term)
					$term_slug = 'amish'; // Replace 'category-slug' with the actual slug of the category term
					$taxonomy = 'product_cat'; // Replace 'product_cat' with the actual taxonomy slug

					// Set the terms for the post
					wp_set_object_terms($postID, $term_slug, $taxonomy);

                    if ($postID) {
                        // Set the featured image/thumbnail
                
                        $image_id = media_sideload_image($image_url, $postID, $title, 'id');
                        if (!is_wp_error($image_id)) {
                            set_post_thumbnail($postID, $image_id);
                            echo 'Product imported successfully.';
                        } else {
                            echo 'Error importing the product image.';
                        }
                        // Update the regular price
                        update_post_meta($postID, '_regular_price', $price);

						/*variable product start*/
						
						
					if ($product_type === 'variable') {
						// Create variable product
						wp_set_object_terms($postID, 'variable', 'product_type'); // Set the product type

						$attribute_values_sizes_without_pipe = explode('|', $data[3]);
						$attribute_values_sizes_without_pipe = array_map('trim', $attribute_values_sizes_without_pipe);
						$attribute_taxonomy = 'pa_size'; // Replace with the actual attribute taxonomy slug

						$term_ids = array();

						foreach ($attribute_values_sizes_without_pipe as $attribute_value_sizes_without_pipe) {
							$existing_term = term_exists($attribute_value_sizes_without_pipe, $attribute_taxonomy);

							if ($existing_term) {
								$term_ids[] = $existing_term['term_id'];
							} else {
								$new_term = wp_insert_term($attribute_value_sizes_without_pipe, $attribute_taxonomy);

								if (!is_wp_error($new_term) && isset($new_term['term_id'])) {
									$term_ids[] = $new_term['term_id'];
								} else {
									echo 'Error creating term: ' . $new_term->get_error_message();
								}
							}
						}
						$attribute_values_flavors_without_pipe = explode('|', $data[4]);
						$attribute_values_flavors_without_pipe = array_map('trim', $attribute_values_flavors_without_pipe);
						$attribute_taxonomy = 'pa_flavor'; // Replace with the actual attribute taxonomy slug

						$term_ids = array();

						foreach ($attribute_values_flavors_without_pipe as $attribute_value_flavor_without_pipe) {
							$existing_term = term_exists($attribute_value_flavor_without_pipe, $attribute_taxonomy);

							if ($existing_term) {
								$term_ids[] = $existing_term['term_id'];
							} else {
								$new_term = wp_insert_term($attribute_value_flavor_without_pipe, $attribute_taxonomy);

								if (!is_wp_error($new_term) && isset($new_term['term_id'])) {
									$term_ids[] = $new_term['term_id'];
								} else {
									echo 'Error creating term: ' . $new_term->get_error_message();
								}
							}
						}
						
						// Set product attributes
						$attributes = array(
							'sizes' => array(
								'name' => 'sizes',
								'value' => $attribute_values_sizes_with_pipe,
								'is_taxonomy' => 0,
								'is_visible' => 1,
								'is_variation' => 1
							),
							'flavors' => array(
								'name' => 'flavors',
								'value' => $attribute_values_flavors_with_pipe,
								'is_taxonomy' => 0,
								'is_visible' => 1,
								'is_variation' => 1
							)
						);

						// Update the post meta with the attributes
						update_post_meta($postID, '_product_attributes', $attributes);

						// Create variations
						$product = wc_get_product($postID);
						$result = $product->sync($postID);

						// Check if variations were created successfully
						if (is_wp_error($result)) {
							echo 'Error creating variations: ' . $result->get_error_message();
						} else {
							echo 'Variations created successfully.';
						}
	
						// Check if the product is variable
						if ($product->is_type('variable')) {
							 $size_values = explode('|', $data[3]);
							 $flavor_values = explode('|', $data[4]);

							//print_r($size_values);
							  $variation_ids = array(); // Store the created variation IDs
							  $count = 0;
								foreach ($size_values as $size) {
									foreach ($flavor_values as $flavor) {
										$count++;
										$variation = new WC_Product_Variation();
										$variation->set_parent_id($product->get_id());
										$variation->set_attributes(array(
											'pa_size' => $size,
											'pa_flavor' => $flavor
										));
										//$variation->set_sku('SKU123222222'); // Replace with the SKU
										 // Set price for variations with "small" size attribute
										if ($size === 'small') {
											$variation->set_regular_price('10.99');
										} elseif($size === 'medium') {
											$variation->set_regular_price('11.99');
										}else{
											$variation->set_regular_price('12.99');
										}
										$variation->set_stock_status('instock'); // Replace with the stock status
										$variation->save();

										if ($variation->get_id()) {
											$variation_ids[] = $variation->get_id();
											//echo 'Size: ' . $size . ' and Flavor: ' . $flavor . '<br>';
											
											 // Update attribute_sizes for the variation
											$variation->update_meta_data('attribute_sizes', $size);

											// Update attribute_flavors for the variation
											$variation->update_meta_data('attribute_flavors', $flavor);

											
											
											
											

											$variation->save();
											
										} else {
											echo 'Error creating variation for Size: ' . $size . ' and Flavor: ' . $flavor;
										}
										echo $count;
									}
								}

								if (!empty($variation_ids)) {
									echo 'Variations created successfully.';
								}
							} else {
								echo 'The product is not of variable type. Variations can only be created for variable products.';
							}


						
						
						
						
						
						
	
						/*variable product end*/
							echo 'Variable product and variations created successfully.';
						} else {
							// Create simple product
							wp_set_object_terms($postID, 'simple', 'product_type'); // Set the product type

							echo 'Simple product created successfully.';
						}
                    } else {
                        echo 'Error importing the product.';
                    }
                }
                fclose($handle);
                echo 'CSV file imported successfully.';
            } else {
                echo 'Error opening the CSV file.';
            }
        } else {
            echo 'Error uploading the CSV file.';
        }
    }
}
add_action('admin_init', 'handle_csv_import');

