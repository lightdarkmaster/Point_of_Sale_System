<?php include('includes/header.php'); ?>

<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-md-12">
            <h1 class="display-4 fw-bold">Dashboard</h1>
            <?php alertMessage(); ?>
        </div>
    </div>

    <!-- First Row -->
    <div class="row text-center g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Total Categories</p>
                    <h5 class="fw-bold text-primary"><?= getCount('categories') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Total Products</p>
                    <h5 class="fw-bold text-primary"><?= getCount('products') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Total Orders</p>
                    <h5 class="fw-bold text-primary"><?= getCount('orders') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Customers</p>
                    <h5 class="fw-bold text-primary"><?= getCount('customers') ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row text-center g-4 mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Total Orders</p>
                    <h5 class="fw-bold text-primary"><?= getCount('orders') ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted text-uppercase fw-bold">Admins</p>
                    <h5 class="fw-bold text-primary"><?= getCount('admins') ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
