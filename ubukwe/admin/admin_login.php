<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Admin Login</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(135deg, #1e3a8a, #6d28d9);
      min-height: 100vh;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-input {
      background-color: rgba(255, 255, 255, 0.85);
      border: none;
    }

    .form-input:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.7);
    }

    .login-btn {
      background: linear-gradient(135deg, #3b82f6, #9333ea);
    }

    .login-btn:hover {
      background: linear-gradient(135deg, #2563eb, #7e22ce);
    }
  </style>
</head>

<body class="flex items-center justify-center">

  <div class="flex flex-col md:flex-row w-full max-w-5xl rounded-xl overflow-hidden shadow-2xl glass-card">
    
    <!-- Left Image -->
    <div class="hidden md:block md:w-1/2">
      <img src="../assets/images/bgregister.png" alt="Login" class="object-cover h-full w-full">
    </div>

    <!-- Right Form -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center text-white">
      <div class="text-center mb-6">
        <i class="bi bi-shield-lock-fill text-5xl text-white"></i>
        <h2 class="text-3xl font-bold mt-2">Admin Login</h2>
        <p class="text-gray-200 text-sm">Access your dashboard</p>
      </div>

      <form action="" method="post" class="flex flex-col gap-5">
        <div>
          <label for="username" class="block mb-1 font-semibold">Username</label>
          <div class="relative">
            <i class="bi bi-person-fill absolute left-3 top-3 text-gray-500"></i>
            <input type="text" name="username" id="username"
              placeholder="Enter your username"
              class="form-input w-full pl-10 pr-3 py-2 rounded-md text-gray-800"
              required>
          </div>
        </div>

        <div>
          <label for="password" class="block mb-1 font-semibold">Password</label>
          <div class="relative">
            <i class="bi bi-lock-fill absolute left-3 top-3 text-gray-500"></i>
            <input type="password" name="password" id="password"
              placeholder="Enter your password"
              class="form-input w-full pl-10 pr-3 py-2 rounded-md text-gray-800"
              required>
          </div>
        </div>

        <div class="text-right">
          <a href="#" class="text-sm text-blue-200 hover:underline">Forgot password?</a>
        </div>

        <button type="submit" name="admin_login"
          class="login-btn text-white font-semibold py-2 rounded-md transition duration-300 hover:scale-[1.02]">
          <i class="bi bi-box-arrow-in-right mr-2"></i> Login
        </button>

        <p class="text-sm text-center mt-3 text-gray-200">
          Don’t have an account?
          <a href="./admin_resgistration.php" class="font-semibold text-blue-300 hover:underline">Register</a>
          or
          <a href="./superadminlogin.php" class="font-semibold text-blue-300 hover:underline">SuperAdmin</a>
        </p>
      </form>
    </div>

  </div>

</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username'";
  $select_result = mysqli_query($con, $select_query);
  $row_data = mysqli_fetch_assoc($select_result);
  $row_count = mysqli_num_rows($select_result);

  if ($row_count > 0) {
    if (password_verify($password, $row_data['admin_password'])) {
      $_SESSION['admin_username'] = $username;
      echo "<script>alert('Login Successfully');</script>";
      echo "<script>window.open('./index.php','_self');</script>";
    } else {
      echo "<script>alert('Invalid Credentials')</script>";
    }
  } else {
    echo "<script>alert('Username not exist')</script>";
  }
}
?>
