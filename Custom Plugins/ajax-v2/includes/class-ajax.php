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
		
		//global $wpdb;
		//$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );
		
		if(empty($professional) && empty($state)){
			 $the_query = new WP_Query( array(
				'post_type' => 'professionals',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'tax_query' => array(
						array (
								'taxonomy' => 'expertise',
								'field' => 'slug',
								'terms' => $expertise,
								'operator' => 'IN'
						),
				), // end of tax query
			));
		}
		if(empty($professional) && empty($expertise)){
			 $the_query = new WP_Query( array(
				'post_type' => 'professionals',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'tax_query' => array(
						array (
								'taxonomy' => 'state',
								'field' => 'slug',
								'terms' => $state,
								'operator' => 'IN'
					   )
				), // end of tax query
			));
		}
		if(empty($professional) && empty($state) && empty($expertise)){
			 $the_query = new WP_Query( array(
				'post_type' => 'professionals',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			));
		}
		if (!empty($state) && !empty($expertise)) {
			 $the_query = new WP_Query( array(
				'post_type' => 'professionals',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'tax_query' => array(
				   'relation' => 'AND',
						array (
								'taxonomy' => 'expertise',
								'field' => 'slug',
								'terms' => $expertise,
								'operator' => 'IN'
						),
						array (
								'taxonomy' => 'state',
								'field' => 'slug',
								'terms' => $state,
								'operator' => 'IN'
					   )
				), // end of tax query
			));
		}
		if (!empty($professional)) {
			$the_query = new WP_Query( array(
				's' => $professional, 
				'post_type' => 'professionals',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			));
		}
			
		
		if ( $the_query->have_posts() ){
			while ( $the_query->have_posts() ) : 

				include(__DIR__.'/../view/loop-out.html.php');

			endwhile;
		}else{
			echo 'No results returned';
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