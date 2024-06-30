<?php
/*
    Plugin Name: Cookie Popup
    Plugin URI:  
    Description: Displays popup window based on cookiee.
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/
add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');
    
    wp_enqueue_script('jquery');
    
     wp_register_script( 'main-js', plugins_url('public/js/functions.js',__FILE__ ));
    wp_enqueue_script('main-js');    
}
add_action('wp_head', 'do_popup');
function do_popup(){

global $post;
if( $post->ID == 300) { ?>

<div id="cookiebarBox" class="os-animation" data-os-animation="fadeIn">
    <div class="container risk-dismiss" style="display: block;" >
        <center>
            <div class = "popup-holder">
                <img src="" alt="" class="wp-image-3088" width="512" height="436">
                <figcaption class="padding-popup">$100 off first treatments</figcaption>
                <div class="padding-popup">
                    <a class="wp-block-button__link has-pale-cyan-blue-background-color has-background wp-element-button" href="">Learn More</a>
                </div>
                 <a id="cookieBoxok" class="cookieok" data-cookie="risk"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
        </center>
    </div>
</div>
<?php

} // end of if 

}