# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   

    
In this example, we're using the Liquid for loop to iterate over a collection of products (collections.all.products). For each product, we're outputting a div with a class of product-card that contains a link to the product's URL, an image of the product's featured image, the product's title, and the product's price formatted as currency using the money filter.

This is just one example of how you can use Liquid to create dynamic content in your Shopify store. Liquid provides a wide range of features and functionality that allow you to create custom templates, layouts, and snippets to display your products, collections, and other store data in a way that meets your unique needs.

    Liquid Syntax: 
    
    {% for product in collections.all.products %}
      <div class="product-card">
        <a href="{{ product.url }}">
          <img src="{{ product.featured_image.src }}" alt="{{ product.featured_image.alt }}">
          <h3>{{ product.title }}</h3>
          <p>{{ product.price | money }}</p>
        </a>
      </div>
    {% endfor %}






