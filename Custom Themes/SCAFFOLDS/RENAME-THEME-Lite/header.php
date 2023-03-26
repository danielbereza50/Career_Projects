<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <title>Name</title>
      <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
      <link rel="shortcut icon" href="">
      <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
      <?php wp_head(); ?>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
   </head>
   <body <?php body_class(); ?>> 
	  <?php //echo get_template_directory_uri() . '/images/layer_47.png' ?>
      <div class="wrapper">
      <div class="sticky">
         <div class = "pre-header">
            <div class = "show">
               <div class = "headertxt1" style="color: #959595;"><a style="color: #959595;"  href = "https://www.google.com/maps/place/" target="_blank">Address: </a></div>
               <div class = "headertxt2"><a style="color: #959595;" href="tel:410-583-2367">Tel: 410-583-2367</a></div>
               <div class = "headertxt3"><a style="color: #959595;" href="mailto:">Email: </a></div>
            </div>
            <div class = "hide">
			<div class="hamburger-menu">
			<div class="bar"></div>	
		</div>
		<nav class="mobile-menu">
			<ul>
			  <li><a href="index.html">Home</a></li>
				
			  <li class="has-children">About <span class="icon-arrow"></span>
				<ul class="children">
				  <li><a href="submenu1.html">Submenu #1</a></li>
				  <li><a href="submenu2.html">Submenu #2</a></li>
				  <li><a href="submenu3.html">Submenu #3</a></li>
				</ul>
			  </li>
				
			  <li><a href="blog.html">Blog</a></li>
			  <li><a href="contact.html">Contact</a></li>				
			</ul>    
		</nav>
				<!-- end of nav holder -->
               <div class="headertxt2"><a style="color: #959595;" href="tel:410-583-2367">Tel: 410-583-52367</a></div>
            </div>
            <!-- End of jQuery hamburger plugin -->
         </div>
         <!-- Start of section 1 -->
         <div class = "header_holder">
            <div class = "show">
               <div class = "logo">
                  <a href = "/"><img src="/" class = "theLogo1" alt = ""></a> 
               </div>
            </div>
            <div class = "show">
               <div class = "navHolder">
                  <?php 
                     wp_nav_menu(array( 'theme_location' => 'main-menu',
                                        'menu_class'     => 'main-menu',     
                                 )); 
                     ?>
               </div>
            </div>
            <div class = "clear"></div>
         </div>
         <div class = "hide">
            <div class = "logo">
               <a href = "/"><img src="/" class = "theLogo1" alt = ""></a> 
            </div>
         </div>
      </div>
      <!-- Smart Slider -->
