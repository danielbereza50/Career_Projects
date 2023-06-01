jQuery( document ).ready(function($) {

	console.log('hello');
	
	$body = $("body");

	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		 ajaxStop: function() { $body.removeClass("loading"); }    
	});
	
	 $('#course-category').change(function() {
		 call_ajax(1);
		 });
// 	$('.page-numbers').click(function() {
// 		 call_ajax();
// 		 });
	$('a.page-numbers').click(function() { 
    var id = $(this).attr('href');
    //alert(id.slice(-2)[0]);
    call_ajax(id.slice(-2)[0]);
     });
	
	// $("#professionals-form").submit(function(event){
	function call_ajax(current_page){
		event.preventDefault();
		 
		//var current_page = 1;
		//console.log(current_page);
		var ccategory = jQuery("#course-category").val();
		// Initialize the current page number variable
	
		 
		jQuery.ajax({
			url: al.ajaxurl,
			type: 'post',
			data: {
				action: 'data_fetch',
				ccategory: ccategory,
				current_page: current_page,
			},
			success: function(data) {
				jQuery('#results').html(data);
				$('a.page-numbers').click(function() { 
				var id = $(this).attr('href');
				call_ajax(id.slice(-2)[0]);	
				 });
			//	alert(professional);
			},
			 error: function(data) { 
				//alert('ffffffff');
			}  
		});
	}
	$('#clear').click(function() {
		//alert('ffffff');
		location.reload();
	 });
	

	
	
	
	
	
	
	
	
});



