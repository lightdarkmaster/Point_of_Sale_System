<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

        <div class="sb-sidenav-menu">

            <div class="nav">

                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="orders-create.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                    Create Order
                </a>
                <a class="nav-link" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-shopify"></i></div>
                    View Order
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="categories-create.php">Create Category</a>
                        <a class="nav-link" href="categories.php">Categories</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="products-create.php">Add Products</a>
                        <a class="nav-link" href="products.php">View Products</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseCustomers" aria-expanded="false"
                    aria-controls="collapseCustomers">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></i></div>
                    Customer
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="customers-create.php">Add Customer</a>
                        <a class="nav-link" href="customers.php">View Customer</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Users</div>

                <a class="nav-link collapsed" href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseAdmins" aria-expanded="false"
                    aria-controls="collapseAdmins">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></i></div>
                    Admins/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admins-create.php">Add Admins</a>
                        <a class="nav-link" href="admins.php">View Admins</a>
                    </nav>
                </div>
                <a class="nav-link" href="../logout.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                    Log-Out
                </a>


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:
                <i class="fas fa-user fa-fw"></i>
                <?= $_SESSION['loggedInUser']['name']; ?>
            </div>
        </div>
    </nav>
</div>