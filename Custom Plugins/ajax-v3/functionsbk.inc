<?php 
class ajax
{
    public function __construct()
    {
      $this->init();
    }
    public function init()
    {
        add_shortcode('professionals_posts', array($this, 'professionals'));
        add_action('wp_ajax_data_fetch' , array($this,'data_fetch'));
        add_action('wp_ajax_nopriv_data_fetch',array($this,'data_fetch'));    
        add_action( 'wp_enqueue_scripts', array($this,'wptuts_scripts_basic' )); 
    }
    public function professionals(){
        ob_start();
    
        require_once(__DIR__.'/../view/info.html.php');

        wp_reset_postdata();
        wp_reset_query();
        
        $html = ob_get_clean();
        return $html;
    }
    public function data_fetch(){
        $state = $_POST['state'];
		$expertise = $_POST['expertise'];
		$professional = $_POST['professional'];
		
		//echo $state;
		//echo $expertise;
		//echo $professional;
		
		global $wpdb;
		if(empty($professional) && empty($state) && empty($expertise)){

				$results = $wpdb->get_results( "
				
				SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
				FROM {$wpdb->prefix}posts p
				LEFT JOIN {$wpdb->prefix}postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
				LEFT JOIN {$wpdb->prefix}postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
				WHERE p.post_type = 'professionals'
				AND p.post_status = 'publish'
				ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC
				
				" );
			
		        include(__DIR__.'/../view/loop-out.html.php');	
		}
		if(empty($professional) && empty($state)){
				$results = $wpdb->get_results("
				
				    SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
					FROM {$wpdb->prefix}posts p
					LEFT JOIN {$wpdb->prefix}postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
					LEFT JOIN {$wpdb->prefix}postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
					INNER JOIN {$wpdb->prefix}term_relationships tr ON (p.ID = tr.object_id)
					INNER JOIN {$wpdb->prefix}term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
					INNER JOIN {$wpdb->prefix}terms t ON (tt.term_id = t.term_id)
					WHERE p.post_type = 'professionals'
					AND p.post_status = 'publish'
					AND tt.taxonomy = 'expertise'
					AND t.name = '$expertise'
					ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC
				 
				  ");
		
		          include(__DIR__.'/../view/loop-out.html.php');
		}
		if(empty($professional) && empty($expertise)){
			$results = $wpdb->get_results("
			
			
					SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
					FROM {$wpdb->prefix}posts p
					LEFT JOIN {$wpdb->prefix}postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
					LEFT JOIN {$wpdb->prefix}postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
					INNER JOIN {$wpdb->prefix}term_relationships tr ON (p.ID = tr.object_id)
					INNER JOIN {$wpdb->prefix}term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
					INNER JOIN {$wpdb->prefix}terms t ON (tt.term_id = t.term_id)
					WHERE p.post_type = 'professionals'
					AND p.post_status = 'publish'
					AND tt.taxonomy = 'state'
					AND t.name = '$state'
					ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC
				  
				  ");
		
		          include(__DIR__.'/../view/loop-out.html.php');
		}
		if (!empty($state) && !empty($expertise)) {
			
			/*
				SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
				FROM ojr_posts p
				LEFT JOIN ojr_postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
				LEFT JOIN ojr_postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
				INNER JOIN ojr_term_relationships tr1 ON (p.ID = tr1.object_id)
				INNER JOIN ojr_term_taxonomy tt1 ON (tr1.term_taxonomy_id = tt1.term_taxonomy_id)
				INNER JOIN ojr_terms t1 ON (tt1.term_id = t1.term_id)
				INNER JOIN ojr_term_relationships tr2 ON (p.ID = tr2.object_id)
				INNER JOIN ojr_term_taxonomy tt2 ON (tr2.term_taxonomy_id = tt2.term_taxonomy_id)
				INNER JOIN ojr_terms t2 ON (tt2.term_id = t2.term_id)
				WHERE p.post_type = 'professionals'
				AND p.post_status = 'publish'
				AND tt1.taxonomy = 'state'
				AND t1.name = 'Maryland'
				AND tt2.taxonomy = 'expertise'
				AND t2.name = 'Policy'
				ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC
			*/
			$results = $wpdb->get_results( "
											SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
											FROM {$wpdb->prefix}posts p
											LEFT JOIN {$wpdb->prefix}postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
											LEFT JOIN {$wpdb->prefix}postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
											INNER JOIN {$wpdb->prefix}term_relationships tr1 ON (p.ID = tr1.object_id)
											INNER JOIN {$wpdb->prefix}term_taxonomy tt1 ON (tr1.term_taxonomy_id = tt1.term_taxonomy_id)
											INNER JOIN {$wpdb->prefix}terms t1 ON (tt1.term_id = t1.term_id)
											INNER JOIN {$wpdb->prefix}term_relationships tr2 ON (p.ID = tr2.object_id)
											INNER JOIN {$wpdb->prefix}term_taxonomy tt2 ON (tr2.term_taxonomy_id = tt2.term_taxonomy_id)
											INNER JOIN {$wpdb->prefix}terms t2 ON (tt2.term_id = t2.term_id)
											WHERE p.post_type = 'professionals'
											AND p.post_status = 'publish'
											AND tt1.taxonomy = 'state'
											AND t1.name = '{$state}'
											AND tt2.taxonomy = 'expertise'
											AND t2.name = '{$expertise}'
											ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC
											
											" );
			
		        include(__DIR__.'/../view/loop-out.html.php');	
		}
		if (!empty($professional)) {
				$results = $wpdb->get_results( "
				
										SELECT *
												FROM ojr_posts
												LEFT JOIN ojr_postmeta ON ojr_posts.ID = ojr_postmeta.post_id
												WHERE ojr_posts.post_type = 'professionals'
												AND (ojr_posts.post_title LIKE '%{$professional}%' OR ojr_posts.post_content LIKE '%{$professional}%')
												AND ojr_postmeta.meta_key = 'last_name'
												ORDER BY ojr_postmeta.meta_value ASC
												
												" );
			
		        include(__DIR__.'/../view/loop-out.html.php');		
		}

		
		
		
		
		
		
		
        die();
    }
    public function wptuts_scripts_basic()
    {
        wp_register_script( 'custom-script', CWB_INDEX .'public/js/functions.js');
        wp_enqueue_script( 'custom-script' );

        wp_enqueue_script(  'sample_wpajax_plugin', CWB_INDEX .'public/js/functions.js', array( 'jquery' ) );
        wp_localize_script( 'sample_wpajax_plugin', 'al',   array(  'ajaxurl'  => admin_url( 'admin-ajax.php' )  ) );
    }
}
new ajax();