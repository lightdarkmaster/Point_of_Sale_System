<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Orders View
                <a href="orders-view-print.php?track=<?= $_GET['track'] ?>" class="btn btn-info btn-sm mx-2 float-end">Print</a>
                <a href="orders.php" class="btn btn-danger btn-sm mx-2 float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">

            <?php alertMessage(); ?>
            <?php
            if (isset($_GET['track'])) {
                if($_GET['track'] == ''){
                    ?>
                    <div class="text-center py-5">
                        <div>
                            <h5> No Tracking Number Found</h5>
                        </div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Go Back to Order</a>
                    </div>
                    <?php
                    return false;
                }

                $trackingNo = validate($_GET['track']);

                $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id AND tracking_no='$trackingNo' ORDER BY o.id DESC";
                $orders = mysqli_query($conn, $query);
                if ($orders) {
                    if (mysqli_num_rows($orders) > 0) {
                        $orderData = mysqli_fetch_assoc($orders);
                        $orderId = $orderData['id'];
            ?>
                        <div class="card card-body shadow border-1 mb-4">
                            <div class="row">

                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <label class="mb-1 ">
                                        Tracking No: <span class="fw-bold"><?= $orderData['tracking_no']; ?></span>
                                    </label>
                                    <br />
                                    <label class="mb-1 ">
                                        Order Date: <span class="fw-bold"><?= $orderData['order_date']; ?></span>
                                    </label>
                                    <br />
                                    <label class="mb-1 ">
                                        Order Status: <span class="fw-bold"><?= $orderData['order_status']; ?></span>
                                    </label>
                                    <br />
                                    <label class="mb-1 ">
                                        Payment Mode: <span class="fw-bold"><?= $orderData['payment_mode']; ?></span>
                                    </label>
                                    <br />
                                </div>
                                <div class="col-md-6">
                                    <h4>User Details</h4>
                                    <label class="mb-1 ">
                                        Full Name: <span class="fw-bold"><?= $orderData['name']; ?></span>
                                    </label>
                                    <br />
                                    <label class="mb-1 ">
                                        Email Address: <span class="fw-bold"><?= $orderData['email']; ?></span>
                                    </label>
                                    <br />
                                    <label class="mb-1 ">
                                        Phone Number: <span class="fw-bold"><?= $orderData['phone']; ?></span>
                                    </label>
                                    <br />
                                </div>

                            </div>
                        </div>
                        <?php

                        $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* 
                            FROM orders as o, order_items as oi, products as p 
                            WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.tracking_no='$trackingNo'";

                        $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                        if ($orderItemsRes) {
                            if (mysqli_num_rows($orderItemsRes) > 0) {
                        ?>
                                <h4 class="mt-3">Order Items Details</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Product</th>
                                            <th class="text-center"> Unit Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($orderItemsRes as $orderItemsRows) : ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= $orderItemsRows['image'] != '' ? '../' . $orderItemsRows['image'] : '../assets/images/no-img.jpg'; ?>" style="width:50px;height:50px;"
                                                        alt="Image" />

                                                    <?= $orderItemsRows['name']; ?>
                                                </td>
                                                <td width="15%" class="text-left">Php. 
                                                    <?= number_format($orderItemsRows['orderItemPrice'], 01)   ?>0
                                                </td>
                                                <td width="15%" class="text-center">
                                                    <?= $orderItemsRows['orderItemQuantity'];  ?>
                                                </td>
                                                <td width="15%" class="text-left">Php. 
                                                    <?= number_format($orderItemsRows['orderItemPrice']*$orderItemsRows['orderItemQuantity'], 01)   ?>0
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <tr>
                                            <td class=" fw-bold fs-20" style="background:black;color:white;">Total Payable :</td>
                                            <td colspan="3" class="text-end fw-bold"style="background:black;color:white;">Php. <?= number_format($orderItemsRows['total_amount'], 01); ?>0</td>
                                        </tr>

                                    </tbody>

                                </table>
                        <?php

                            } else {
                                echo '<h5>Something Went Wrong</h5>';
                                return false;
                            }
                        } else {
                            echo '<h5>Something Went Wrong beef </h5>';
                            return false;
                        }
                        ?>
            <?php
                    } else {
                        echo '<h5> No Record Found </h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Something Went Wrong</h5>';
                }
            }else{
                ?>
                <div class="text-center py-5">
                    <div>
                        <h5> No Tracking Number Found</h5>
                    </div>
                    <a href="orders.php" class="btn btn-primary mt-4 w-25">Go Back to Order</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>



<?php include('includes/footer.php'); ?>