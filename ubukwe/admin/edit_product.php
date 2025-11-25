<?php
// fetch all data
if(isset($_GET['edit_product'])){
    $edit_id = $_GET['edit_product'];
    $get_data_query = "SELECT * FROM `products` WHERE product_id = $edit_id";
    $get_data_result = mysqli_query($con,$get_data_query);
    $row_fetch_data = mysqli_fetch_array($get_data_result);
    $product_id = $row_fetch_data['product_id'];
    $product_title = $row_fetch_data['product_title'];
    $product_description = $row_fetch_data['product_description'];
    $product_keywords = $row_fetch_data['product_keywords'];
    $category_id = $row_fetch_data['category_id'];
    $brand_id = $row_fetch_data['brand_id'];
    $product_image_one_old = $row_fetch_data['product_image_one'];
    $product_image_two_old = $row_fetch_data['product_image_two'];
    $product_image_three_old = $row_fetch_data['product_image_three'];
    $product_price = $row_fetch_data['product_price'];
}

// edit product
if(isset($_POST['update_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category_id = $_POST['product_category'];
    $product_brand_id = $_POST['product_brand'];

    $product_image_one = $_FILES['product_image_one']['name'] == '' ? $product_image_one_old : $_FILES['product_image_one']['name'];
    $product_image_one_tmp = $_FILES['product_image_one']['tmp_name'];

    $product_image_two = $_FILES['product_image_two']['name'] == '' ? $product_image_two_old : $_FILES['product_image_two']['name'];
    $product_image_two_tmp = $_FILES['product_image_two']['tmp_name'];

    $product_image_three = $_FILES['product_image_three']['name'] == '' ? $product_image_three_old : $_FILES['product_image_three']['name'];
    $product_image_three_tmp = $_FILES['product_image_three']['tmp_name'];

    $product_price = $_POST['product_price'];

    if(empty($product_title) || empty($product_description) || empty($product_keywords) || empty($product_category_id) || empty($product_brand_id) || empty($product_image_one) || empty($product_image_two) || empty($product_image_three) || empty($product_price)){
        echo "<script>window.alert('Please fill all fields');</script>";
    }else{
        move_uploaded_file($product_image_one_tmp,"./product_images/$product_image_one");
        move_uploaded_file($product_image_two_tmp,"./product_images/$product_image_two");
        move_uploaded_file($product_image_three_tmp,"./product_images/$product_image_three");

        $update_product_query = "UPDATE `products` 
            SET category_id=$product_category_id,
                brand_id=$product_brand_id,
                product_title='$product_title',
                product_description='$product_description',
                product_keywords='$product_keywords',
                product_image_one='$product_image_one',
                product_image_two='$product_image_two',
                product_image_three='$product_image_three',
                product_price='$product_price',
                date=NOW() 
            WHERE product_id = $edit_id";

        $update_product_result = mysqli_query($con,$update_product_query);
        if($update_product_result){
            echo "<script>window.alert('Product updated successfully');</script>";
            echo "<script>window.open('./index.php?view_products','_self');</script>";
        }
    }
}
?>

<!-- Bootstrap Styled Edit Form -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">✏️ Edit Product</h3>
                </div>
                <div class="card-body p-4">
                    <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-3">
                        
                        <div>
                            <label for="product_title" class="form-label fw-semibold">Product Title</label>
                            <input type="text" name="product_title" id="product_title" 
                                class="form-control" required 
                                value="<?php echo $product_title;?>">
                        </div>

                        <div>
                            <label for="product_description" class="form-label fw-semibold">Description</label>
                            <textarea name="product_description" id="product_description" 
                                class="form-control" rows="2" required><?php echo $product_description;?></textarea>
                        </div>

                        <div>
                            <label for="product_keywords" class="form-label fw-semibold">Keywords</label>
                            <input type="text" name="product_keywords" id="product_keywords" 
                                class="form-control" required 
                                value="<?php echo $product_keywords;?>">
                        </div>

                        <div>
                            <label for="product_category" class="form-label fw-semibold">Category</label>
                            <select name="product_category" id="product_category" class="form-select" required>
                                <?php
                                $select_category_query_all = "SELECT * FROM `categories`";
                                $select_category_result_all = mysqli_query($con,$select_category_query_all);
                                while($fetch_category_name_all = mysqli_fetch_array($select_category_result_all)){
                                    $category_name_is_all = $fetch_category_name_all['category_title'];
                                    $category_id_is_all = $fetch_category_name_all['category_id'];
                                    echo $category_id_is_all == $category_id ? "
                                    <option value='$category_id_is_all' selected>$category_name_is_all</option>
                                    " : "
                                    <option value='$category_id_is_all'>$category_name_is_all</option>
                                    ";
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="product_brand" class="form-label fw-semibold">Brand</label>
                            <select name="product_brand" id="product_brand" class="form-select" required>
                                <?php
                                $select_brand_query_all = "SELECT * FROM `brands`";
                                $select_brand_result_all = mysqli_query($con,$select_brand_query_all);
                                while($fetch_brand_name_all = mysqli_fetch_array($select_brand_result_all)){
                                    $brand_name_is_all = $fetch_brand_name_all['brand_title'];
                                    $brand_id_is_all = $fetch_brand_name_all['brand_id'];
                                    echo $brand_id_is_all == $brand_id ? "
                                    <option value='$brand_id_is_all' selected>$brand_name_is_all</option>
                                    " : "
                                    <option value='$brand_id_is_all'>$brand_name_is_all</option>
                                    ";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Images -->
                        <div>
                            <label for="product_image_one" class="form-label fw-semibold">Image 1</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="file" name="product_image_one" id="product_image_one" class="form-control">
                                <img src="./product_images/<?php echo $product_image_one_old;?>" 
                                    alt="<?php echo $product_title;?>" 
                                    class="img-thumbnail rounded" width="90">
                            </div>
                        </div>

                        <div>
                            <label for="product_image_two" class="form-label fw-semibold">Image 2</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="file" name="product_image_two" id="product_image_two" class="form-control">
                                <img src="./product_images/<?php echo $product_image_two_old;?>" 
                                    alt="<?php echo $product_title;?>" 
                                    class="img-thumbnail rounded" width="90">
                            </div>
                        </div>

                        <div>
                            <label for="product_image_three" class="form-label fw-semibold">Image 3</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="file" name="product_image_three" id="product_image_three" class="form-control">
                                <img src="./product_images/<?php echo $product_image_three_old;?>" 
                                    alt="<?php echo $product_title;?>" 
                                    class="img-thumbnail rounded" width="90">
                            </div>
                        </div>

                        <div>
                            <label for="product_price" class="form-label fw-semibold">Price ($)</label>
                            <input type="number" name="product_price" id="product_price" 
                                class="form-control" required 
                                value="<?php echo $product_price;?>">
                        </div>

                        <div class="text-center mt-4">
                            <input type="submit" value="💾 Update Product" 
                                class="btn btn-success px-4 fw-semibold" 
                                name="update_product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
