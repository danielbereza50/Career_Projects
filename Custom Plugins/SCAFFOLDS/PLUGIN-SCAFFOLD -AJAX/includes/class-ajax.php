<?php 
class ajax
{
    // Properties
    //private $loop_count = 0;

    public function __construct($loop_count)
    {
      //$this->loop_count = $loop_count;
      $this->init();
    }
    
    public function init()
    {
        add_shortcode('blog_posts', array($this, 'blog_page'));
        add_action('wp_ajax_data_fetch' , array($this,'data_fetch'));
        add_action('wp_ajax_nopriv_data_fetch',array($this,'data_fetch'));    
        add_action( 'wp_enqueue_scripts', array($this,'wptuts_scripts_basic' )); 
    }

    public function blog_page(){
        ob_start();
    




        require_once(__DIR__.'/../view/info.html.php');







        wp_reset_postdata();
        wp_reset_query();
        
        $html = ob_get_clean();
        return $html;
    }
    public function data_fetch(){
         $filter = $_POST['filter'];





        die();
    }
    public function wptuts_scripts_basic()
    {
        wp_register_script( 'custom-script', plugin_dir_url( __FILE__ ).'public/js/blog.js');
        wp_enqueue_script( 'custom-script' );

        wp_enqueue_script(  'sample_wpajax_plugin', plugin_dir_url( __FILE__ ).'public/js/blog.js', array( 'jquery' ) );
        wp_localize_script( 'sample_wpajax_plugin', 'al',   array(  'ajaxurl'  => admin_url( 'admin-ajax.php' )  ) );
    }
}
//new ajax();