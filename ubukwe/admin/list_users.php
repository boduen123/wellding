<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Users</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">
        <i class="bi bi-people-fill text-primary"></i> All Users
      </h2>
    </div>

    <?php
    $get_user_query = "SELECT * FROM `user_table`";
    $get_user_result = mysqli_query($con, $get_user_query);
    $row_count = mysqli_num_rows($get_user_result);

    if ($row_count == 0) {
      echo "<div class='alert alert-warning text-center fs-5'>No users found</div>";
    } else {
    ?>
      <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover table-striped align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Email</th>
              <th>Image</th>
              <th>Address</th>
              <th>Mobile</th>
              <th width="80">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $id_number = 1;
            while ($row = mysqli_fetch_assoc($get_user_result)) {
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_address = $row['user_address'];
              $user_mobile = $row['user_mobile'];

              echo "
              <tr>
                <td>{$id_number}</td>
                <td>{$username}</td>
                <td>{$user_email}</td>
                <td>
                  <img src='../users_area/user_images/{$user_image}' 
                       alt='{$username} photo' 
                       class='rounded-circle border' 
                       width='60' height='60'/>
                </td>
                <td>{$user_address}</td>
                <td>{$user_mobile}</td>
                <td>
                  <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal{$user_id}'>
                    <i class='bi bi-trash'></i>
                  </button>
                </td>
              </tr>

              <!-- Delete Confirmation Modal -->
              <div class='modal fade' id='deleteModal{$user_id}' tabindex='-1' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                  <div class='modal-content'>
                    <div class='modal-header bg-danger text-white'>
                      <h5 class='modal-title'>
                        <i class='bi bi-exclamation-triangle-fill'></i> Confirm Delete
                      </h5>
                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body text-center'>
                      <p class='fs-5'>Are you sure you want to delete <strong>{$username}</strong>?</p>
                      <p class='text-muted'>This action cannot be undone.</p>
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                      <a href='index.php?delete_user={$user_id}' class='btn btn-danger'>Delete</a>
                    </div>
                  </div>
                </div>
              </div>
              ";
              $id_number++;
            }
            ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
