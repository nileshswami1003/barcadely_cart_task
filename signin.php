<?php
session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == '1') {
    // Redirect to the login page with an error message
    header('Location: customerDashboard.php');
}
else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == '2') {
    // Redirect to the login page with an error message
    header('Location: adminDashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
include 'navbar.php';
?>

<div class="container">
    <div class="row mt-2 mb-2">
        <div class="offset-2 col-md-8">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h2 class="text-center">Signin Here</h2>
                    </div>
                    <div class="card-body">
                    <?php
                    // Display error message if available in the URL parameter
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
                    } else if (isset($_GET['message'])) {
                        echo '<div class="alert alert-info">' . htmlspecialchars($_GET['message']) . '</div>';
                    }
                    ?>
                        <div class="form-group">
                            <label>Email id</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="pass" id="pass" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <input type="submit" value="Signin" class="btn btn-dark" id="btnSinginSubmit">
                            <span>
                                Don't have account? <a href="signup.php">Click here to sign-up</a>
                            </span>
                        </div>
                        <div id="formMessage" class="mt-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- ================================ -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="js/signin.js"></script>
</body>
</html>