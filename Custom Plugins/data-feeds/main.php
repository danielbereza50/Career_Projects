<?php

function rss_feed(){
	ob_start();
	?>

	<h2><?php _e( 'Recent news medlineplus.gov:', 'my-text-domain' ); ?></h2>
 
<?php 
 
// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed( 'https://domain.com/feeds/whatsnew.xml' );
 
if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
 
    // Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity( 5 ); 
 
    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items( 0, $maxitems );
 
endif;
?>
 
<ul>
    <?php if ( $maxitems == 0 ) : ?>
        <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) : ?>
            <li>
                <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                    title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                    <?php echo esc_html( $item->get_title() ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
	<?php
	
	return ob_get_clean();
	
}
add_shortcode('feed', 'rss_feed');

add_shortcode('articles', 'get_blog_articles');
function get_blog_articles(){
  ob_start();
  
  // Enter the name of your blog here followed by /wp-json/wp/v2/posts and add filters like this one that limits the result to 2 posts.
  $response = wp_remote_get( 'https://domain.com/wp-json/wp/v2/posts?per_page=99' );

  // Exit if error.
  if ( is_wp_error( $response ) ) {
    return;
  }

  // Get the body.
  $posts = json_decode( wp_remote_retrieve_body( $response ) );

  // Exit if nothing is returned.
  if ( empty( $posts ) ) {
    return;
  }

  // If there are posts.
  if ( ! empty( $posts ) ) {

    // For each post.
    foreach ( $posts as $post ) {

      // Use print_r($post); to get the details of the post and all available fields
      // Format the date.
      $fordate = date( 'n/j/Y', strtotime( $post->modified ) );
    ?>
<a href="<?php echo esc_url( $post->link ) ?>" target="_blank"><?php echo esc_html( $post->title->rendered ) ?></a>
<?php echo esc_html( $fordate ) ?>
<br>
    <?php
    }
  }
  return ob_get_clean();
}











