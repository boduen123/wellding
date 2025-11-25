<?php
// fetch all data
if(isset($_GET['edit_brand'])){
    $edit_id = $_GET['edit_brand'];
    $get_data_query = "SELECT * FROM `brands` WHERE brand_id = $edit_id";
    $get_data_result = mysqli_query($con,$get_data_query);
    $row_fetch_data = mysqli_fetch_array($get_data_result);
    $brand_id = $row_fetch_data['brand_id'];
    $brand_title = $row_fetch_data['brand_title'];
}

// edit brand
if(isset($_POST['update_brand'])){
    $brand_title = $_POST['brand_title'];
    
    if(empty($brand_title)){
        echo "<script>window.alert('Please fill the field');</script>";
    }else{
        $update_brand_query = "UPDATE `brands` 
                               SET brand_title='$brand_title' 
                               WHERE brand_id = $edit_id";
        $update_brand_result = mysqli_query($con,$update_brand_query);
        if($update_brand_result){
            echo "<script>window.alert('Brand updated successfully');</script>";
            echo "<script>window.open('./index.php?view_brands','_self');</script>";
        }
    }
}
?>

<!-- Styled Edit Brand Form -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">🏷️ Edit Brand</h3>
                </div>
                <div class="card-body p-4">
                    <form action="" method="post" class="d-flex flex-column gap-3">
                        
                        <div>
                            <label for="brand_title" class="form-label fw-semibold">Brand Title</label>
                            <input type="text" 
                                   name="brand_title" 
                                   id="brand_title" 
                                   class="form-control form-control-lg" 
                                   required 
                                   value="<?php echo $brand_title;?>">
                        </div>

                        <div class="text-center mt-3">
                            <input type="submit" 
                                   value="💾 Update Brand" 
                                   class="btn btn-success px-4 fw-semibold" 
                                   name="update_brand">
                            <a href="./index.php?view_brands" class="btn btn-outline-secondary px-4 ms-2">
                                ❌ Cancel
                            </a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
