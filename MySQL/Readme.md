Structure has been used since WP version 3.8  
 
 
How to:

   1. https://deliciousbrains.com/tour-wordpress-database/
   
   2. example, store the results from the MySQL database in a php variable to be used sometime later, like so: 
   
   global $wpdb;
   
   $table_name = $wpdb->prefix . "wp_usermeta";
   
    // debugging purposes

    //$users_id = get_users( array( 'fields' => array( 'ID' ) ) );   
    //foreach($users_id as $user){
    //print_r(get_user_meta ( $user->ID));
    //}
   
   // set the post meta equal to the user meta for that ID
 
   $post_meta = get_user_meta($user_id);
    
    //print_r($post_meta);
   
   // get the data from a web form field, 'group code' is the name of the field control
 
   $group_code = $post_meta['group_code']['0'];
   
   // ***note run the query in the phpmyadmin first to see what is returned from the query
   
   $post_id = $wpdb->get_results("SELECT 'role_manage' FROM ".$table_name." WHERE group_code= '".$group_code."' ");

   // print out the data onto a web page using a foreach loop
   
   foreach ($post_id as $post_ids)
   
       { ?>
         <li><?php echo $post_ids->umeta_id;?></li>
         <li><?php echo $post_ids->meta_key;?></li>
         <li><?php echo $post_ids->meta_value;?></li>  
        <?php }
  
   
  
   
 great example of combining two or more queries and the resulting SQL using the WP_query class:
 
 taken from : https://stackoverflow.com/questions/23555109/wordpress-combine-queries
 
       PHP:

      /**
       * Demo #1 - Combine two sub queries:
       */

        $args1 = array(
     
         'post_type'  => 'post',
        
        'orderby'    => 'title',
        
        'order'      => 'ASC',
        
        'date_query' => array(
        
             array( 'after' => '2013-12-14 13:03:40' ),
             
         ),
        );

        $args2 = array(
    
        'post_type'  => 'post',
        
        'orderby'    => 'title',
        
        'order'      => 'DESC',
        
        'date_query' => array(
        
            array( 'before' => '2013-12-14 13:03:40', 'inclusive' => TRUE ),   
            
        ),
       );

       $args = array( 
    
       'posts_per_page' => 1,
       
       'paged'          => 1,
       
       'sublimit'       => 1000,
       
       'args'           => array( $args1, $args2 ),
       
       );

       $results = new WP_Combine_Queries( $args );
 
       SQL(without the WP_query class):
       
       SELECT SQL_CALC_FOUND_ROWS * FROM ( 
       
        ( SELECT wp_posts.* 
        
            FROM wp_posts 
            
            WHERE 1=1 
            
                AND ( ( post_date > '2013-12-14 13:03:40' ) ) 
                
                AND wp_posts.post_type = 'post' 
                
                AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') 
                
                ORDER BY wp_posts.post_title ASC 
                
                LIMIT 1000
        ) 
        UNION 
        ( SELECT wp_posts.* 
        
            FROM wp_posts 
            
            WHERE 1=1 
            
            AND ( ( post_date <= '2013-12-14 13:03:40' ) ) 
            
            AND wp_posts.post_type = 'post' 
            
            AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') 
            
            ORDER BY wp_posts.post_title DESC 
            
            LIMIT 1000
        ) 
       ) as combined LIMIT 0, 10 
   
   
   
more MySQL examples:

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
   
   
   
   
   
   

