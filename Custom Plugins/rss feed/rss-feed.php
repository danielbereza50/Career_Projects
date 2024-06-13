<?php

// Register the custom endpoints
// https://raymond.ca/test/
// https://raymond.ca/events-posts/custom
// https://raymond.ca/news-posts/custom

add_action('init', 'register_custom_rss_endpoints');
function register_custom_rss_endpoints() {
	
    add_rewrite_rule('^news-posts/custom/v4?','index.php?custom_rss_feed=news','top');

    add_rewrite_rule('^events-posts/custom/v4?','index.php?custom_rss_feed=events','top');
    
	
    add_rewrite_tag('%custom_rss_feed%','([^&]+)');
}

// Add the custom endpoint query var
add_filter('query_vars', 'add_custom_rss_query_var');
function add_custom_rss_query_var($vars) {
    $vars[] = 'custom_rss_feed';
    return $vars;
}

// Hook into 'template_redirect' to handle the custom endpoint
add_action('template_redirect', 'handle_custom_rss_endpoint');
function handle_custom_rss_endpoint() {
    $custom_rss_feed = get_query_var('custom_rss_feed');
    
    if($custom_rss_feed) {
        // Generate the RSS content based on the endpoint
        if ($custom_rss_feed === 'news') {
            generate_news_rss_content();
        } elseif ($custom_rss_feed === 'events') {
            generate_events_rss_content();
        }
        // Stop further execution
        exit();
    }
}

// Function to generate news RSS content
function generate_news_rss_content() {
    global $wpdb;
	
    //  LIMIT 1
    $query = "SELECT * FROM {$wpdb->prefix}posts p 
              LEFT JOIN {$wpdb->prefix}term_relationships tr ON p.ID = tr.object_id
              LEFT JOIN {$wpdb->prefix}term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
              LEFT JOIN {$wpdb->prefix}terms t ON tt.term_id = t.term_id
              WHERE p.post_type = 'post' 
              AND p.post_status = 'publish' 
              AND tt.taxonomy = 'category' 
              AND t.name = 'News'
			  
			 
			  
			  ";

    generate_custom_rss_content($query, 'custom-news.rss');
}

// Function to generate events RSS content
function generate_events_rss_content() {
    global $wpdb;

    $query = "SELECT * FROM {$wpdb->prefix}posts p 
              WHERE p.post_type = 'event' 
              AND p.post_status = 'publish'
			  
			  ";
    
    generate_custom_rss_content($query, 'custom-events.rss');
}

