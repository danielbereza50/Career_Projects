<?php
/*
    Plugin Name: 
    Plugin URI: 
    Description: This will help me the website more accessible to the disabled.  
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

// include ('includes/class1.php');
// include ('includes/class1.php');

function wpse_media_extra_column( $cols ) {
    $cols["alt"] = "Alt Text";
    return $cols;
}
add_filter( 'manage_media_columns', 'wpse_media_extra_column' );

function wpse_media_extra_column_value( $column_name, $id ) {
    
    if( $column_name == 'alt' ):
        $data =  get_post_meta( $id, '_wp_attachment_image_alt', true);
        echo ($data); 
    endif;
}   
add_action( 'manage_media_custom_column', 'wpse_media_extra_column_value', 10, 2 );

add_filter( 'request', 'isv_column_orderby' );
function isv_column_orderby( $vars ) {

global $current_user, $pagenow;
    
if('upload.php' == $pagenow ) {
       if(is_admin()):
        $vars = array_merge( $vars, array(
            'meta_key' => '_wp_attachment_image_alt',
            'orderby' => '_wp_attachment_image_alt'
        ) );
    endif;
 }
   return $vars;
}

// class name
class unused
{
    // class properties

    // class methods
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('unused-files', array(
            $this,
            'check_for_file'
        ));
    }

    public static function check_for_file()
    {
        ob_start();

        global $wpdb;

        $my_table_name = $wpdb->prefix . 'posts';
        $my_table_name_2 = $wpdb->prefix . 'postmeta';
        
        echo '<center>Images / Files that are not being used on the website</center>';
        $result = $wpdb->get_results("SELECT
          *
        FROM
          `".$wpdb->prefix."posts` i
        WHERE
          i.post_type = 'attachment'
          AND
          NOT EXISTS (SELECT * FROM `".$wpdb->prefix."posts` p WHERE p.ID = i.post_parent)
          AND
          NOT EXISTS (SELECT * FROM `".$wpdb->prefix."postmeta` pm WHERE pm.meta_key = '_thumbnail_id' AND pm.meta_value = i.ID)
          AND
          NOT EXISTS (SELECT * FROM `".$wpdb->prefix."posts` p WHERE p.post_type <> 'attachment' AND p.post_content LIKE CONCAT('%',i.guid,'%'))
          AND
          NOT EXISTS (SELECT * FROM `".$wpdb->prefix."postmeta` pm WHERE pm.meta_value LIKE CONCAT('%',i.guid,'%'))");
                
                foreach($result as $row) {
                    echo '<hr style="border-top: 5px solid green;">';
                    echo '<b>Image Name:</b> '.$row->post_name.', <br/>';
                    
                    echo '<b>File Type:</b> '.$row->post_mime_type.', <br/>';
                    
                    echo '<b>Is an attachment?:</b> '.$row->post_type.', <br/>';
                    echo '<hr style="border-top: 5px solid green;">';
                }
        
       //print_r($result);
        
        return ob_get_clean();
    }

}
$obj = new unused;


// class name
class links
{
    // class properties

    // class methods
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('external-links', array(
            $this,
            'check_for_external'
        ));
    }

    public static function check_for_external()
    {
        ob_start();
    
    // CHANGE THIS VALUE TO THE SITE URL !
    $_site_url = 'https://www.counselingwise.com/';

    $args = array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'category'         => '',
        'category_name'    => '',
        'orderby'          => 'title',
        'order'            => 'ASC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'       => '',
        'author_name'      => '',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );
        
    $myposts = get_posts( $args );
    foreach( $myposts as $post ) : setup_postdata($post); 
        
    ?>
    <style>
      p, h3, h2, h1, ol, img{display:none !Important;}
    </style>
    <?php
      //Get Post content
      $_post_content =  get_the_content();

      $site_parts = explode('.',$_site_url);
      $site_suffix = '.'.$site_parts[1];

      //Using regular expression to match hyperlink
      preg_match_all('|<a.*(?=href=\"([^\"]*)\")[^>]*>([^<]*)</a>|i', $_post_content, $match);

      foreach($match[0] as $link){
        //Filtering out internal links
        $parts = explode($site_suffix, $link);
        $domain = explode('//',$parts[0]);
        
        //echo $domain[1];
        if ($domain[1] != 'www.'.$site_parts[0] && $domain[1] != $site_parts[0] && strpos($link, 'nofollow') === FALSE){
        
        
            echo '<li><a href="'.get_permalink($post->ID) . '">Click here to go to the page the link was found on </a>,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  This is the actual link that was found:  '. $link.'</li>';
        
        
        }
      }

    endforeach;

    wp_reset_postdata(); 
        
    
        return ob_get_clean();
    }

}
$obj2 = new links;


// create an admin page with the data here
add_action('admin_menu', 'awesome_page_create');
function awesome_page_create() {
 
    $page_title = 'Custom Code';
    $menu_title = 'Custom Code';
    $capability = 'edit_posts';
    $menu_slug = 'Custom Code';
    $function = 'my_awesome_page_display';
    $icon_url = '';
    $position = 4;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

$function = 'my_awesome_page_display';


function my_awesome_page_display() {
   ?>
<div>Use shortcode [unused-files] to see all orphaned files on the website</div>
<div>Use shortcode [external-links] to see all external links coming in to the website</div>
<?php
}



















