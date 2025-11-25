<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    $product_image_one = $_FILES['product_image_one']['name'];
    $product_image_two = $_FILES['product_image_two']['name'];
    $product_image_three = $_FILES['product_image_three']['name'];

    $temp_image_one = $_FILES['product_image_one']['tmp_name'];
    $temp_image_two = $_FILES['product_image_two']['tmp_name'];
    $temp_image_three = $_FILES['product_image_three']['tmp_name'];

    if($product_title == '' || $product_description == '' || $product_keywords == '' || $product_category == '' || $product_brand == '' || empty($product_price) || empty($product_image_one) || empty($product_image_two) || empty($product_image_three)){
        echo "<script>alert('Fields should not be empty');</script>";
        exit();
    } else {
        move_uploaded_file($temp_image_one,"./product_images/$product_image_one");
        move_uploaded_file($temp_image_two,"./product_images/$product_image_two");
        move_uploaded_file($temp_image_three,"./product_images/$product_image_three");

        $insert_query = "INSERT INTO `products` 
            (product_title, product_description, product_keywords, category_id, brand_id, product_image_one, product_image_two, product_image_three, product_price, date, status) 
            VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brand', '$product_image_one', '$product_image_two', '$product_image_three', '$product_price', NOW(), '$product_status')";

        $insert_result = mysqli_query($con, $insert_query);
        if($insert_result){
            echo "<script>alert('Product Inserted Successfully');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Product - Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(input.files[0]);
        preview.classList.remove('hidden');
    }
}
</script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

<!-- Form Container -->
<div class="bg-black text-white shadow-2xl rounded-2xl p-8 w-full max-w-4xl animate-fadeIn scale-95 transform transition duration-500 hover:scale-100">
    <h2 class="text-3xl font-bold text-center mb-8 text-yellow-400 animate-pulse">Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data" class="space-y-6">

        <!-- Product Title -->
        <div>
            <label class="block text-sm font-medium text-yellow-300">Product Title</label>
            <input type="text" name="product_title" placeholder="Enter Product Title" 
                   class="mt-1 w-full border border-gray-700 rounded-lg p-3 
                          bg-gray-800 text-white placeholder-yellow-300
                          focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" required>
        </div>

        <!-- Product Description -->
        <div>
            <label class="block text-sm font-medium text-yellow-300">Product Description</label>
            <textarea name="product_description" placeholder="Enter Product Description" rows="4"
                      class="mt-1 w-full border border-gray-700 rounded-lg p-3 
                             bg-gray-800 text-white placeholder-yellow-300
                             focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" required></textarea>
        </div>

        <!-- Product Keywords -->
        <div>
            <label class="block text-sm font-medium text-yellow-300">Product Keywords</label>
            <input type="text" name="product_keywords" placeholder="Enter Product Keywords" 
                   class="mt-1 w-full border border-gray-700 rounded-lg p-3 
                          bg-gray-800 text-white placeholder-yellow-300
                          focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" required>
        </div>

        <!-- Category & Brand -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-yellow-300">Select Category</label>
                <select name="product_category" 
                        class="mt-1 w-full border border-gray-700 rounded-lg p-2 
                               bg-gray-800 text-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition">
                    <option selected disabled class="text-gray-400">Select a Category</option>
                    <?php
                    $select_query = 'SELECT * FROM `categories`';
                    $select_result = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($select_result)) {
                        echo "<option value='{$row['category_id']}' class='text-white'>{$row['category_title']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-300">Select Brand</label>
                <select name="product_brand" 
                        class="mt-1 w-full border border-gray-700 rounded-lg p-2 
                               bg-gray-800 text-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition">
                    <option selected disabled class="text-gray-400">Select a Brand</option>
                    <?php
                    $select_query = 'SELECT * FROM `brands`';
                    $select_result = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($select_result)) {
                        echo "<option value='{$row['brand_id']}' class='text-white'>{$row['brand_title']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Product Images -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-yellow-300">Product Image One</label>
                <input type="file" name="product_image_one" onchange="previewImage(this,'preview1')" 
                       class="mt-1 w-full border border-gray-700 rounded-lg p-1 cursor-pointer 
                              transition hover:border-yellow-500 text-white" required>
                <img id="preview1" class="mt-2 hidden w-full h-32 object-cover rounded-lg shadow-lg transition transform hover:scale-105" alt="Preview">
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-300">Product Image Two</label>
                <input type="file" name="product_image_two" onchange="previewImage(this,'preview2')" 
                       class="mt-1 w-full border border-gray-700 rounded-lg p-1 cursor-pointer 
                              transition hover:border-yellow-500 text-white" required>
                <img id="preview2" class="mt-2 hidden w-full h-32 object-cover rounded-lg shadow-lg transition transform hover:scale-105" alt="Preview">
            </div>
            <div>
                <label class="block text-sm font-medium text-yellow-300">Product Image Three</label>
                <input type="file" name="product_image_three" onchange="previewImage(this,'preview3')" 
                       class="mt-1 w-full border border-gray-700 rounded-lg p-1 cursor-pointer 
                              transition hover:border-yellow-500 text-white" required>
                <img id="preview3" class="mt-2 hidden w-full h-32 object-cover rounded-lg shadow-lg transition transform hover:scale-105" alt="Preview">
            </div>
        </div>

        <!-- Product Price -->
        <div>
            <label class="block text-sm font-medium text-yellow-300">Product Price</label>
            <input type="number" name="product_price" placeholder="Enter Product Price" 
                   class="mt-1 w-full border border-gray-700 rounded-lg p-3 
                          bg-gray-800 text-white placeholder-yellow-300
                          focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" name="insert_product" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg 
                           transition transform hover:scale-105 shadow-lg">
                Add New Product
            </button>
        </div>
    </form>
</div>

</body>
</html>
