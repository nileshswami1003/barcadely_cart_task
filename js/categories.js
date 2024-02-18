$(document).ready(function () {

    // Initial display of categories
    displayCategories();

    // FETCH ALL CATEGORIES PROCESS START =============================
    function displayCategories() {
        $.ajax({
            type: "GET",
            url: "getCategories.php",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Clear existing table rows
                    $("#categoriesTable tbody").empty();
                    var count=0;
                    // Add new rows
                    $.each(response.categories, function (index, category) {
                        var row = "<tr>" +
                            // "<td>" + category.cat_id + "</td>" +
                            "<td>" + (++count) + "</td>" +
                            "<td>" + (category.cat_name) + "</td>" +
                            // "<td>" + category.cat_status + "</td>" +
                            "<td>" + (category.cat_status == 1 ? "Active" : "De-active") + "</td>" +
                            "<td><button class='btn btn-primary btn-sm' onclick='editCategory(" + category.cat_id + ")'>Edit</button></td>" +
                            "</tr>";

                        $("#categoriesTable tbody").append(row);
                    });
                } else {
                    console.log('Error fetching categories: ' + response.message);
                }

                // Destroy existing DataTable before reinitializing
                if ($.fn.DataTable.isDataTable('#categoriesTable')) {
                    $('#categoriesTable').DataTable().destroy();
                }

                // Initialize DataTable on category table with customized show entries options
                $('#categoriesTable').DataTable({
                    "order": [[0, "asc"]], // Set the default sorting by the first column (change as needed)
                    "paging": true, // Enable paging
                    "lengthMenu": [5, 10, 25, 50], // Set custom show entries options
                    "pageLength": 5, // Set the default number of rows per page
                    "searching": true, // Enable searching
                    "info": true // Show information
                });


            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
            }
        });
    }
    // FETCH ALL CATEGORIES PROCESS END ===============================
    // ADD NEW CATEGORY PROCESS START =================================
    $("#btnCatSubmit").click(function (event) {
        event.preventDefault(); // Prevent the default form submission
        addCategory();
    });
    // ADD NEW CATEGORY PROCESS END ===================================
    function addCategory() {
        var categoryName = $("#cname").val();
        var categoryDesc = $("#cdesc").val();
        var categoryStatus = $("#sbxCat").val();

        var formData = {
            cname: categoryName,
            cdesc: categoryDesc,
            sbxCat: categoryStatus
        };

        $.ajax({
            type: "POST",
            url: "addCategory.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Category added successfully
                    alert('Category added successfully!');
                    // You can also update UI or perform other actions
                    displayCategories();
                } else {
                    // Error adding category
                    alert('Error adding category: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
            }
        });
    }

    // EDIT CATEGORY PROCESS START ====================================
    window.editCategory = function (categoryId) {
        // Fetch category details for editing
        $.ajax({
            type: "GET",
            url: "getCategory.php?categoryId=" + categoryId,
            dataType: "json",
            success: function (category) {
                // Populate form fields with category details
                $("#cname").val(category.cat_name);
                $("#cdesc").val(category.cat_desc);
                $("#sbxCat").val(category.cat_status);

                // Modify the submit button to act as an update button
                $("#btnCatSubmit").val("Update").off("click").on("click", function (event) {
                    event.preventDefault();
                    updateCategory(categoryId);
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
            }
        });
    }
    // EDIT CATEGORY PROCESS END ======================================

    // UPDATE CATEGORY PROCESS START ==================================
    function updateCategory(categoryId) {
        var categoryName = $("#cname").val().trim();
        var categoryDesc = $("#cdesc").val().trim();
        var categoryStatus = $("#sbxCat").val();

        var formData = {
            categoryId: categoryId,
            cname: categoryName,
            cdesc: categoryDesc,
            sbxCat: categoryStatus
        };

        $.ajax({
            type: "POST",
            url: "updateCategory.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert('Category updated successfully!');
                    displayCategories(); // Fetch and update category list
                    clearCategoryForm(); // Clear the form
                } else {
                    alert('Error updating category: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status, error);
            }
        });
    }
    // UPDATE CATEGORY PROCESS END ====================================

    // CLEAR CATEGORY FORM FIELDS START ===============================
    function clearCategoryForm(){
        // Clear the form fields
        $("#cname").val("");
        $("#cdesc").val("");
        $("#sbxCat").val("1"); // Set default status to Active

        // Reset the submit button text to "Add"
        $("#btnCatSubmit").text("Add").off("click").on("click", function () {
            addCategory();
        });
    }
    // CLEAR CATEGORY FORM FIELDS END ===============================

});