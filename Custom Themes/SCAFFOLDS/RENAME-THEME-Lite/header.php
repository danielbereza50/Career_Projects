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
      <div class="wrapper">
      <div class="sticky">
         <div class = "pre-header">
            <div class = "show">
               <div class = "headertxt1" style="color: #959595;"><a style="color: #959595;"  href = "https://www.google.com/maps/place/" target="_blank">Address: </a></div>
               <div class = "headertxt2"><a style="color: #959595;" href="tel:410-583-2367">Tel: 410-583-2367</a></div>
               <div class = "headertxt3"><a style="color: #959595;" href="mailto:">Email: </a></div>
            </div>
            <div class = "hide">
               <div class = "navHolder1">
                  <div class="main" id="siteheader">
                     <a href="#menu" class="menu-link active"><span></span> Menu</a>
                     <div id="menu" class="menu">
                        <ul class="level-1">
                           <li><a href="/">test</a></li>
                           <li><a href="/">test</a></li>
                           <li>
                              <a href="/">test</a><span class="has-subnav">&#x25BC;</span>
                              <ul class="level-2">
                                 <li><a href="/">test</a></li>
                                 <li><a href="/">test</a></li>
                                 <li><a href="/">test</a></li>
                              </ul>
                           </li>
                           <li>
                              <a href="/">test</a><span class="has-subnav">&#x25BC;</span>
                              <ul class="level-2">
                                 <li><a href="/">test</a></li>
                                 <li><a href="/">test</a></li>
                              </ul>
                           </li>
                           <li><a href="/">test</a></li>
                        </ul>
                        <?php 
                           //wp_nav_menu(array( 'theme_location' => 'main2-menu',
                             //                'menu_class'     => 'main2-menu',     
                               //        )); 
                            ?>
                     </div>
                  </div>
               </div>
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
