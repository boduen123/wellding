<?php
include("./includes/connect.php");
include("./functions/common_functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ubukwe digital</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.css" />
  <link rel="stylesheet" href="./assets/css/main.css" />
  <style>
    body {
      background: #f8f9fa;
      font-family: "Segoe UI", Tahoma, sans-serif;
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

    .navbar {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand {
      font-size: 22px;
      color: #007bff !important;
    }

    .navbar .nav-link {
      font-weight: 500;
    }

    .navbar .nav-link.active {
      color: #007bff !important;
    }

    .product-card {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
      height: 100%;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .product-card img {
      max-height: 200px;
      object-fit: cover;
    }

    .product-card .card-body {
      padding: 15px;
    }

    .product-card h6 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .product-card p {
      font-size: 14px;
      color: #6c757d;
    }

    .product-price {
      font-size: 16px;
      font-weight: bold;
      color: #007bff;
    }

    .btn-view {
      background: #6c757d;
      color: #fff;
      font-size: 13px;
    }

    .btn-view:hover {
      background: #5a6268;
      color: #fff;
    }

    .btn-cart {
      background: #28a745;
      color: #fff;
      font-size: 13px;
    }

    .btn-cart:hover {
      background: #218838;
      color: #fff;
    }

    .categ-header .title {
      color: #007bff;
      font-weight: bold;
      margin-left: 5px;
    }

    .categ-header h2 {
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <!-- upper-nav -->
  <div class="upper-nav p-2 px-3 text-center text-break">
    <span>ubukwe nicyimwe mubikorwa byiza niba ushaka ubukwe bwiza turakumenyera burikimwe gikenera mubukwe <a href="#">Shop Now</a></span>
  </div>
  <!-- upper-nav -->

  <!-- Start NavBar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">A1</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="./products.php">Products</a></li>
          
          <li class="nav-item"><a class="nav-link" href="contact.htm">Contact</a></li>

          <!-- Dropdown Brands -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold" href="#" id="brandsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Brands
            </a>
            <ul class="dropdown-menu" aria-labelledby="brandsDropdown">
              <?php getBrands(); ?>
            </ul>
          </li>

          <!-- Dropdown Categories -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
              <?php getCategories(); ?>
            </ul>
          </li>

          <?php
            if(isset($_SESSION['username'])){
              echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>";
            } else {
              echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
            }
          ?>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- End NavBar -->

  <!-- Start All Products -->
  <div class="all-prod">
    <div class="container">
      <div class="sub-container pt-4 pb-4">
        <div class="categ-header">
          <div class="sub-title">
            <span class="shape"></span>
            <span class="title">Categories & Brands</span>
          </div>
          <h2>Browse By Category & Brand</h2>
        </div>
        <div class="row mx-0">
          <!-- Products -->
          <div class="col-12">
            <div class="row g-4">
              <?php
                getProduct();
                filterCategoryProduct();
                filterBrandProduct();
                $ip = getIPAddress();
                cart();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Products -->

  <script src="./assets/js/bootstrap.bundle.js"></script>
</body>
</html>
