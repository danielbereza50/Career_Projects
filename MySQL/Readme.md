PHP/MySQL outside of wordpress

// Process Order and display paypal redirect link... autoredirect

	$customer_sql="INSERT INTO customers (first_name, last_name, billing_address1, billing_city, billing_state, billing_zipcode, phone, email, uname, upass, company_name, is_active,  site_ID, is_admin)
	VALUES ('".escape($_POST['billing_first_name'])."','".escape($_POST['billing_last_name'])."','".escape($_POST['billing_address_1'])."','".escape($_POST['billing_city'])."','".escape($_POST['billing_state'])."','".escape($_POST['billing_postcode'])."','".escape($_POST['billing_phone'])."','".escape($_POST['billing_email'])."','".escape($_POST['account_username'])."','".escape($_POST['account_password'])."','".escape($_POST['billing_address_1'])."', 1, 1, 1);";
	$customer_return=insert($customer_sql);


	mail('test@domain.com','A New Vendor Has Registered!',$information);



	$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_database);
	$sql = "SELECT * FROM customers ORDER BY customer_created DESC; 
	";
	// $sql2="SELECT COUNT(orders.ID) AS order_count FROM orders WHERE orders.customer_ID='".escape($customer['ID'])."'";
	// $result2=mysqli_query($sql2);
	// SELECT COUNT(orders.ID) AS order_count FROM orders WHERE orders.customer_ID=176

	$result = mysqli_query($conn, $sql); 
	while ($row = mysqli_fetch_assoc($result)) { 
	    $uqID = $row["uqID"];
	    $salt=runDecryptionProtocol($uqID);
	    $customer_email=decrypt($row["email"],$salt);
	    $customer_phone=decrypt($row["phone"],$salt);
	    $date = date("F d, Y h:i:s A",strtotime($row['customer_created']));
	    $ID = $row['ID'];
	    $html =  '<a href="/dashboard/customers/manage/'.$ID.'";?>Edit</a>';

	    if ($row['is_active'] == 1) {
			$active_mark='<a href="javascript:;" data-url="/dashboard/control/customers/'.$row['ID'].'" data-post="is_active" data-value="0" class="ajax-post active toggle-icon"><i class="fas fa-check-circle green"></i>';
	    } else {
			$active_mark='<a href="javascript:;" data-url="/dashboard/control/customers/'.$customer['ID'].'" data-post="is_active" data-value="1" class="ajax-post inactive toggle-icon"><i class="far fa-check-circle green"></i>';
	    }
		echo "<tr>
		     <td>". $row["company_name"] ."</td>
		     <td>".($customer_email =='' ? $row["email"] : $customer_email) ."</td>
		     <td>".($customer_phone =='' ? $row["phone"] : $customer_phone) ."</td>
		     <td>".$row["billing_zipcode"]."</td>
		     <td>".$active_mark."</td>
		     <td>".$date."</td>
		     <td>".$html."</td>
		     "; 
		echo "</tr>";
	    }


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
	
	$query = new WP_Query( $args1 );
	
	
	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	
	
	
	<?php endwhile; 
	endif; ?>
	

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
   
   
   
   
	// if the value is a serilaized string, use LIKE or REGEX
	// sample:

	SELECT DISTINCT p.post_title, p.post_content, p.post_name
					 FROM {$wpdb->posts} p
					 INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
					 WHERE p.post_type = 'sfwd-topic'
					 AND pm.meta_key = '_sfwd-topic'
					 AND pm.meta_value LIKE '%{$course_id}%'


	value -  a:3:{s:4:"name";s:9:"John Doe";s:3:"age";i:35;s:5:"email";s:17:"johndoe@example.com";}


	// if the value is not serilaized string, use opertors like =
	// sample:

	SELECT DISTINCT p.post_title, p.post_content, p.post_name
					 FROM {$wpdb->posts} p
					 INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
					 WHERE p.post_type = 'sfwd-topic'
					 AND pm.meta_key = '_sfwd-topic'
					 AND pm.meta_value = '{$course_id}'


	value -  6044
