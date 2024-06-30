<?php 
class ajax
{
    public function __construct()
    {
      $this->init();
    }
    public function init()
    {
        add_shortcode('courses_posts', array($this, 'course_categories'));
        add_action('wp_ajax_data_fetch' , array($this,'data_fetch'));
        add_action('wp_ajax_nopriv_data_fetch',array($this,'data_fetch'));    
        add_action( 'wp_enqueue_scripts', array($this,'wptuts_scripts_basic' )); 
    }
    public function course_categories(){
        ob_start();
    
        require_once(__DIR__.'/../view/info.html.php');

        wp_reset_postdata();
        wp_reset_query();
        
        $html = ob_get_clean();
        return $html;
    }
    public function data_fetch(){
        $ccategory = $_POST['ccategory'];
		//echo $state;
		
		//global $wpdb;
		//$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );
	
		 // Get the current page number
		//echo $_POST['current_page'];
		if(is_numeric($_POST['current_page'])){
				$c_page = $_POST['current_page'];
		}else{
			$c_page = 1;
		}

		$the_query = new WP_Query( array(
				'post_type' => 'sfwd-courses',
				'posts_per_page' => 1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			    'paged' => $c_page,
				'tax_query' => array(
						array (
								'taxonomy' => 'ld_course_category',
								'field' => 'slug',
								'terms' => $ccategory,
								'operator' => 'IN'
					   )
				), // end of tax query
		));
		if (empty($ccategory)) {
			$the_query = new WP_Query( array(
				'post_type' => 'sfwd-courses',
				'posts_per_page' => 1,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'paged' => $c_page,
			));
		}
		if ( $the_query->have_posts() ){
			while ( $the_query->have_posts() ) : 

				include(__DIR__.'/../view/loop-out.html.php');

			endwhile;
			
				// Display pagination links
    echo '<div id="pagination" class = "pagination">';
    echo paginate_links( array(
        'total' => $the_query->max_num_pages,
        'current' => $c_page,
        'prev_text' => __( 'Prev', 'textdomain' ),
        'next_text' => __( 'Next', 'textdomain' ),
    ) );
    echo '</div>';
		}
	
		
		
		
		
		if (!$the_query->have_posts() ){
			echo 'No results returned';
		}	
        die();
    }
    public function wptuts_scripts_basic()
    {
		global $wp_query;
		
        wp_register_script( 'custom-script', CWB_INDEX .'public/js/ajax.js');
        wp_enqueue_script( 'custom-script' );

        wp_enqueue_script(  'sample_wpajax_plugin', CWB_INDEX .'public/js/ajax.js', array( 'jquery' ) );
        wp_localize_script( 'sample_wpajax_plugin', 'al',   array(  
			'ajaxurl'  => admin_url( 'admin-ajax.php' ), 
		) );
    }
}
new ajax();