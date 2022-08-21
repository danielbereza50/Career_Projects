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
      
      
      <!-- jQuery hamburger plugin -->
<!-- 
    Credit goes here:

    https://scripteden.com/download-best-13-mobile-friendly-and-responsive-menus-jquery-plugins-of-2018/  

    https://www.jqueryscript.net/demo/Responsive-Multi-level-Dropdown-Toggle-Menu-Plugin-With-jQuery/

-->
      <!--<script src="https://code.jquery.com/jquery-3.1.0.slim.min.js"></script>-->
      
      <script>
        
        // Multi-Toggle Navigation
jQuery(function() {
  jQuery('body').addClass('js');
    var $menu = jQuery('#menu'),
      $menulink = jQuery('.menu-link'),
      $menuTrigger = jQuery('.has-subnav');

  $menulink.click(function(e) {
    e.preventDefault();
    $menulink.toggleClass('active');
    $menu.toggleClass('active');
  });

  $menuTrigger.click(function(e) {
    e.preventDefault();
    var $this = jQuery(this);
    $this.toggleClass('active').next('ul').toggleClass('active');
  });

});

// Remove "Active" Class from Menu on Resize
jQuery(window).resize(function() {
  var viewportWidth = jQuery(window).width();
    if (viewportWidth > 925) {
      jQuery("#menu").removeClass("active");
    }
});

        </script>
      <style>
      /* Hamburger styles */



a.menu-link {
  color: #000;
  display: block;
  text-decoration: none;
}

.menu-link span {
  border-bottom: solid 3px #000;
  border-top: double 10px #000;
  display: inline-block;
  height: 4px;
  margin: 0 5px -3px 0;
  width: 30px;
}

.menu-link:hover span { border-color: #666; }

.menu, .menu > ul, .menu > ul ul {
  clear: both;
  display: flex;
  flex-flow: column;
  margin: 0;
}

.menu.active {
  background: #f9f9f9;
  border-bottom: 1px solid #d8d8d8;
  border-top: 1px solid #d8d8d8;
  margin: 1em 0 1em -12px;
  max-height: 55em;
  width: 100vw;
}

.js .menu > ul ul.active {
  margin: 0;
  max-height: 55em;
  padding: 0;
}

.menu > ul { padding: 0; }

nav li {
  display: inline-block;
  margin: 0;
  position: relative;
}

.menu li a {
  color: #000;
  display: inline-block;
  font-size: 1.04em;
  letter-spacing: .05em;
  line-height: 2.5em;
  text-decoration: none;
}

span.has-subnav {
  display: block;
  font-size: 1em;
  line-height: 2.5em;
  position: absolute;
  right: 20px;
  padding: 0 0.5em;
  top: 0;
  cursor: pointer;
}
 @media screen and (max-width:900px) {

.menu,  .menu > ul ul {
  margin: 0;
  max-height: 0;
  overflow: hidden;
}

.menu li a {
  border-bottom: 1px solid #d8d8d8;
  display: block;
  padding-left: 15px;
}

.menu li li a { padding-left: 50px; }

.menu li:last-child a { border: none; }

.menu li li:last-child a { border-bottom: 1px solid #d8d8d8; }

.menu li:hover { background: #EDEDED; }
}
/*
@media screen and (min-width: 801px) {

nav {
  border-top: 3px solid #00578b;
  border-bottom: 1px solid #a4d05e;
}

a.menu-link { display: none; }

.js .menu,  .js .menu > ul ul {
  max-height: none;
  overflow: visible;
}

.js .menu > ul li:hover > ul { display: flex; }

.menu ul {
  display: flex;
  flex-flow: row;
  height: 44px;
  justify-content: space-between;
  margin: 0;
  padding: 0;
}

.menu span.has-subnav { display: none; }

.menu li a:hover { color: rgb(164,208,94); }

.menu li li a:hover {
  background: rgba(164,208,94,0.1);
  color: #000;
}

.menu ul ul {
  background: #fff;
  border: solid 1px rgba(164,208,94,1);
  border-radius: 2px 2px 5px 5px;
  border-top: solid 2px transparent;
  display: none;
  height: auto;
  overflow: hidden;
  padding: 0;
  position: absolute;
  text-align: left;
  top: 43px;
  width: 150px;
  z-index: 999;
}

.chrome .js .menu > ul ul { top: 43px; }

.menu ul ul.wide { width: 300px; }

.menu ul ul li {
  border-bottom: solid 1px rgba(164,208,94,0.5);
  display: inline-block;
  position: relative;
}

.menu > ul ul li:last-child { border-bottom: none; }

.menu ul ul li a {
  display: block;
  padding-left: 10px;
}
}

*/




/* End of Hamburger Styles */
      </style>
      
      
      <div class = "hide">
              <div class = "navHolder1">
            
          
            <div class="main" id="siteheader">
  <a href="#menu" class="menu-link active"><span></span> Menu</a>
  <div id="menu" class="menu">
    
   <ul class="level-1">
      <li><a href="/">test</a></li>
      <li><a href="/">test</a></li>
      
      <li><a href="/">test</a><span class="has-subnav">&#x25BC;</span>
    
        <ul class="level-2">
          <li><a href="/">test</a></li>
          <li><a href="/">test</a></li>
          <li><a href="/">test</a></li>
        </ul>
        
      </li>
      
      <li><a href="/">test</a><span class="has-subnav">&#x25BC;</span>
    
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

<script>
  
         var stickyOffset = jQuery('.sticky').offset().top;
         
         jQuery(window).scroll(function(){
         
          var sticky = jQuery('.sticky'),
              scroll = jQuery(window).scrollTop();
         
         
          if (scroll >= stickyOffset) sticky.addClass('fixed');
          else sticky.removeClass('fixed');
         
        if (scroll <= stickyOffset) sticky.removeClass('fixed');
          else sticky.addClass('fixed');
                 
         });  
  
jQuery(document).ready(function() {
  
  jQuery('.emd_dl_blue_three').html('Download Assessment Forms');
  jQuery('.emd_dl_blue_three').css({ 'background-color': '#266593'});

  
  
  
})
  
  </script>
      
      <!-- Smart Slider -->
      
            
      
      
      
      