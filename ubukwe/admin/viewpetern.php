<?php
include('../includes/connect.php');
include('../functions/common_functions.php');

// ====== HANDLE DELETE ======
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($con, "DELETE FROM admin_table WHERE admin_id=$id");
  echo "<script>alert('Admin deleted successfully'); window.location='admin_crud.php';</script>";
}

// ====== HANDLE ADD OR UPDATE ======
if (isset($_POST['save_admin'])) {
  $id = $_POST['admin_id'] ?? '';
  $name = $_POST['admin_name'];
  $email = $_POST['admin_email'];
  $password = $_POST['admin_password'];
  $image = $_FILES['admin_image']['name'];
  $tmp = $_FILES['admin_image']['tmp_name'];

  if (!file_exists("uploads")) mkdir("uploads");
  if ($image) {
    move_uploaded_file($tmp, "uploads/" . $image);
    $imgSql = "admin_image='$image'";
  } else {
    $imgSql = "";
  }

  if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $pwdSql = "admin_password='$hashed'";
  } else {
    $pwdSql = "";
  }

  // if updating
  if (!empty($id)) {
    $updates = [];
    $updates[] = "admin_name='$name'";
    $updates[] = "admin_email='$email'";
    if ($imgSql) $updates[] = $imgSql;
    if ($pwdSql) $updates[] = $pwdSql;
    $update_query = "UPDATE admin_table SET " . implode(", ", $updates) . " WHERE admin_id=$id";
    mysqli_query($con, $update_query);
    echo "<script>alert('Admin updated successfully'); window.location='admin_crud.php';</script>";
  } else {
    // add new
    $query = "INSERT INTO admin_table (admin_name, admin_email, admin_image, admin_password)
              VALUES ('$name', '$email', '$image', '$hashed')";
    mysqli_query($con, $query);
    echo "<script>alert('Admin added successfully'); window.location='admin_crud.php';</script>";
  }
}

// ====== FETCH FOR EDIT ======
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM admin_table WHERE admin_id=$id");
  $editData = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin CRUD</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
    <h1 class="text-3xl font-bold text-center text-blue-700 mb-6 flex justify-center items-center gap-2">
      <i class="bi bi-person-gear text-blue-700 text-4xl"></i> Admin Management
    </h1>

    <!-- ====== FORM ====== -->
    <div class="bg-blue-50 rounded-lg p-5 mb-8">
      <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="admin_id" value="<?php echo $editData['admin_id'] ?? ''; ?>">

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="admin_name" value="<?php echo $editData['admin_name'] ?? ''; ?>" required
              class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="admin_email" value="<?php echo $editData['admin_email'] ?? ''; ?>" required
              class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="admin_password" placeholder="<?php echo isset($editData) ? 'Leave blank to keep old password' : ''; ?>"
              class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <input type="file" name="admin_image" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" />
            <?php if (!empty($editData['admin_image'])): ?>
              <img src="uploads/<?php echo $editData['admin_image']; ?>" alt="" class="w-16 h-16 mt-2 rounded-full object-cover">
            <?php endif; ?>
          </div>
        </div>

        <div class="text-center mt-4">
          <button type="submit" name="save_admin"
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 justify-center mx-auto">
            <i class="bi <?php echo isset($editData) ? 'bi-pencil-square' : 'bi-person-plus'; ?>"></i>
            <?php echo isset($editData) ? 'Update Admin' : 'Add Admin'; ?>
          </button>
          <?php if (isset($editData)): ?>
            <a href="admin_crud.php" class="ml-4 text-gray-600 hover:underline">Cancel</a>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <!-- ====== TABLE ====== -->
    <table class="w-full border text-sm">
      <thead class="bg-blue-600 text-white">
        <tr>
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Image</th>
          <th class="py-2 px-4 border">Name</th>
          <th class="py-2 px-4 border">Email</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = mysqli_query($con, "SELECT * FROM admin_table ORDER BY admin_id DESC");
        while ($row = mysqli_fetch_assoc($result)): ?>
          <tr class="border hover:bg-gray-100">
            <td class="py-2 px-4 border text-center"><?php echo $row['admin_id']; ?></td>
            <td class="py-2 px-4 border text-center">
              <img src="uploads/<?php echo $row['admin_image']; ?>" alt="img" class="w-10 h-10 rounded-full mx-auto object-cover">
            </td>
            <td class="py-2 px-4 border"><?php echo $row['admin_name']; ?></td>
            <td class="py-2 px-4 border"><?php echo $row['admin_email']; ?></td>
            <td class="py-2 px-4 border text-center space-x-2">
              <a href="admin_crud.php?edit=<?php echo $row['admin_id']; ?>"
                 class="text-blue-600 hover:text-blue-800 inline-flex items-center gap-1">
                 <i class="bi bi-pencil-square"></i> Edit
              </a>
              <a href="admin_crud.php?delete=<?php echo $row['admin_id']; ?>"
                 class="text-red-600 hover:text-red-800 inline-flex items-center gap-1"
                 onclick="return confirm('Delete this admin?');">
                 <i class="bi bi-trash3"></i> Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
