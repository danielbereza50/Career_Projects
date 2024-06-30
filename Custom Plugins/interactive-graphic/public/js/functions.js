// A $( document ).ready() block.
jQuery( document ).ready(function($) {

	//var inputList = document.querySelectorAll("[id^='patientName']");
    
    console.log("ready!");

    $(".service-item").mouseenter(function() {
        $(".service-item").removeClass("active"); // Remove active class from all items
        $(this).addClass("active"); // Add active class to the clicked item

        var dataIndex = $(this).data("image-index"); 
        console.log("Clicked item index:", dataIndex);

        // Update the image source based on the clicked index
        var newImageUrl = featuredImageBase + dataIndex;
        $("#featured-service-image").attr("src", newImageUrl);
		
		
		
		
		
		
    });
	

	
	
	
	
	
});