<?php

require '../config/functions.php';

$paramResultId =  checkParamId('id');

if(is_numeric($paramResultId)){
    $customerId = validate($paramResultId);
    //echo $customerId;

    $customer = getById('customers',$customerId);

    if($customer['status'] == 200){

        $customerDeleteRes = delete('customers', $customerId);
        if($customerDeleteRes){
            redirect('customers.php','Customer Deleted Successfully');

        }else{
            redirect('customers.php', $customer['message']);

        }
    }else{
        redirect('customers.php', $customer['message']);
    }

}else{
    redirect('customers.php', 'Something Went Wrong');
}


?>