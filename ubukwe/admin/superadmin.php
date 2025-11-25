<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();

if(isset($_SESSION['admin_username'])){
    $admin_name = $_SESSION['admin_username'];
    $get_admin_data = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name'";
    $get_admin_result = mysqli_query($con,$get_admin_data);
    $row_fetch_admin_data = mysqli_fetch_array($get_admin_result);
    $admin_name = $row_fetch_admin_data['admin_name'];
    $admin_image = $row_fetch_admin_data['admin_image'];
}else{
    echo "<script>window.open('./superadminlogin.php','_self');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>super admin of ubukwe system</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Upper nav styling */
.bg-primary.text-white {
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Navbar styling */
.navbar {
    border-bottom: 2px solid #dee2e6;
}
.navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
}

/* Sidebar layout */
.sidebar {
    min-height: 90vh;
    background-color: #fff;
    border-right: 1px solid #dee2e6;
    padding: 20px;
}
.sidebar .admin-image img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 3px solid #0d6efd;
    transition: transform 0.3s, box-shadow 0.3s;
    margin-bottom: 10px;
}
.sidebar .admin-image img:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
.sidebar .dashboard-btn a {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 10px 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    color: #0d6efd;
    border: 1px solid #0d6efd;
}
.sidebar .dashboard-btn a:hover {
    background-color: #0d6efd;
    color: #fff;
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
.sidebar .dashboard-btn a i {
    font-size: 1.2rem;
}

/* Dynamic content styling */
.content-area {
    padding: 20px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    min-height: 80vh;
}

/* Responsive layout */
@media(max-width: 992px){
    .sidebar {
        min-height: auto;
        border-right: none;
        border-bottom: 1px solid #dee2e6;
    }
    .d-flex.main-layout {
        flex-direction: column;
    }
}
</style>
</head>
<body>

<!-- Upper Nav -->
<div class="bg-primary text-white text-center py-2">
    ubukwe system it digital wedding  save your time  
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">A1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentad" aria-controls="navbarSupportedContentad" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContentad">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item me-3">
                    <span class="nav-link active">Welcome, <?php echo $admin_name;?></span>
                </li>
                <li class="nav-item">
                    <a href="./admin_logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Layout -->
<div class="container-fluid">
    <div class="d-flex main-layout gap-3">
        <!-- Sidebar -->
        <div class="sidebar col-lg-2 text-center">
            <div class="admin-image">
                <a href="./superadmin.php"><img src="./admin_images/<?php echo $admin_image;?>" class="rounded-circle" alt="Admin Photo"></a>
            </div>
            <p class="fw-bold"><?php echo $admin_name;?></p>
            <div class="dashboard-btn d-flex flex-column">
                <a href="superadmin.php?list_orders"><i class="bi bi-basket3"></i> All Orders</a>
                <a href="superadmin.php?list_payments"><i class="bi bi-currency-dollar"></i> All Payments</a>
                <a href="superadmin.php?list_users"><i class="bi bi-people"></i> List Users</a>
                 <a href="viewpetern.php"><i class="bi bi-people"></i> List of parten</a>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area col-lg-10">
            <?php
            
                
               
                if(isset($_GET['list_orders'])){ include('./list_orders.php'); }
                if(isset($_GET['delete_order'])){ include('./delete_order.php'); }
                if(isset($_GET['list_payments'])){ include('./list_payments.php'); }
                if(isset($_GET['delete_payment'])){ include('./delete_payment.php'); }
                if(isset($_GET['list_users'])){ include('./list_users.php'); }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
