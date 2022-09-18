jQuery( document ).ready(function() {

	jQuery('#filter').change(function() {
		var filter = jQuery("#filter").val();


		jQuery.ajax({
			url: al.ajaxurl,
			type: 'post',
			data: {
				action: 'data_fetch',
				filter: filter, 
			},
			success: function(data) {
				jQuery('#replace').html( data );
			}
		});


	});
});
