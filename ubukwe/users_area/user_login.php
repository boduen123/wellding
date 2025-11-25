<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 to-blue-700 font-sans">
  <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">User Login</h2>

    <form action="" method="post" class="flex flex-col space-y-4">
      <!-- Username -->
      <div>
        <label for="user_username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input 
          type="text" 
          name="user_username" 
          id="user_username" 
          placeholder="Enter username" 
          required 
          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >
      </div>

      <!-- Password -->
      <div>
        <label for="user_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input 
          type="password" 
          name="user_password" 
          id="user_password" 
          placeholder="Enter password" 
          required 
          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
        >
      </div>

      <!-- Forget password -->
      <div class="text-right">
        <a href="#" class="text-blue-800 text-sm hover:underline font-medium">Forgot your password?</a>
      </div>

      <!-- Submit -->
      <div>
        <input 
          type="submit" 
          name="user_login" 
          value="Login" 
          class="w-full bg-blue-800 text-white font-semibold py-3 rounded-xl hover:bg-blue-900 transition"
        >
      </div>
    </form>

    <p class="text-center text-sm text-gray-700 mt-4">
      Don’t have an account? 
      <a href="user_registration.php" class="text-blue-800 font-semibold hover:underline">Register</a><br>
      <a href="../admin/admin_login.php" class="text-blue-800 font-semibold hover:underline">umucuruzi</a> |
      <a href="../admin/superadminlogin.php" class="text-blue-800 font-semibold hover:underline">superAdmin</a>
    </p>
  </div>
</body>
</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $select_result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($select_result);
    $row_count = mysqli_num_rows($select_result);
    $user_ip = getIPAddress();

    $select_cart_query = "SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
    $select_cart_result = mysqli_query($con, $select_cart_query);
    $row_cart_count = mysqli_num_rows($select_cart_result);

    if ($row_count > 0) {
        if (password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['username'] = $user_username;
            if ($row_cart_count == 0) {
                echo "<script>alert('Login Successfully');window.open('profile.php','_self');</script>";
            } else {
                echo "<script>alert('Login Successfully');window.open('payment.php','_self');</script>";
            }
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
