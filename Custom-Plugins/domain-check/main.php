<?php
/*
    Plugin Name: Domain Popup
    Plugin URI:  
    Description: Displays popup window based on domain name.
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
add_action('wp_head', 'check_domain');
function check_domain(){

    $domain = get_bloginfo('url');


    if($domain == 'https://domain.com'){ ?>

<style>
#cookiebar .container {
  background-color: #696057;
}

#cookiebarBox .container {
  background-color: #696057;
}
</style>

<!--
	<div id="cookiebarBox" class="os-animation" data-os-animation="fadeIn" >

   	 <div class="container risk-dismiss" style="display: block;" >

        <p>Like most websites, this site uses cookies to assist with navigation and your ability to provide feedback, analyse your use of products and services so that we can improve them, assist with our personal promotional and marketing efforts and provide consent from third parties.</p>

            <a id="cookieBoxok" class="cookieok" data-cookie="risk">OK</a>

   	 </div>

	</div>
-->
<?php

} // end of if 

if($domain == 'https://domain.com'){ ?>

<style>
#cookiebar .container {
  background-color: #bd2d28;
}

#cookiebarBox .container {
  background-color: #bd2d28;
}
	</style>
<!--
	<div id="cookiebarBox" class="os-animation" data-os-animation="fadeIn" >

   	 <div class="container risk-dismiss" style="display: block;" >

        <p>Like most websites, this site uses cookies to assist with navigation and your ability to provide feedback, analyse your use of products and services so that we can improve them, assist with our personal promotional and marketing efforts and provide consent from third parties.</p>

            <a id="cookieBoxok" class="cookieok" data-cookie="risk">OK</a>

   	 </div>
	</div>
-->

    <?php }// end of if 
}