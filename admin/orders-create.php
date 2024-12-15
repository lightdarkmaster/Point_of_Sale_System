<?php include('includes/header.php'); ?>



<!-- Modal -->
<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Customer Name</label>
                    <input type="text" class="form-control" id="c_name" />
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="number" class="form-control" id="c_phone" />
                </div>
                <div class="mb-3">
                    <label>Email (optional) </label>
                    <input type="email" class="form-control" id="c_email" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveCustomer">Save</button>
            </div>
        </div>
    </div>
</div>






<div class="row">
    <div class="container-fluid px-4">

        <div class="card mt-4 shadow">
            <div class="card-header">
                <h4 class="mb-0">Create Order
                    <a href="orders.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?php alertMessage(); ?>

                <form action="orders-code.php" method="POST">


                    <div class="row col-md-12">
                        <div class="col-md-3 mb-3">
                            <label for="">Select Product</label>
                            <select name="product_id" class="form-select mySelect2" id="">
                                <option value="">-- SELECT PRODUCT --</option>
                                <?php

                                $products = getAll('products');
                                if ($products) {
                                    if (mysqli_num_rows($products) > 0) {
                                        foreach ($products as $prodItem) {
                                ?>
                                            <option value="<?= $prodItem['id'];  ?>"><?= $prodItem['name'];  ?></option>
                                <?php
                                        }
                                    } else {
                                        echo '<option value="">No Product Found</option>';
                                    }
                                } else {
                                    echo '<option value="">Something Went Wrong</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Quantity</label>
                            <br />
                            <input type="number" name="quantity" value="1" class="form-control" />
                        </div>
                        <div class="col-md-3 mb-3 text-end">
                            <br />
                            <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>




                </form>
            </div>
        </div>

    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h4 class="mb-0">Products</h4>
    </div>
    <div class="card-body">
        <?php

        if (isset($_SESSION['productItems'])) {

            $sessionProducts = $_SESSION['productItems'];

            //pagtangal han table if waray order
            if (empty($sessionProducts)) {

                unset($_SESSION['productItemIds']);
                unset($_SESSION['productItems']);
            }
        ?>
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $grandTotal = 0; // Initialize the grand total

                        foreach ($sessionProducts as $key => $items) :
                            $totalPrice = $items['price'] * $items['quantity'];
                            $grandTotal += $totalPrice; // Add the product total to the grand total
                        ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td class="text-center"><?= $items['name']; ?></td>
                                <td class="text-center">Php. <?= number_format($items['price'], 2); ?></td>
                                <td>
                                    <div class="input-group">
                                        <button class="input-group-text">-</button>
                                        <input type="text" value="<?= $items['quantity']; ?>" class="qty quantityInput" />
                                        <button class="input-group-text">+</button>
                                    </div>
                                </td>
                                <td class="text-center">Php. <?= number_format($totalPrice, 2); ?></td>
                                <td class="text-center">
                                    <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-start fw-bold bg-secondary" style="color:white;">Grand Total:</td>
                            <td colspan="2"class="text-end fw-bold bg-secondary" style="color:white">Php. <?= number_format($grandTotal, 2); ?></td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="mt-2">
                <div class="row">
                    <div class="col-md-4">
                        <label>Select Payment Mode</label>
                        <select id="payment_mode" class="form-select">
                            <option value="">Select Payment</option>
                            <option value="Online Payment">Online Payment</option>
                            <option value="Cash Payment">Cash Payment</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Enter Customer Phone Number</label>
                        <input type="number" id="cphone" class="form-control" value="" />
                    </div>
                    <div class="col-md-4">
                        <br />
                        <button type="button" name="proceedToPlaceBtn" class="btn btn-warning w-50 proceedToPlace">Place Order</button>
                    </div>
                </div>
            </div>
        <?php

        } else {

            echo '<h5>No Items Added</h5>';
        }
        ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>