<?php include('includes/header.php'); ?>
<div class="container-fluid px-4">

    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Print Order
                <a href="orders.php" class="btn btn-danger btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <div id="myBillingArea">
                <?php
                if (isset($_GET['track'])) {
                    $trackingNo = validate($_GET['track']);
                    if ($trackingNo == '') {
                ?>
                        <div class="text-center py-5">
                            <div>
                                <h5> Please Provide Tracking Number </h5>
                            </div>
                            <a href="orders.php" class="btn btn-primary mt-4 w-25">Go Back to Order</a>
                        </div>
                    <?php
                    }
                    $orderQuery = "SELECT o.*,c.* FROM orders o, customers c WHERE c.id=o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
                    $orderQueryRes = mysqli_query($conn, $orderQuery);
                    if (!$orderQueryRes) {
                        echo "<h5>Something Went Wrong</h5>";
                        return false;
                    }
                    if (mysqli_num_rows($orderQueryRes) > 0) {
                        $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                    ?>
                        <table style="width: 100%; margin-bottom: 20px">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" colspan="2">
                                        <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding:0">Mr. Chan Marketing</h4>
                                        <p style="font-size: 16px; line-height: 24px; margin:2px; padding:0;">Zone 4 Sta. Fe, Leyte Philippines</p>
                                        <p style="font-size: 16px; line-height: 24px; margin:2px; padding:0;">Mr. Chan Mktg. ltd.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding:0">Customer Details</h5>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Name: <?= $orderDataRow['name'] ?> </p>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Phone No: <?= $orderDataRow['phone'] ?> </p>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Email ID: <?= $orderDataRow['email'] ?> </p>
                                    </td>
                                    <!--       </tr>
                                                <tr>   -->
                                    <td align="end">
                                        <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding:0">Invoice Details</h5>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Invoice No: <?= $orderDataRow['invoice_no'] ?> </p>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Invoice Date: <?= date('d M Y'); ?></p>
                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Address: Zone 4 National Road Sta. Fe, Leyte</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<h5>No Records Found</h5>";
                        return false;
                    }
                    $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.*
                        FROM orders o, order_items oi, products p
                        WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$trackingNo' ";
                    $orderItemQueryRes = mysqli_query($conn, $orderItemQuery);
                    if ($orderItemQueryRes) {
                        if (mysqli_num_rows($orderItemQueryRes) > 0) {
                        ?>
                            <div class="table-responsive mb-3">
                                <table style="width: 100%;" cellpadding="5">
                                    <thead>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Price</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($orderItemQueryRes as $key => $row) :
                                        ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"> <?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;">Php. <?= number_format($row['orderItemPrice'], 01); ?>0</td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;">Php.
                                                    <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 01); ?>0
                                                </td>
                                            </tr>
                                        <?php endforeach;  ?>
                                        <tr>
                                            <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                            <td colspan="1" style="font-weight: bold; color: red; font-size: 16px;">Php. <?= number_format($row['total_amount'], 01); ?>0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Payment Method: <?= $row['payment_mode']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <?php
                        } else {
                            echo "<h5>No Data Found</h5>";
                            return false;
                        }
                    } else {
                        echo "<h5>Something Went Wrong beef</h5>";
                        return false;
                    }
                } else {
                    ?>
                    <div class="text-center py-5">
                        <div>
                            <h5> No Tracking Number Parameter Found</h5>
                        </div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Go Back to Order</a>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="mt-4 text-end">
                <button class="btn btn-info px-1 mx-3" style="width: 100px;" onclick="printMyBillingArea()">Print</button>
                <button class="btn btn-primary px-1 mx-3" onclick="downloadPDF('<?= $orderDataRow['invoice_no'] ?>')">Download PDF</button>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>