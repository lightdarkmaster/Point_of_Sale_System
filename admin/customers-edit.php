<?php include('includes/header.php'); ?>

    <div class="container-fluid px-4">

        <div class="card mt-4 shadow">
            <div class="card-header">
                <h4 class="mb-0">Edit Customer
                    <a href="customers.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?php alertMessage(); ?>

                <form action="code.php" method="POST">

                    <?php

                    $paramValue = checkParamId('id');

                    if (!is_numeric($paramValue)) {
                        echo '<h5>'.$paramValue.'</h5>';
                        return false;
                    }

                    $customer = getById('customers', $paramValue);
                    if ($customer['status'] == 200) {
                    ?>


                    <input type="hidden" name="customerId" value=" <?=$customer['data']['id'];   ?>"/>


                        <div class="row col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="name" value=" <?=$customer['data']['name'];   ?>" required class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Email *</label>
                                <input type="email" name="email" value=" <?=$customer['data']['email'];   ?>" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Phone *</label>
                                <input type="number" name="phone" value="<?=$customer['data']['phone'];?>" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label>Status (UnChecked-Visible, Checked=Hidden)</label>
                                <br />
                                <input type="checkbox" name="status" <?= $customer['data']['status'] == true ? 'checked':'';   ?> style="width:30px;height:30px;" ;/>
                            </div>
                            <br />
                            <div class="col-md-6 mb-3 text-end">
                                <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    <?php
                    
                    } else {
                        echo '<h5>'.$customer['message'].'</h5>';
                    }
                    ?>

                </form>
            </div>
        </div>

    </div>




<?php include('includes/footer.php'); ?>