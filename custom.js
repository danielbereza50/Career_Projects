window.onload = function() {
    // Wait for a brief moment before attempting to modify the element
    setTimeout(function() {
        // Find the element with the class 'docapp-variant-options-trigger'
        var element = document.querySelector(".docapp-variant-options-trigger");

        // Check if the element is found
        if (element) {
            // Replace the text content of the element
            element.textContent = "Select Gift Card";
        }

       // Find the checkout button element
      var checkoutButton = document.querySelector('#checkout');
  
      // Attach a click event listener to the checkout button
      checkoutButton.addEventListener('click', function(event) {
  
          // Get all cart item rows
          var cartItemRows = document.querySelectorAll('tr[data-cart-item-id]');
  
          // Loop through cart item rows
          for (var i = 0; i < cartItemRows.length; i++) {
              var cartItemRow = cartItemRows[i];
              var cartItemId = cartItemRow.getAttribute('data-cart-item-id');
              var docappDataCartItem = cartItemRow.getAttribute('data-docapp-data-cart-item');
  
            // alert(cartItemId);
            // Check if the specific cart item is in the cart and has the desired attribute
            // If the default for $10
              if (cartItemId === '46789485920529') {
                  event.preventDefault(); // Prevent the default checkout action
                  alert('Please select a gift card reward - $10');
                  return; // Exit the loop
              }
             // If the default for $20
              if (cartItemId === '46790727270673') {
                  event.preventDefault(); // Prevent the default checkout action
                  alert('Please select a gift card reward - $20');
                  return; // Exit the loop
              }


          


          
        }
    });

      
    }, 100); // Adjust the timeout duration (in milliseconds) as needed
  
};








