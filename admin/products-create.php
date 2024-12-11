<?php include('includes/header.php'); ?>
    <div class="container-fluid px-4">

        <div class="card mt-4 shadow">
            <div class="card-header">
                <h4 class="mb-0">Add Product
                    <a href="products.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage(); ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">

                    <div class="row col-md-12">
                        <div class="col-md-12 mb-3">
                            <label>Select Category</label>
                            <select name="category_id" class="form-select">
                                <options value"">Select Category</options>
                                <?php
                                $categories = getAll('categories');
                                if ($categories) {
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $cateItem) {
                                            echo '<option value="' . $cateItem['id'] . '">' . $cateItem['name'] . '</option>';
                                        }
                                    } else {
                                        echo '<options value"">No Categories Found</options>';
                                    }
                                } else {
                                    echo '<options value"">Something Went Wrong</options>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" required class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Product Description *</label>
                            <textarea name="description" class="form-control" id="" cols="3" rows="5"></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Product Price</label>
                            <input type="text" name="price" required class="form-control" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Product Quantity</label>
                            <input type="text" name="quantity" required class="form-control" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Status (UnChecked-Visible, Checked=Hidden)</label>
                            <br />
                            <input type="checkbox" name="status" style="width:30px;height:30px;" ;>
                        </div>
                        <br />
                        <div class="col-md-6 mb-3 text-end">
                            <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

<?php include('includes/footer.php'); ?>