// Function to generate custom RSS content
function generate_custom_rss_content($query, $filename) {
    global $wpdb;

    $posts = $wpdb->get_results($query);

    header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
    echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
    ?>
    <rss version="2.0"
            xmlns:content="http://purl.org/rss/1.0/modules/content/"
            xmlns:wfw="http://wellformedweb.org/CommentAPI/"
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:atom="http://www.w3.org/2005/Atom"
            xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
            xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
            <?php do_action('rss2_ns'); ?>>
    <channel>
            <title><?php bloginfo_rss('name'); ?></title>
            <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
		    <description><?php bloginfo_rss('description') ?></description>
            <link><?php bloginfo_rss('url') ?></link>
            <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
            <language>en-US</language>
		
			<?php $processed_ids = array(); // Initialize array to store processed post IDs ?>
            <?php foreach($posts as $post) : setup_postdata($post); ?>
			<?php
				 $post_id = $post->ID; // Get the current post ID
				$post_content = $post->post_content;

				if (!is_array($processed_ids)) {
					$processed_ids = array(); // Initialize $processed_ids if it's null
				}
				// Check if the post ID has already been processed
				if (in_array($post_id, $processed_ids)) {
					continue; // Skip processing if the ID has been seen before
				}
				// Add the current post ID to the processed array
				$processed_ids[] = $post_id;
	
				 // Retrieve meta values for the specified keys
				$start_date = get_post_meta($post_id, '_eventorganiser_schedule_start_start', true);
				$finish_date = get_post_meta($post_id, '_eventorganiser_schedule_start_finish', true);

				// Format date values to the required format
				$formatted_start_date = date_format(date_create($start_date), 'Y-m-d\TH:i:sP');
				$formatted_finish_date = date_format(date_create($finish_date), 'Y-m-d\TH:i:sP');

				
				$terms_news = get_the_terms($post_id, 'category');
	
				$terms_events = get_the_terms($post_id, 'event-category');
				$terms_venue = get_the_terms($post_id, 'event-venue');
					
	
			?>
                    <item>
                              <?php if ($post->post_type === 'event') : ?>
								<summary><?php echo htmlspecialchars($post->post_title, ENT_XML1); ?></summary>
									<startDate><?php echo $formatted_start_date; ?></startDate>
									<endDate><?php echo $formatted_finish_date; ?></endDate>
							<?php else : ?>
								<title><?php echo htmlspecialchars($post->post_title, ENT_XML1); ?></title>
							<?php endif; ?>
                            <link><?php echo get_permalink($post_id); ?></link>
		 				    <?php 
					
								$date = new DateTime($post->post_date);
	
							// Set the year to 2029
							//$date->setDate(2029, $date->format('m'), $date->format('d'));
	
								if ($post->post_type === 'event') : ?>
							<?php else : ?>
								<pubDate><?php echo $date->format('Y-m-d\TH:i:s.u\Z'); ?></pubDate>
							<?php endif; ?>
							<dc:creator><?php echo get_the_author_meta('display_name', $post->post_author); ?></dc:creator>
						 <?php if ($post->post_type === 'event') : ?>
							<?php if ($terms_events) : ?>
									<?php foreach ($terms_events as $term_events) : ?>
										<category><?php echo esc_html($term_events->name); ?></category>
									<?php endforeach; ?>
							<?php endif; ?>
						<?php else : ?>
									<?php foreach ($terms_news as $term_news) : ?>
										<category><?php echo esc_html($term_news->name); ?></category>
									<?php endforeach; ?>
						<?php endif; ?>

                            <guid isPermaLink="false"><?php echo get_permalink($post_id); ?></guid>
                          <description><?php echo htmlspecialchars($post_content); // the_excerpt_rss() ?></description>
		 				 <?php 
                                $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
                              
                            ?>	
							<images>
								<image>
									<url><?php echo $featured_image_url; ?></url>
								</image>
							</images>
		
		
								<?php if ($terms_venue) : ?>
											<?php foreach ($terms_venue as $term_venue) : 
												
												// Fetch venue ID from term_id
												$venue_id = $term_venue->term_id;
												// Fetch venue meta data from database
												global $wpdb;
												$venue_meta = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}eo_venuemeta WHERE eo_venue_id = %d", $venue_id), ARRAY_A);
												if ($venue_meta) : 
	
													$concatenated_values = '';
													foreach ($venue_meta as $meta) {
														// Skip lat and lng meta keys
														if ($meta['meta_key'] !== '_lat' && $meta['meta_key'] !== '_lng') {
															$concatenated_values .= esc_html($meta['meta_value']) . ' ';
														}
													}
													?><location><?php echo trim($concatenated_values); ?></location>
												<?php endif; ?>
											<?php endforeach; ?>
									<?php endif; ?>
                           	<content:encoded><?php the_excerpt_rss() ?></content:encoded>
                          
		
				<?php if ($post->post_type === 'event') : ?>
                        <!--<image><?php //echo $featured_image_url; ?></image>-->
                    <?php else : ?>
                         <!-- <enclosure url="<?php //echo $featured_image_url; ?>" length="0" type="image/jpeg" />-->
                    <?php endif; ?>
		
		
                            <?php do_action('rss2_item'); ?>
                    </item>
            <?php endforeach; ?>
    </channel>
    </rss>
    <?php
    wp_reset_postdata(); // Reset Post Data
}
