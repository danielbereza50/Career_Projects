<?php 
class model_class{
	public function activate() {
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'liveshoutbox';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			name tinytext NOT NULL,
			text text NOT NULL,
			url varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

/* 
	global $wpdb;    
	$results = $wpdb->get_results( "SELECT * 
                    FROM wp_posts, wp_postmeta
                    WHERE wp_posts.ID = wp_postmeta.post_ID
                    AND wp_postmeta.meta_key NOT LIKE '\_%'   
                    AND wp_posts.post_type='speaker' 
                    AND wp_posts.post_status = 'publish';");
	
	//print_r($results);
	
	foreach ( $results as $result ) {
		echo $result->post_title;
		echo '<br>';
		echo $result->meta_value;   
		echo ': <br>';
		echo $result->meta_key;   
		echo ':';
	}
   

   
global $wpdb;

$uploadDir = wp_upload_dir();
$uploadDir = $uploadDir['baseurl'];

$sql = "
SELECT 
    post.ID,
    post.post_title,
    post.post_date,
    post.category_name,
    post.category_slug,
    post.category_id,
    CONCAT( '".$uploadDir."','/', thumb.meta_value) as thumbnail,
    post.post_type
FROM (
    SELECT  p.ID,   
          p.post_title, 
          p.post_date,
          p.post_type,
          MAX(CASE WHEN pm.meta_key = '_thumbnail_id' then pm.meta_value ELSE NULL END) as thumbnail_id,
      term.name as category_name,
      term.slug as category_slug,
      term.term_id as category_id
    FROM ".$wpdb->prefix."posts as p 
    LEFT JOIN ".$wpdb->prefix."postmeta as pm ON ( pm.post_id = p.ID)
    LEFT JOIN ".$wpdb->prefix."term_relationships as tr ON tr.object_id = p.ID
    LEFT JOIN ".$wpdb->prefix."terms as term ON tr.term_taxonomy_id = term.term_id
    WHERE 1 ".$where." 
	AND p.post_status = 'publish'
	AND p.post_type='speaker'
    GROUP BY p.ID ORDER BY p.post_date DESC
  ) as post
  LEFT JOIN ".$wpdb->prefix."postmeta AS thumb 
    ON thumb.meta_key = '_wp_attached_file' 
    AND thumb.post_id = post.thumbnail_id";

$posts = $wpdb->get_results($sql); 
	
//print_r($posts);	
	
	foreach ( $posts as $post ) {
		echo $post->thumbnail;
		echo $result->post_title;
	}
   
   
*/	
		}
}
$model_obj = new model_class();