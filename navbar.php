<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    Cart Application
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php
// session_start();

// Check if the user is logged in and has the role of an admin
if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == '1') {
    // CUSTOMER NAVBAR
?>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="customerDashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Cart <span class="cart-count" id="cartCount">0</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="signout.php">Sign-out</a>
      </li>
    </ul>
  </div>

<?php
}
else if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == '2') {
  //ADMIN NAVBAR
  ?>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="adminDashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="signout.php">Sign-out</a>
      </li>
    </ul>
  </div>

  <?php
} else {
?>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="index.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="signin.php">Sign-in</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="signup.php">Sign-up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="cart.php">Cart <span class="cart-count" id="cartCount">0</span></a>
      </li>
    </ul>
  </div>
<?php
}
?>
</nav>