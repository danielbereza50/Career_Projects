// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    
    console.log( "hello world!" );
	
	(function () {
		$('.hamburger-wrapper').on('click', function() {
			$('.hamburger-menu').toggleClass('animate');
			$('.mobile-menu-overlay').toggleClass('visible');
		})
		$('.mobile-menu-overlay > ul > li > a').on('click', function () {
			$('.hamburger-menu').removeClass('animate');
			$('.mobile-menu-overlay').removeClass('visible');
		})
	})();
	
	//$("#dashboard-area").hide();
	$("#switch-url-area").hide();
	$("#add-url-area").hide();
	$("#settings-area").hide();

	$("#dashboard").click(function(){
		$("#dashboard-area").show();
		$("#switch-url-area").hide();
		$("#add-url-area").hide();
		$("#settings-area").hide();
	}); 
	$("#switch-url").click(function(){
		$("#dashboard-area").hide();
		$("#switch-url-area").show();
		$("#add-url-area").hide();
		$("#settings-area").hide();
	}); 
	$("#add-url").click(function(){
		$("#dashboard-area").hide();
		$("#switch-url-area").hide();
		$("#add-url-area").show();
		$("#settings-area").hide();
	}); 
	$("#settings").click(function(){
		$("#dashboard-area").hide();
		$("#switch-url-area").hide();
		$("#add-url-area").hide();
		$("#settings-area").show();
	}); 
	jQuery('nav.mobile-menu').on('click', function() {
	 if (jQuery(this).hasClass('clicked')) {
	   $(this).removeClass('clicked');
	  }else{
	   $(this).addClass('clicked');
	  }
	});
	jQuery('#gform_submit_button_3').on('click', function() {
		alert('Thanks for contacting us! We will get in touch with you shortly.');
	});
	$(window).resize(function(){
	  drawChart();
	});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});