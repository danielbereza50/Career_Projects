jQuery( document ).ready(function($) {
	 $('#state, #expertise').change(function() {
	// $("#professionals-form").submit(function(event){
		event.preventDefault();
		 
		var state = jQuery("#state").val();
		var expertise = jQuery("#expertise").val();
		var professional = jQuery("#professional").val();
		
		console.log(state);
		console.log(expertise);
		console.log(professional);
		 
		jQuery.ajax({
			url: al.ajaxurl,
			type: 'post',
			data: {
				action: 'data_fetch',
				state: state, 
				expertise: expertise, 
				professional: professional, 
			},
			success: function(data) {
				jQuery('#results').html( data );
			//	alert(professional);
			},
			 error: function(data) { 
				//alert('ffffffff');
			}   
		});
	});
	$('#professional').keyup(function() {
	// $("#professionals-form").submit(function(event){
		event.preventDefault();
		 
		var state = jQuery("#state").val();
		var expertise = jQuery("#expertise").val();
		var professional = jQuery("#professional").val();
		
		console.log(state);
		console.log(expertise);
		console.log(professional);
		 
		jQuery.ajax({
			url: al.ajaxurl,
			type: 'post',
			data: {
				action: 'data_fetch',
				state: state, 
				expertise: expertise, 
				professional: professional, 
			},
			success: function(data) {
				jQuery('#results').html( data );
			//	alert(professional);
			},
			 error: function(data) { 
				//alert('ffffffff');
			}   
		});
	});
	$('#clear').click(function() {
		//alert('ffffff');
		location.reload();
	 });
	

	
	
	
	
	
	
});



