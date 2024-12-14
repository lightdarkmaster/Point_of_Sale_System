<?php

include('includes/header.php');

if (!isset($_SESSION['productItems'])) {
    echo '<script> window.location.href = "orders-create.php";   </script>';
}

?>



<!-- Modal -->
<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

        <div class="mb-3 p-4">
            <h5 id="orderPlaceSuccessMessage"></h5>
        </div>

        <a href="orders.php" class="btn btn-secondary">Close</a>
        <button type="button" class="btn btn-danger" onclick="printMyBillingArea()">Print</button>
        <button type="button" class="btn btn-primary" onclick="downloadPDF('<?= $_SESSION['invoice_no'];?>')">Download</button>


      </div>
    </div>
  </div>
</div>




<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="mb-0">Order Summary
                        <a href="orders-create.php" class="btn btn-danger float-end">Back to create order</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php alertMessage();  ?>

                    <div id="myBillingArea">

                        <?php

                        if (isset($_SESSION['cphone'])) {

                            $phone = validate($_SESSION['cphone']);
                            $invoiceNo = validate($_SESSION['invoice_no']);

                            $customerQuery = mysqli_query($conn, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
                            if ($customerQuery) {
                                if (mysqli_num_rows($customerQuery) > 0) {

                                    $cRowData = mysqli_fetch_assoc($customerQuery);
                        ?>
                                    <table style="width: 100%; margin-bottom: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;" colspan="2">
                                                    <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding:0">Infinite Horizon Co. </h4>
                                                    <p style="font-size: 16px; line-height: 24px; margin:2px; padding:0;">Zone 4 Sta. Fe, Leyte Philippines</p>
                                                    <p style="font-size: 16px; line-height: 24px; margin:2px; padding:0;">ZenithWave Industries .ltd</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding:0">Customer Details</h5>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Name: <?= $cRowData['name'] ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Phone No: <?= $cRowData['phone'] ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Customer Email ID: <?= $cRowData['email'] ?> </p>
                                                </td>
                                                <!--       </tr>
                                            <tr>   -->
                                                <td align="end">
                                                    <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding:0">Invoice Details</h5>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Invoice No: <?= $invoiceNo; ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Invoice Date: <?= date('d M Y'); ?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:0px; padding:0;">Address: Zone 4 National Road Sta. Fe, Leyte</p>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                        <?php
                                } else {
                                    echo '<h5> No Customers Found</h5>';
                                }
                            }
                        } else {
                        }


                        ?>


                        <?php

                        if (isset($_SESSION['productItems'])) {
                            $sessionProducts = $_SESSION['productItems'];
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
                                        $totalAmount = 0;
                                        foreach ($sessionProducts as $key => $row) :
                                            $totalAmount += $row['price'] * $row['quantity']
                                        ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"> <?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;">Php. <?= number_format($row['price'], 2); ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['quantity']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;">Php. 
                                                    <?= number_format($row['price'] * $row['quantity'], 2); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach;  ?>

                                        <tr>
                                            <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                            <td colspan="1" style="font-weight: bold; color: red; font-size: 16px;">Php. <?= number_format($totalAmount, 01); ?>0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Payment Method: <?= $_SESSION['payment_mode']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        <?php
                        } else {
                            echo '<h5 class="text-center"> No Items Added </h5>';
                        }

                        ?>

                    </div>

                    <?php if(isset($_SESSION['productItems'])):?>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-primary px-4 mx-1" id="saveOrder">Save</button>
                    </div>

                    <?php endif;  ?>

                </div>
            </div>
        </div>
    </div>

</div>






<?php include('includes/footer.php'); ?>