<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .categ-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .categ-header .shape {
            display: inline-block;
            width: 6px;
            height: 35px;
            background: #0d6efd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .categ-header h2 {
            font-weight: bold;
            color: #333;
        }

        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #0d6efd;
            color: white;
        }

        tbody tr:hover {
            background-color: #f1f5ff;
            transition: 0.3s ease-in-out;
        }

        .action-icons a svg {
            fill: #0d6efd;
            transition: 0.3s;
        }

        .action-icons a svg:hover {
            fill: #dc3545;
        }

        .modal-content {
            border-radius: 15px;
        }

        .fw-semibold {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="categ-header">
            <span class="shape"></span>
            <h2>All Categories</h2>
        </div>

        <div class="table-responsive shadow">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Category Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get Category info
                        $get_category_query = "SELECT * FROM `categories`";
                        $get_category_result = mysqli_query($con,$get_category_query);
                        $id_number = 1;
                        while($row_fetch_categories = mysqli_fetch_array($get_category_result)){
                            $category_id = $row_fetch_categories['category_id'];
                            $category_title = $row_fetch_categories['category_title'];

                            echo "
                            <tr>
                                <td>$id_number</td>
                                <td class='fw-semibold'>$category_title</td>
                                <td class='action-icons'>
                                    <a href='index.php?edit_category=$category_id'>
                                        <svg xmlns='http://www.w3.org/2000/svg' height='20' viewBox='0 0 512 512'><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7z'/></svg>
                                    </a>
                                </td>
                                <td class='action-icons'>
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#deleteModal_$category_id'>
                                        <svg xmlns='http://www.w3.org/2000/svg' height='20' viewBox='0 0 448 512'><path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/></svg>
                                    </a>

                                    <!-- Delete Modal -->
                                    <div class='modal fade' id='deleteModal_$category_id' tabindex='-1'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-body text-center p-4'>
                                                    <h5 class='mb-3'>Are you sure?</h5>
                                                    <p class='text-muted'>Do you really want to delete <b>$category_title</b>? This process cannot be undone.</p>
                                                    <div class='d-flex justify-content-center gap-3'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                        <a href='index.php?delete_category=$category_id' class='btn btn-danger'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                            $id_number++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
