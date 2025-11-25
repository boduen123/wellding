<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
      font-family: "Segoe UI", sans-serif;
    }
    .register-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 30px;
    }
    .register-card h2 {
      font-weight: bold;
      color: #0d6efd;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-primary {
      border-radius: 10px;
      padding: 10px;
      font-weight: 600;
    }
    .link-login {
      color: #0d6efd;
      text-decoration: none;
      font-weight: bold;
    }
    .link-login:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="register-card">
          <h2 class="text-center mb-4">Create Account</h2>
          <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-3">
            <!-- Username -->
            <div>
              <label for="user_username" class="form-label">Username</label>
              <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" required>
            </div>
            <!-- Email -->
            <div>
              <label for="user_email" class="form-label">Email</label>
              <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" required>
            </div>
            <!-- Image -->
            <div>
              <label for="user_image" class="form-label">Profile Image</label>
              <input type="file" name="user_image" id="user_image" class="form-control" required>
            </div>
            <!-- Password -->
            <div>
              <label for="user_password" class="form-label">Password</label>
              <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter password" required>
            </div>
            <!-- Confirm Password -->
            <div>
              <label for="conf_user_password" class="form-label">Confirm Password</label>
              <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="Confirm password" required>
            </div>
            <!-- Address -->
            <div>
              <label for="user_address" class="form-label">Address</label>
              <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter address" required>
            </div>
            <!-- Mobile -->
            <div>
              <label for="user_mobile" class="form-label">Mobile</label>
              <input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter mobile number" required>
            </div>
            <!-- Submit -->
            <div class="text-center">
              <input type="submit" name="user_register" value="Register" class="btn btn-primary w-100">
            </div>
          </form>
          <p class="text-center mt-3">
            Already have an account? <a href="user_login.php" class="link-login">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/bootstrap.bundle.js"></script>
</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Check if user exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username or Email already exists');</script>";
    } elseif ($user_password !== $conf_user_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                        VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_mobile')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            echo "<script>alert('User registered successfully'); window.open('../index.php','_self');</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>
