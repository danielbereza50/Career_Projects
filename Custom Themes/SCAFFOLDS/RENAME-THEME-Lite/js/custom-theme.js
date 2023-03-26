// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    
       console.log( "ready!" );

	
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

	    var stickyOffset = jQuery('.sticky').offset().top;
         
         jQuery(window).scroll(function(){
         
          var sticky = jQuery('.sticky'),
              scroll = jQuery(window).scrollTop();
         
         
          if (scroll >= stickyOffset) sticky.addClass('fixed');
          else sticky.removeClass('fixed');
         
        if (scroll <= stickyOffset) sticky.removeClass('fixed');
          else sticky.addClass('fixed');
                 
         });  
	

	
	
	
});
