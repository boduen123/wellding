<?php
include("../includes/connect.php");
include("../functions/common_functions.php");
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_order_query = "SELECT * FROM `user_orders` WHERE order_id = '$order_id'";
    $select_order_result = mysqli_query($con, $select_order_query);
    $row_fetch = mysqli_fetch_array($select_order_result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Insert payment record first
    $insert_payment_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_method)
                             VALUES ($order_id, $invoice_number, $amount, '$payment_method')";
    $insert_payment_result = mysqli_query($con, $insert_payment_query);

    // Simulate gateway redirect or API call based on payment method
    switch ($payment_method) {
        case "mtn_money":
            $api_url = "https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay";
            echo "<script>alert('Redirecting to MTN Mobile Money payment...');</script>";
            break;

        case "airtel_money":
            $api_url = "https://openapi.airtel.africa/merchant/v1/payments/";
            echo "<script>alert('Redirecting to Airtel Money payment...');</script>";
            break;

        case "bank_account":
            $api_url = "https://api.flutterwave.com/v3/payments";
            echo "<script>alert('Redirecting to bank payment gateway...');</script>";
            break;

        case "card_payment":
            $api_url = "https://api.flutterwave.com/v3/payments";
            echo "<script>alert('Redirecting to Card Payment gateway...');</script>";
            break;

        case "cash_on_delivery":
            echo "<script>alert('Payment will be made on delivery.');</script>";
            break;
    }

    if ($insert_payment_result) {
        $update_orders_query = "UPDATE `user_orders` SET order_status = 'paid' WHERE order_id = $order_id";
        mysqli_query($con, $update_orders_query);

        echo "<script>window.alert('Payment completed successfully');</script>";
        echo "<script>window.open('profile.php?my_orders','_self');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <!-- upper-nav -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>We are glad to help you | We wish you buy again from our store</span>
    </div>

    <!-- Payment Form -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Confirm Payment</h1>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow p-4">
                    <form method="post" class="d-flex flex-column gap-3 text-center" action="">
                        <div class="form-outline">
                            <label for="invoice_number" class="form-label fw-bold">Invoice Number</label>
                            <input type="text" class="form-control text-center" name="invoice_number" id="invoice_number" value="<?php echo $invoice_number; ?>" readonly>
                        </div>

                        <div class="form-outline">
                            <label for="amount" class="form-label fw-bold">Amount</label>
                            <input type="text" class="form-control text-center" name="amount" id="amount" value="<?php echo $amount_due; ?>" readonly>
                        </div>

                        <div class="form-outline">
                            <label for="payment_method" class="form-label fw-bold">Select Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option selected disabled>Select payment method</option>
                                <option value="mtn_money">MTN Mobile Money</option>
                                <option value="airtel_money">Airtel Money</option>
                                <option value="bank_account">Bank Account (BK, Equity, I&M, etc.)</option>
                                <option value="card_payment">Card Payment (Visa / Mastercard)</option>
                                <option value="cash_on_delivery">Cash on Delivery</option>
                            </select>
                        </div>

                        <!-- 🔹 Dynamic Extra Fields Appear Here -->
                        <div id="extra-fields"></div>

                        <div class="form-outline">
                            <input type="submit" value="Confirm Payment" name="confirm_payment" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.js"></script>

    <!-- 🔹 JavaScript to Show Dynamic Inputs -->
    <script>
        const paymentSelect = document.getElementById('payment_method');
        const extraFields = document.getElementById('extra-fields');

        paymentSelect.addEventListener('change', function() {
            const method = this.value;
            extraFields.innerHTML = ''; // clear previous fields

            if (method === 'mtn_money') {
                extraFields.innerHTML = `
                    <div class="form-outline">
                        <label class="form-label fw-bold">MTN MoMo Number</label>
                        <input type="text" name="mtn_number" class="form-control text-center" placeholder="e.g. 078XXXXXXX" required>
                    </div>
                `;
            }

            else if (method === 'airtel_money') {
                extraFields.innerHTML = `
                    <div class="form-outline">
                        <label class="form-label fw-bold">Airtel Money Number</label>
                        <input type="text" name="airtel_number" class="form-control text-center" placeholder="e.g. 073XXXXXXX" required>
                    </div>
                `;
            }

            else if (method === 'bank_account') {
                extraFields.innerHTML = `
                    <div class="form-outline">
                        <label class="form-label fw-bold">Bank Name</label>
                        <input type="text" name="bank_name" class="form-control text-center" placeholder="e.g. Bank of Kigali" required>
                    </div>
                    <div class="form-outline">
                        <label class="form-label fw-bold">Account Number</label>
                        <input type="text" name="account_number" class="form-control text-center" placeholder="Enter account number" required>
                    </div>
                `;
            }

            else if (method === 'card_payment') {
                extraFields.innerHTML = `
                    <div class="form-outline">
                        <label class="form-label fw-bold">Card Number</label>
                        <input type="text" name="card_number" class="form-control text-center" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                    </div>
                    <div class="form-outline">
                        <label class="form-label fw-bold">Expiry Date</label>
                        <input type="month" name="expiry_date" class="form-control text-center" required>
                    </div>
                    <div class="form-outline">
                        <label class="form-label fw-bold">CVV</label>
                        <input type="password" name="cvv" maxlength="3" class="form-control text-center" placeholder="***" required>
                    </div>
                `;
            }

            else if (method === 'cash_on_delivery') {
                extraFields.innerHTML = `
                    <div class="alert alert-info mt-2">
                        You will pay the amount in cash when your order is delivered.
                    </div>
                `;
            }
        });
    </script>
</body>
</html>
