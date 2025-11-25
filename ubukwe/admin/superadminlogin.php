<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Super Admin Login</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-700 via-indigo-600 to-blue-900">

  <div class="bg-white/10 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden w-full max-w-4xl flex flex-col md:flex-row">
    <!-- Left Section -->
    <div class="hidden md:flex md:w-1/2">
      <img src="../assets/images/bgregister.png" alt="Login Image" class="object-cover w-full h-full">
    </div>

    <!-- Right Section -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
      <h2 class="text-4xl font-bold text-center text-white mb-2">Super Admin</h2>
      <p class="text-center text-gray-200 mb-8">Login to your account</p>

      <form action="" method="post" class="space-y-5">
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-100 mb-1">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter your username"
            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-100 mb-1">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter your password"
            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <!-- Forgot Password -->
        <div class="text-right">
          <a href="#" class="text-sm text-blue-200 hover:text-white transition">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <div>
          <input type="submit" value="Login" name="admin_login"
            class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-2 rounded-lg shadow-md hover:shadow-xl hover:scale-[1.02] transition duration-300 cursor-pointer">
        </div>

        <!-- Register Link -->
        <p class="text-sm text-center text-gray-200 mt-4">
          Don't have an account?
         
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
            echo "<script>window.open('./superadmin.php','_self');</script>";
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Username not exist');</script>";
    }
}
?>
