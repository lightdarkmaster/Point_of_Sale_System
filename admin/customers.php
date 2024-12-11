<?php include('includes/header.php');?>

<div class="row col-md-12">
    <div class="container-fluid px-4">
    
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Customers
                <a href="customers-create.php" class="btn btn-primary float-end">Add Customer</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage();  ?>
    
        <?php
            $customers = getAll('customers');
            if(!$customers){
                echo '<h4> Something Went Wrong!</h4>';
                return false;
            }
    
            if(mysqli_num_rows($customers) > 0){
    
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($customers as $item)  :
                        ?>
                        <tr>
                            <td><?= $item['id']   ?></td>
                            <td><?= $item['name']   ?></td>
                            <td><?= $item['email']   ?></td>
                            <td><?= $item['phone']   ?></td>
    
    
                            <td>
                                <?php
    
                                if($item['status'] == 1){
    
                                    echo '<span class="badge bg-danger">Inactive</span>';
                                }else{
                                    echo '<span class="badge bg-primary">Active</span>';
                                }
    
                                ?>
                            </td>
    
                            <td>
                                <a href="customers-edit.php?id=<?= $item['id']; ?>"class="btn btn-success btn-sm">Edit</a>
                                <a href="customers-delete.php?id=<?= $item['id']; ?>"class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
                }else{
                    ?>
                    <h4 class="mb-0">No Record Found</h4>
                    <?php
                    }
                ?>
        </div>
    </div>
    
    </div>
</div>


<?php include('includes/footer.php');?>