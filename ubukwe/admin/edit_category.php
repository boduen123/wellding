<?php
// fetch all data
if(isset($_GET['edit_category'])){
    $edit_id = $_GET['edit_category'];
    $get_data_query = "SELECT * FROM `categories` WHERE category_id = $edit_id";
    $get_data_result = mysqli_query($con,$get_data_query);
    $row_fetch_data = mysqli_fetch_array($get_data_result);
    $category_id = $row_fetch_data['category_id'];
    $category_title = $row_fetch_data['category_title'];
}

// edit category
if(isset($_POST['update_category'])){
    $category_title = $_POST['category_title'];

    if(empty($category_title)){
        echo "<script>window.alert('Please fill the field');</script>";
    }else{
        $update_category_query = "UPDATE `categories` 
                                  SET category_title='$category_title' 
                                  WHERE category_id = $edit_id";
        $update_category_result = mysqli_query($con,$update_category_query);
        if($update_category_result){
            echo "<script>window.alert('Category updated successfully');</script>";
            echo "<script>window.open('./index.php?view_categories','_self');</script>";
        }
    }
}
?>

<!-- Styled Edit Category Form -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">📝 Edit Category</h3>
                </div>
                <div class="card-body p-4">
                    <form action="" method="post" class="d-flex flex-column gap-3">
                        
                        <div>
                            <label for="category_title" class="form-label fw-semibold">Category Title</label>
                            <input type="text" 
                                   name="category_title" 
                                   id="category_title" 
                                   class="form-control form-control-lg" 
                                   required 
                                   value="<?php echo $category_title;?>">
                        </div>

                        <div class="text-center mt-3">
                            <input type="submit" 
                                   value="💾 Update Category" 
                                   class="btn btn-success px-4 fw-semibold" 
                                   name="update_category">
                            <a href="./index.php?view_categories" class="btn btn-outline-secondary px-4 ms-2">
                                ❌ Cancel
                            </a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
