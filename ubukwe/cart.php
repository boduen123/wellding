<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();

// ====== REMOVE ITEM FUNCTION ======
function remove_cart_item()
{
    global $con;
    if (isset($_POST['remove_cart'])) {
        if (!empty($_POST['removeitem'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                $delete_query = "DELETE FROM `card_details` WHERE product_id=$remove_id";
                $delete_run_result = mysqli_query($con, $delete_query);
            }
            echo "<script>window.open('cart.php','_self');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Cart Details Page</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <!-- upper-nav -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a>Shop Now</a></span>
    </div>
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">A1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <?php
                    if (isset($_SESSION['username'])) {
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
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">
                            🛒 <sup><?php cart_item(); ?></sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <?php
                            if (!isset($_SESSION['username'])) {
                                echo "<span>Welcome guest</span>";
                            } else {
                                echo "<span>Welcome " . $_SESSION['username'] . "</span>";
                            }
                            ?>
                        </a>
                    </li>
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End NavBar -->

    <!-- Start Table Section -->
    <div class="landing">
        <div class="container">
            <div class="row py-5 m-0">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table class="table table-bordered table-hover table-striped table-group-divider text-center">
                        <?php
                        $getIpAddress = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM `card_details` WHERE ip_address='$getIpAddress'";
                        $cart_result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($cart_result);

                        if ($result_count > 0) {
                            echo "
                                <thead>
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Remove</th>
                                        <th colspan='2'>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>";
                            while ($row = mysqli_fetch_array($cart_result)) {
                                $product_id = $row['product_id'];
                                $product_quantity = $row['quantity'];

                                $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
                                $select_product_result = mysqli_query($con, $select_product_query);

                                while ($row_product_price = mysqli_fetch_array($select_product_result)) {
                                    $product_price = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image_one = $row_product_price['product_image_one'];

                                    $total_price += ($product_price * $product_quantity);

                                    // === Update Quantity ===
                                    if (isset($_POST['update_cart'])) {
                                        $itemsOfProduct = 'qty_' . $product_id;
                                        if (!empty($_POST[$itemsOfProduct])) {
                                            $quantities = $_POST[$itemsOfProduct];
                                            $update_cart_query = "UPDATE `card_details` SET quantity=$quantities WHERE ip_address='$getIpAddress' AND product_id=$product_id";
                                            mysqli_query($con, $update_cart_query);
                                            echo "<script>window.open('cart.php','_self');</script>";
                                        }
                                    }
                        ?>
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img src="./admin/product_images/<?php echo $product_image_one; ?>" class="img-thumbnail" width="80"></td>
                                        <td><input type="number" class="form-control w-50 mx-auto" min="1" name="qty_<?php echo $product_id; ?>" value="<?php echo $product_quantity; ?>"></td>
                                        <td><?php echo $product_price * $product_quantity; ?></td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                        <td><input type="submit" value="Update" class="btn btn-dark" name="update_cart"></td>
                                        <td><input type="submit" value="Remove" class="btn btn-primary" name="remove_cart"></td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- SubTotal -->
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <?php
                        $cart_result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($cart_result);

                        if ($result_count > 0) {
                            echo "
                                <h4>Sub-Total: <strong class='text-2'> $total_price</strong></h4>
                                <a href='./index.php' class='btn btn-dark'>Continue Shopping</a>
                                <a href='./users_area/checkout.php' class='btn btn-dark'>Checkout</a>
                            ";
                        } else {
                            echo "<a href='./index.php' class='btn btn-dark'>Continue Shopping</a>";
                        }
                        ?>
                    </div>
                </form>

                <!-- Call remove function -->
                <?php remove_cart_item(); ?>
            </div>
        </div>
    </div>
    <!-- End Table Section -->

    <script src="./assets/js/bootstrap.bundle.js"></script>
</body>
</html>
