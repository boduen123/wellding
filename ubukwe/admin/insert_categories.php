<?php
include('../includes/connect.php');
if (isset($_POST['insert_categ_title'])) {
    $category_title = $_POST['categ_title'];
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $select_result = mysqli_query($con,$select_query);
    $numOfResults = mysqli_num_rows($select_result);
    if ($numOfResults > 0) {
        echo "<script>alert('Category is already in Database');</script>";
    } else {
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result){
            echo "<script>alert('Category has been inserted successfully');</script>";
        }
    }
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Header Section */
.categ-header {
    margin-bottom: 20px;
    border-bottom: 3px solid #0d6efd;
    padding-bottom: 10px;
}
.categ-header .sub-title {
    display: flex;
    align-items: center;
    gap: 10px;
}
.categ-header .shape {
    width: 8px;
    height: 35px;
    background: #0d6efd;
    border-radius: 5px;
}
.categ-header h2 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

/* Form Card */
.category-card {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Input icon background */
.input-group-text {
    background-color: #0d6efd;
    border: none;
    border-radius: 8px 0 0 8px;
}
.input-group-text svg {
    fill: #fff;
}
.form-control {
    border-radius: 0 8px 8px 0;
    box-shadow: none;
    border: 1px solid #dee2e6;
}
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 5px rgba(13,110,253,.5);
}

/* Button */
.btn-primary {
    padding: 10px 20px;
    border-radius: 8px;
    transition: background 0.3s ease;
}
.btn-primary:hover {
    background: #084298;
}
</style>

<div class="categ-header">
    <div class="sub-title">
        <span class="shape"></span>
        <h2>Insert Categories</h2>
    </div>
</div>

<div class="category-card">
    <form action="" method="POST">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                    <path d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 
                    120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 
                    232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 
                    344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 
                    14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5
                    -25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3
                    7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 
                    7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1
                    7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 
                    6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 
                    16s7.2 16 16 16H288c8.8 0 16-7.2 
                    16-16s-7.2-16-16-16H96zM80 352c0 
                    8.8 7.2 16 16 16H288c8.8 0 16-7.2 
                    16-16s-7.2-16-16-16H96c-8.8 0-16 
                    7.2-16 16zM96 240c-8.8 0-16 7.2-16 
                    16s7.2 16 16 16H288c8.8 0 16-7.2 
                    16-16s-7.2-16-16-16H96z"/>
                </svg>
            </span>
            <input type="text" class="form-control" name="categ_title" placeholder="Insert Category" required>
        </div>
        <div class="text-end">
            <input type="submit" class="btn btn-primary" name="insert_categ_title" value="Insert Category">
        </div>
    </form>
</div>
