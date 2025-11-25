<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">
                <i class="bi bi-tags-fill text-primary"></i> All Brands
            </h2>
            <a href="index.php?add_brand" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add New Brand
            </a>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Brand Title</th>
                        <th width="80">Edit</th>
                        <th width="80">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all brands
                    $get_brand_query = "SELECT * FROM `brands`";
                    $get_brand_result = mysqli_query($con, $get_brand_query);
                    $id_number = 1;
                    while ($row = mysqli_fetch_assoc($get_brand_result)) {
                        $brand_id = $row['brand_id'];
                        $brand_title = $row['brand_title'];
                        echo "
                        <tr>
                            <td>{$id_number}</td>
                            <td class='text-start ps-4'>{$brand_title}</td>
                            <td>
                                <a href='index.php?edit_brand={$brand_id}' class='btn btn-warning btn-sm'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>
                            </td>
                            <td>
                                <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal{$brand_id}'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class='modal fade' id='deleteModal{$brand_id}' tabindex='-1' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                    <div class='modal-header bg-danger text-white'>
                                        <h5 class='modal-title'>
                                            <i class='bi bi-exclamation-triangle-fill'></i> Confirm Delete
                                        </h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body text-center'>
                                        <p class='fs-5'>Are you sure you want to delete <strong>{$brand_title}</strong>?</p>
                                        <p class='text-muted'>This action cannot be undone.</p>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                        <a href='index.php?delete_brand={$brand_id}' class='btn btn-danger'>Delete</a>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
