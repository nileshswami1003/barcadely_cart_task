$(document).ready(function () {

    // Initialize the cart as an empty object
    // var cart = {};
    

    // updateTotalProductsCount();

    // Fetch categories on page load
    fetchCategories();

    fetchProducts("ALL");

    function fetchCategories() {
        $.ajax({
            url: 'getCategories.php', // Update with your actual server endpoint
            type: 'GET',
            dataType: 'json',
            success: function (categories) {
                // Get the selected category from some source (e.g., a variable or user input)
                var selectedCategory = "ELECTRONICS";

                // Populate categories into the list group
                displayCategories(categories.categories, selectedCategory);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching categories:', error);
            }
        });
    }

    function displayCategories(categories, selectedCategory) {
        var listGroup = $('#categoryList');

        // Clear existing items from the list group
        listGroup.empty();

        // Check if categories array is not empty
        if (categories.length > 0) {
            // Loop through categories and add items to the list group
            $.each(categories, function (index, category) {
                var listItem = '<a href="#" class="list-group-item list-group-item-action">' + category.cat_name + '</a>';

                // Append the new list item to the list group
                listGroup.append(listItem);
            });
        } else {
            // No categories found
            var noCategoriesItem = '<a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">No categories available</a>';
            // Append the item to the list group
            listGroup.append(noCategoriesItem);
        }
    }


    // Fetch products when category link is clicked
    $('#categoryList').on('click', 'a', function () {
        var selectedCategory = $(this).text();
        fetchProducts(selectedCategory);
    });


    function fetchProducts(selectedCategory) {
        $.ajax({
            url: 'getCategoryWiseProducts.php', // Update with your actual server endpoint
            type: 'GET',
            data: { category_name: selectedCategory },
            dataType: 'json',
            success: function (products) {
                // Populate products into the list group
                displayProducts(products);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    function displayProducts(products) {
        var productList = $('#productList');

        // Clear existing items from the list group
        productList.empty();

        // Check if products array is not empty
        if (products.length > 0) {
            // Loop through products and add items to the list group
            $.each(products, function (index, product) {
                var cardHtml =
                '<div class="col-md-6 mb-2">' +
                    '<div class="card">' +
                        '<img src="uploads/' + product.prod_img + '" class="card-img-top" alt="Product Image" style="width:120px;">' +
                        '<div class="card-body">' +
                            '<h5 class="card-title">' + product.prod_name + '</h5>' +
                            '<p class="card-text">Category: ' + product.prod_cat + '</p>' +
                            '<p class="card-text">Price: $' + product.prod_price + '</p>' +
                        '</div>' +
                        '<div class="card-footer">' +
                            '<button class="btn btn-dark btn-sm btn-block" onclick="addToCart(' + product.prod_id + ')">Add to Cart</button>' +
                        '</div>' +
                    '</div>';
                '</div>';

                // Append the new list item to the list group
                productList.append(cardHtml);
            });
        } else {
            // No products found
            var noProductsItem = '<a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">No products available</a>';
            // Append the item to the list group
            productList.append(noProductsItem);
        }
    }

    // Function to update the cart count in the span tag
    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var totalCount = cart.reduce((sum, item) => sum + item.count, 0);
    
        // Update the content of the span tag
        document.getElementById('cartCount').textContent = totalCount;
    }

    // Function to add a product to the cart
    window.addToCart = function (productId, count = 1) {
        // Check if there is an existing cart in local storage
        var cart = JSON.parse(localStorage.getItem('cart')) || {};
        
        // If cart is null or undefined, initialize it as an empty array
        if (!Array.isArray(cart)) {
            cart = [];
        }
        // Check if the product is already in the cart
        var productIndex = cart.findIndex(item => item.productId === productId);

        if (productIndex !== -1) {
            // If the product is already in the cart, update the count
            cart[productIndex].count += count;
        } else {
            // If the product is not in the cart, add it with the specified count
            cart.push({ productId, count });
        }
    
        // Save the updated cart back to local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Retrieve the cart from local storage and log it
        var savedCart = JSON.parse(localStorage.getItem('cart'));
        // console.log(savedCart);
        
        // Update the cart count in the span tag after adding to the cart
        updateCartCount();
    }

    updateCartCount();
});