var cart = JSON.parse(localStorage.getItem('cart')) || [];
var cartItemsContainer = $('#cartDetails');

// Clear previous content
cartItemsContainer.empty();

// Loop through each item in the cart and append product details
$.each(cart, function(index, item) {
    var productDiv = $('<div>').text('Product ID: ' + item.productId + ', Count: ' + item.count);

    // cartItemsContainer.append(productDiv);
});

// Extract product IDs from the cart
var productIds = cart.map(item => item.productId);

// Call AJAX to get product details based on product IDs
getProductDetails(productIds);


// Function to get product details via AJAX
function getProductDetails(productIds) {
    $.ajax({
      type: 'POST', // Change the HTTP method as needed
      url: 'getCartProductDetails.php', // Replace with your server-side endpoint
      data: { productIds: productIds },
      success: function(response) {
        // Update the content of the product details div
        // console.log(response);
        displayCartProductDetails(response);
        // $('#cartDetails').html(response);
      },
      error: function(error) {
        console.error('Error fetching product details:', error);
      }
    });
}

function displayCartProductDetails(productDetails) {
    var productDetailsContainer = $('#productDetails');
    
    // Clear previous content
    productDetailsContainer.empty();
  
    // Create a table and headers
    var table = $('<table class="table table-bordered">').addClass('product-table');
    var headers = '<tr><th>Product ID</th><th>Name</th><th>Price</th><th>Image</th></tr>';
    // table.append(headers);
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
  
    // Loop through each product detail and append to the table
    $.each(productDetails, function(index, product) {

        var count=0;
        var cartProduct = cart.find(cartItem => cartItem.productId === product.prod_id);
        if (cartProduct) {
            count = cartProduct.count;
            console.log(count);
        }
    
        var row = '<tr><td>' + product.prod_id + '</td><td>' + product.prod_name + '</td><td>' + product.prod_price + '</td><td>uploads/' + product.prod_img + '</td><td>count : ' + count + '</td></tr>';
        table.append(row);

    });
  
    // Append the table to the product details container
    productDetailsContainer.append(table);
}