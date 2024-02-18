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

<div class="container-fluid">
    <div class="row mt-2 mb-2">
        <div class="col-md-8">
            <div id="productDetails">
                
            </div>
        </div>
        <div class="col-md-4">

            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h2 class="text-center">Checkout Now</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mobile number</label>
                            <input type="text" name="mobno" id="mobno" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Card number</label>
                            <input type="text" name="cardno" id="cardno" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" name="cvv" id="cvv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Expiry date</label>
                            <input type="text" name="expdate" id="expdate" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Pay now" name="btnCheckout" id="btnCheckout" class="btn btn-success btn-block">
                        </div>
                        
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

<script src="js/main.js"></script>
<script src="js/cart.js"></script>
</body>
</html>