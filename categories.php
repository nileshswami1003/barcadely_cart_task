<?php
session_start();

// Check if the user is logged in and has the role of an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== '2') {
    // Redirect to the login page with an error message
    header('Location: signin.php?error=' . urlencode('You must be sign-in as an admin to access the admin dashboard.'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
include 'navbar.php';
?>

<div class="container">
    <div class="row mt-2 mb-2">
        <div class="col-md">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h2 class="text-center">Add New Product Category</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="cname" id="cname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Category description</label>
                            <textarea class="form-control" name="cdesc" id="cdesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Category name</label>
                            <select class="form-control" name="sbxCat" id="sbxCat">
                                <option value="1">Active</option>
                                <option value="0">De-active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add" class="btn btn-dark" id="btnCatSubmit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Categories List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="categoriesTable">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- ================================ -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script src="js/scripts.js"></script>
<script src="js/categories.js"></script>

<script>
    
</script>
</body>
</html>