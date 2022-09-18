// https://wordpress.stackexchange.com/questions/330117/return-conditional-category-in-load-posts-by-ajax
var page = 2;
jQuery(function($) {
//	$(window).on('scroll', function(){
    $('body').on('click', '.loadmore', function() {
		var $button = jQuery( this );
		var category = $button.data( 'category' ); // <-- Important bit.
		console.log(category);
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': blog.security,
			'category': category, // <-- Important bit.
        };

		$(".loadmore").html('<button class = "loader">Loading...</div>'); 
		$('.loader').css("background","#BB722B");
		$('.loader').css("color","white");
		$('.loader').css("width","30%");
		
        $.post(blog.ajaxurl, data, function(response) {
            if($.trim(response) != '') {
                $('.blog-posts').append(response);
                page++;
				$(".loadmore").html('<button class = "load_more">Load More</div>');
				$('.load_more').css("width","30%");
				$('.load_more').css("background","#744219");
				$('.load_more').css("color","white")
				
            } else {
                $(".loadmore").html('<button class = "no_more">No more results</div>');
				$('.no_more').css("width","30%");
				 $('.no_more').css("background","#BB722B");
				$('.no_more').css("color","white")
            }
        });
    });
	//});
});