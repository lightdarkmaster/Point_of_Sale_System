<?php include('includes/header.php'); ?>

<div class="container container-xxl mt-3 mb-2 shadow" style="background:amber;width:100%;height:100%;border:0;border-radius: 20px;">
    <div class="container my-5">
        <div class="row text-center mb-5">
            <div class="col-md-12">
                <h1 class="display-4 fw-bold">Dashboard</h1>
                <?php alertMessage(); ?>
            </div>
        </div>

        <!-- First Row -->
        <div class="row text-center g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body text-uppercase fw-bold">Total Categories</div>
                    <h2 class="fw-bold"><?= getCount('categories') ?></h2>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="categories.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body text-uppercase fw-bold">Total Products</div>
                    <h2 class="fw-bold"><?= getCount('products') ?></h2>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="products.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body text-uppercase fw-bold">Total Orders</div>
                    <h2 class="fw-bold"><?= getCount('orders') ?></h2>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="orders.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body text-uppercase fw-bold">Customers</div>
                    <h2 class="fw-bold"><?= getCount('customers') ?></h2>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="customers.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>

            </div>

            <!-- Second Row -->
            <div class="row text-center g-4 mt-4">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Sales
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Orders
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>