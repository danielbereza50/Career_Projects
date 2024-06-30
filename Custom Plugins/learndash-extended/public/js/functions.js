jQuery( document ).ready(function($) {

	console.log('111111');
	
	jQuery(".course-wrapper-topics p").css('display', 'none');
	
	 $("div[id^='course-wrapper']").click(function() {
    	$(this).find("p").toggle();
		 
  });
	

	
	
	
	
	
	
	
	
	
});