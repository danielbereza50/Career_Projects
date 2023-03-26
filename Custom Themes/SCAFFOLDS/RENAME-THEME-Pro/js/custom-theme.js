// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    
       console.log( "ready!" );

	    var stickyOffset = jQuery('.sticky').offset().top;
         
         jQuery(window).scroll(function(){
         
          var sticky = jQuery('.sticky'),
              scroll = jQuery(window).scrollTop();
         
         
          if (scroll >= stickyOffset) sticky.addClass('fixed');
          else sticky.removeClass('fixed');
         
        if (scroll <= stickyOffset) sticky.removeClass('fixed');
          else sticky.addClass('fixed');
                 
         });  

	   $('.hamburger-menu').on('click', function() {
			$('.bar').toggleClass('animate');
		$('.mobile-menu').toggleClass('active');
			 return false;
		})
	  $('.has-children').on ('click', function() {
			   $(this).children('ul').slideToggle('slow', 'swing');
		   $('.icon-arrow').toggleClass('open');
	  });
	
	
	
	
	
	
	
	
	
});
