<?php
include("../includes/connect.php");
include("../functions/common_functions.php");
session_start();
if(!isset($_SESSION['username'])){
    header('location:user_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION['username'];?> Profile</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <style>
    body {
      background: #f5f7fa;
      font-family: "Segoe UI", sans-serif;
    }
    .upper-nav {
      background: #007bff;
      color: #fff;
      font-size: 14px;
    }
    .upper-nav a {
      color: yellow;
      font-weight: 600;
    }
    .side-nav {
      background: #fff;
      border-radius: 12px;
      padding: 20px 0;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      height: 100%;
    }
    .side-nav img.img-profile {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto 15px;
      display: block;
    }
    .side-nav h6 {
      margin: 0;
      font-size: 15px;
      font-weight: 600;
    }
    .side-nav .nav-link {
      padding: 12px 18px;
      font-weight: 500;
      color: #333;
      border-radius: 8px;
      margin: 4px 12px;
      transition: all 0.3s ease;
    }
    .side-nav .nav-link:hover,
    .side-nav .nav-link.active {
      background: #007bff;
      color: #fff !important;
    }
    .profile-header {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #007bff;
    }
    .content-box {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      min-height: 400px;
    }
  </style>
</head>
<body>
  <!-- upper-nav -->
  <div class="upper-nav p-2 px-3 text-center text-break">
    <span>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a href="#">Shop Now</a></span>
  </div>

  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">A1</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="../products.php">Products</a></li>
          
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item"><a class="nav-link active" href="profile.php">My Account</a></li>
        </ul>
        <form class="d-flex me-3" action="../search_product.php">
          <input class="form-control me-2" type="search" placeholder="Search">
          <button class="btn btn-outline-primary">Search</button>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="../cart.php">Cart (<?php cart_item(); ?>)</a></li>
          <li class="nav-item">
            <?php
              if(!isset($_SESSION['username'])){
                echo "<a class='nav-link' href='user_login.php'>Login</a>";
              }else{
                echo "<a class='nav-link' href='logout.php'>Logout</a>";
              }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Profile Section -->
  <div class="container my-5">
    <div class="row">
      <!-- SideNav -->
      <div class="col-md-3">
        <div class="side-nav">
          <?php
            $username = $_SESSION['username'];
            $select_user_img = "SELECT * FROM `user_table` WHERE username='$username'";
            $result = mysqli_query($con,$select_user_img);
            $row = mysqli_fetch_array($result);
            $userImg = $row['user_image'];
            echo "<img src='./user_images/$userImg' alt='$username photo' class='img-profile' />";
          ?>
          <ul class="navbar-nav">
            <li><a href="profile.php" class="nav-link fw-bold">Pending Orders</a></li>
            <li><a href="profile.php?edit_account" class="nav-link fw-bold">Edit Account</a></li>
            <li><a href="profile.php?my_orders" class="nav-link fw-bold">My Orders</a></li>
            <li><a href="profile.php?delete_account" class="nav-link fw-bold">Delete Account</a></li>
            <li><a href="logout.php" class="nav-link fw-bold">Logout</a></li>
          </ul>
        </div>
      </div>
      <!-- Main Content -->
      <div class="col-md-9">
        <div class="content-box">
          <div class="profile-header">Welcome, <?php echo $_SESSION['username'];?> 👋</div>
          <?php
            get_user_order_details();
            if(isset($_GET['edit_account'])){
              include('./edit_account.php');
            }
            if(isset($_GET['my_orders'])){
              include('./user_orders.php');
            }
            if(isset($_GET['delete_account'])){
              include('./delete_account.php');
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>
