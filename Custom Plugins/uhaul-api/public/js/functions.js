jQuery(document).ready(function($){
	console.log('Hello World!');
	
	$("select#unitType").change(function(){
       var selectedOption = $(this).val();
       if (selectedOption === 'driveupstorage') {
         window.location.href = '#drive-up';
       }
		if (selectedOption === 'uboxContainers') {
       	 window.location.href = '#portable';
       }
    });
	$("select#unitSize").change(function(){
       var selectedOption = $(this).val();
       if (selectedOption === 'small') {
   			 $('[id="medium"]').hide();
		     $('[id="small"]').show();
       }
	   if (selectedOption === 'medium') {
   			 $('[id="small"]').hide();
			 $('[id="medium"]').show();
       }
	  if (selectedOption === 'any') {
   			 $('[id="small"]').show();
			 $('[id="medium"]').show();
       }
    });
	

	
	
	
	
	
	
	
	
	
	
});	