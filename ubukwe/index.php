<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ubukwe system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    /* Whole page background */
    body {
      background-color: #fff0f5; /* Light pink background */
    }

    .upper-nav {
      background: #d63384; /* Bootstrap pink */
      color: #fff;
      font-size: 14px;
    }

    .upper-nav a {
      color: yellow;
      text-decoration: underline;
    }

    .categories-sidebar {
      background-color: #fff5e6; /* Light peach for sidebar */
      border-radius: 6px;
    }

    .categories-sidebar ul li {
      padding: 10px 5px;
      border-bottom: 1px solid #f1f1f1;
      cursor: pointer;
    }

    .categories-sidebar ul li:hover {
      color: #d63384;
    }

    .banner-box {
      background: linear-gradient(to right, #ff758c, #ff7eb3); /* Wedding theme gradient */
      min-height: 300px;
      border-radius: 8px;
      padding: 50px;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .banner-box h2 {
      font-weight: bold;
    }

    .category-card {
      transition: all 0.3s;
      cursor: pointer;
    }

    .category-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body><!-- upper-nav -->
<div class="upper-nav overflow-hidden relative bg-blue-600 py-3">
  <p class="whitespace-nowrap absolute animate-marquee text-lg md:text-xl font-bold text-white">
    kore ubukwe bitakuruhije turagufasha guhaha byose uko ubisha nta siterese wagira byikorere
  </p>
</div>
<style>
  /* Marquee animation */
  @keyframes marquee {
    0%   { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
  }
  .animate-marquee {
    animation: marquee 15s linear infinite;
  }
</style>



  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand fw-bold text-primary" href="#">bprince</a>

      <!-- Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <!-- Categories Dropdown -->
        <div class="dropdown me-3">
          <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-list"></i> Categories
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Imyambaro n’Imideri</a></li>
            <li><a class="dropdown-item" href="#">Ibiribwa n’Ibinyobwa</a></li>
            <li><a class="dropdown-item" href="#">Venue & Decoration</a></li>
            <li><a class="dropdown-item" href="#">Ibikoresho by’ameza n’Isuku</a></li>
            <li><a class="dropdown-item" href="#">Impano & Invitations</a></li>
            <li><a class="dropdown-item" href="#">Transport & Cars</a></li>
            <li><a class="dropdown-item" href="#">Photography & Video</a></li>
            <li><a class="dropdown-item" href="#">Music & Entertainment</a></li>
            <li><a class="dropdown-item" href="#">Makeup & Beauty</a></li>
            <li><a class="dropdown-item" href="#">Accommodation & Honeymoon</a></li>
          </ul>
        </div>

        <!-- Search Bar -->
        <form class="d-flex flex-grow-1 mx-3">
          <input class="form-control me-2" type="search" placeholder="Search for products..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
        </form>

        <!-- Right Icons -->
        <ul class="navbar-nav d-flex align-items-center gap-3">
          <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-heart fs-5"></i></a></li>
          <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person fs-5"></i></a></li>
          <li class="nav-item position-relative">
            <a class="nav-link" href="./cart.php">
              <i class="bi bi-cart fs-5"></i>
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                <?php cart_item(); ?>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Landing Section -->
  <div class="container-fluid py-4">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 shadow-sm categories-sidebar p-3">
        <p class="fs-5 fw-semibold text-dark">
          💍 Ubukwe — turagufasha kugura byose ukeneye
        </p>
      </div>

      <!-- Banner -->
      <div class="col-lg-9 mt-3 mt-lg-0">
        <div class="banner-box">
          <h2>ubukwe bugezweho jyerageza</h2>
          <p class="fs-5">start shop ni ba ushaka ibyiza <span class="fw-bold">100%</span> every day 24hour turagufasha</p>
          <a href="products.php" class="btn btn-warning fw-bold">Order Now</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Landing Section -->

  <!-- Category Section -->
  <div class="container my-5">
    <h3 class="mb-4 fw-bold">Browse By Category</h3>
    <div class="row g-3">
      <div class="col-6 col-md-3">
        <div class="card text-center p-3 shadow-sm category-card">
          <p>Kosime</p>
          <img src="51H0A3M+k9L._AC_SY550_.jpg" alt="">
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card text-center p-3 shadow-sm category-card">
          <p>Inkweto</p>
          <img src="61BCoZc8-dL._AC_SY575_.jpg" alt="">
          <img src="61bhx80xTmL._AC_SY575_.jpg" alt="">
          <img src="71RVSu-DgIL._AC_SX575_.jpg" alt="">
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card text-center p-3 shadow-sm category-card">
          <img src="71fNy1tuPTL._AC_SY575_.jpg" alt="">
          <img src="81GWfXOab6L._AC_SY575_.jpg" alt="">
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card text-center p-3 shadow-sm category-card">
          <img src="61lZYr+3njL._SX679_.jpg" alt="">
          <img src="71V83yw81OL._SX679_.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- End Category Section -->

  <!-- Products Section -->
  <div class="container my-5">
    <h3 class="mb-4 fw-bold">Explore Our Products</h3>
    <div class="row g-3">
      <?php getProduct(6); // show 6 products ?>
    </div>
    <div class="text-center mt-4">
      <a href="./products.php" class="btn btn-outline-primary">View All Products</a>
    </div>
  </div>
  <!-- End Products Section -->

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="m-0">&copy; <?php echo date("Y"); ?> ubukwe system</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
