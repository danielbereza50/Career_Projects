document.addEventListener('DOMContentLoaded', function () {
  const registryButton = document.querySelector('.registry-button');

  if (registryButton) {
    registryButton.addEventListener('click', function () {
      const productId = 8217646235966; // Example product ID
      const customerId = 1111; // Example customer ID
      
      const isLoggedIn = window.Shopify && Shopify.customer ? true : false;
      console.log('Product ID:', productId);
      console.log('Customer ID:', customerId);
      console.log('Is Logged In:', isLoggedIn);

      // Send the productId and customerId to the backend to update metafield
      updateProductMetafield(productId, customerId);
    });
  }

  // Function to update the product metafield with customer data
  function updateProductMetafield(productId, customerId) {
    const metafieldData = {
      productId: productId,
      customerId: customerId,
    };

    console.log('Sending metafield data:', metafieldData);

    // Call the backend to update the metafield
    fetch('https://shopify-proxy-app.onrender.com/update-metafield', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(metafieldData),
    })
    .then(response => response.json())  // Parse the JSON response from the backend
    .then(data => {
      console.log('Metafield updated successfully:', data);
      alert('Product registered successfully!');
    })
    .catch(error => {
      console.error('Error updating metafield:', error);
      alert('An error occurred while registering this product.');
    });
  }
});
