<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .categ-header {
            margin: 20px 0;
            padding-bottom: 10px;
            border-bottom: 3px solid #0d6efd;
        }

        .categ-header h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
        }

        .table-data {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            vertical-align: middle;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 0.35em 0.6em;
            border-radius: 0.5rem;
        }

        .modal-content {
            border-radius: 15px;
            padding: 10px;
        }

        .modal-body h2 {
            font-size: 1.5rem;
            color: #dc3545;
        }

        .modal-body p {
            font-size: 1rem;
            color: #555;
        }

        .btns .btn {
            border-radius: 30px;
        }

        .delete-icon svg {
            fill: #dc3545;
            transition: 0.3s;
        }

        .delete-icon:hover svg {
            transform: scale(1.1);
            fill: #b02a37;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="categ-header d-flex align-items-center justify-content-between">
            <h2>🛒 All Orders</h2>
        </div>

        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <?php
                    $get_order_query = "SELECT * FROM `user_orders`";
                    $get_order_result = mysqli_query($con, $get_order_query);
                    $row_count = mysqli_num_rows($get_order_result);
                    if ($row_count != 0) {
                        echo "
                        <tr>
                            <th>#</th>
                            <th>Due Amount</th>
                            <th>Invoice Number</th>
                            <th>Total Products</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Complete</th>
                            <th>Action</th>
                        </tr>";
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    if ($row_count == 0) {
                        echo "<tr><td colspan='8' class='text-center text-muted p-4'><h5>No orders yet 📝</h5></td></tr>";
                    } else {
                        $id_number = 1;
                        while ($row_fetch_orders = mysqli_fetch_array($get_order_result)) {
                            $order_id = $row_fetch_orders['order_id'];
                            $amount_due = $row_fetch_orders['amount_due'];
                            $invoice_number = $row_fetch_orders['invoice_number'];
                            $total_products = $row_fetch_orders['total_products'];
                            $order_date = $row_fetch_orders['order_date'];
                            $order_status = $row_fetch_orders['order_status'];
                            $order_complete = $order_status == 'paid' ? 'Complete' : 'Incomplete';
                            $status_class = $order_status == 'paid' ? 'bg-success' : 'bg-warning';

                            echo "
                            <tr>
                                <td>$id_number</td>
                                <td>$$amount_due</td>
                                <td>$invoice_number</td>
                                <td>$total_products</td>
                                <td>$order_date</td>
                                <td><span class='badge badge-status $status_class text-white'>$order_status</span></td>
                                <td>$order_complete</td>
                                <td>
                                    <a href='#' class='delete-icon' data-bs-toggle='modal' data-bs-target='#deleteModal_$order_id'>
                                        <svg xmlns='http://www.w3.org/2000/svg' height='20' viewBox='0 0 448 512'>
                                            <path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/>
                                        </svg>
                                    </a>

                                    <!-- Delete Modal -->
                                    <div class='modal fade' id='deleteModal_$order_id' tabindex='-1' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-body text-center'>
                                                    <span>
                                                        <svg width='60' height='60' viewBox='0 0 60 60' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle cx='29.5' cy='30.5' r='26' stroke='#EA4335' stroke-width='3'/>
                                                            <path d='M41.2715 22.2715C42.248 21.2949 42.248 19.709 41.2715 18.7324C40.2949 17.7559 38.709 17.7559 37.7324 18.7324L29.5059 26.9668L21.2715 18.7402C20.2949 17.7637 18.709 17.7637 17.7324 18.7402C16.7559 19.7168 16.7559 21.3027 17.7324 22.2793L25.9668 30.5059L17.7402 38.7402C16.7637 39.7168 16.7637 41.3027 17.7402 42.2793C18.7168 43.2559 20.3027 43.2559 21.2793 42.2793L29.5059 34.0449L37.7402 42.2715C38.7168 43.248 40.3027 43.248 41.2793 42.2715C42.2559 41.2949 42.2559 39.709 41.2793 38.7324L33.0449 30.5059L41.2715 22.2715Z' fill='#EA4335'/>
                                                        </svg>
                                                    </span>
                                                    <h2>Are you sure?</h2>
                                                    <p>Do you really want to delete Order <strong>#$id_number</strong>? This action cannot be undone.</p>
                                                    <div class='btns d-flex justify-content-center gap-3'>
                                                        <button type='button' class='btn btn-secondary px-4' data-bs-dismiss='modal'>Cancel</button>
                                                        <a href='index.php?delete_order=$order_id' class='btn btn-danger px-4'>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            ";
                            $id_number++;
                        }
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
