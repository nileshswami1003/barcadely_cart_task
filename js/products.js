$(document).ready(function () {
    function validateForm() {
        // Validation logic for each form field
        var productName = $("#pname").val();
        var categoryId = $("#sbxCat").val();
        var productPrice = $("#pprice").val();
        var productImage = $("#pimage").val();

        // Regular expression for a valid double type value
        var doubleRegex = /^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/;

        // Check for empty fields
        if (productName.trim() === '' || categoryId === '' || productPrice.trim() === '' || productImage.trim() === '') {
            alert('Please fill in all fields.');
            return false;
        }

        // Check if productPrice is a valid double type value
        if (!doubleRegex.test(productPrice)) {
            alert('Please enter a valid price.');
            return false;
        }

        // Validate image type (PNG or JPG)
        var allowedImageTypes = ['png', 'jpg'];
        var fileExtension = productImage.split('.').pop().toLowerCase();
        if ($.inArray(fileExtension, allowedImageTypes) === -1) {
            alert('Invalid image type. Please select a PNG or JPG image.');
            return false;
        }

        // Validation passed
        return true;
    }

    $('#pimage').on('change', function () {
        var fileInput = $(this)[0];
        if (fileInput.files.length > 0) {
            var timestamp = new Date().getTime();
            var fileName = timestamp + '_' + fileInput.files[0].name;
            // Display the updated file name (optional)
            console.log('Updated File Name:', fileName);
            // You can save the updated file name in a hidden input field if needed
            $('#updatedFileName').val(fileName);
        }
    });

    // AJAX function to submit form data
    $("#btnAddProduct").on("click", function (event) {
        event.preventDefault();
        // Serialize form data

        if(validateForm()){
            var formData = new FormData($("#addProductForm")[0]);

            $.ajax({
                url: 'addProduct.php', // Update with your actual server endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle the response, e.g., display a success message
                    console.log(response);
                    if(response.success){
                        alert(response.message);
                        fetchProductData();
                    } else {
                        alert(response.message);
                    }
                    // Optionally, reset form fields
                    $("#addProductForm")[0].reset();
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., display an error message
                    console.error('Error adding product:', error);
                }
            });
        } 
        
    });


    // Fetch product data on page load
    fetchProductData();

    function fetchProductData() {
        $.ajax({
            url: 'getProducts.php', // Update with your actual server endpoint
            type: 'GET',
            dataType: 'json',
            success: function (products) {
                // Display products in the HTML table
                displayProducts(products);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    function displayProducts(products) {
        var tableBody = $('#productTableBody');

        // Clear existing rows from the table
        tableBody.empty();
        var count=0;
        // Check if products array is not empty
        if (products.length > 0) {
            // Loop through products and add rows to the table
            $.each(products, function (index, product) {
                var row = '<tr>' +
                    '<td>' + (++count) + '</td>' +
                    '<td>' + product.prod_name + '</td>' +
                    '<td>' + product.cat_name + '</td>' +
                    '<td>' + product.prod_price + '</td>' +
                    '<td>' + (product.prod_status == 1 ? "Active" : "De-Active")  + '</td>' +
                    '<td>' + product.prod_id  + '</td>' +
                    '</tr>';

                // Append the new row to the table
                tableBody.append(row);
            });

            // Initialize DataTable
            $('#productTable').DataTable({
                "order": [[0, "asc"]], // Set the default sorting by the first column (change as needed)
                "paging": true, // Enable paging
                "lengthMenu": [5, 10, 25, 50], // Set custom show entries options
                "pageLength": 5, // Set the default number of rows per page
                "searching": true, // Enable searching
                "info": true // Show information
            });

        } else {
            // No products found
            var noProductsRow = '<tr><td colspan="4">No products found</td></tr>';
            tableBody.append(noProductsRow);
        }
    }



// Fetch category data on page load
    fetchCategoryData();

    function fetchCategoryData() {
        $.ajax({
            url: 'getCategories.php', // Update with your actual server endpoint
            type: 'GET',
            dataType: 'json',
            success: function (categories) {
                console.log(categories.categories);
                // Populate categories in the dropdown or other HTML element
                populateCategories(categories.categories);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching categories:', error);
            }
        });
    }

    function populateCategories(categories) {
        var categoryDropdown = $('#sbxCat');

        // Clear existing options from the dropdown
        categoryDropdown.empty();

        // Check if categories array is not empty
        if (categories.length > 0) {
            // Loop through categories and add options to the dropdown
            $.each(categories, function (index, category) {
                var option = '<option value="' + category.cat_id + '">' + category.cat_name + '</option>';
                // Append the new option to the dropdown
                categoryDropdown.append(option);
            });
        } else {
            // No categories found
            var noCategoriesOption = '<option value="">No categories found</option>';
            categoryDropdown.append(noCategoriesOption);
        }
    }

});
