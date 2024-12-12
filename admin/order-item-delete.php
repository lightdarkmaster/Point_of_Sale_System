<?php

require '../config/functions.php';

$paramResult = checkParamId('index');
if(is_numeric($paramResult)){

    $indexValue = validate($paramResult);

    if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds'])){
        
        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);

        redirect('orders-create.php', 'Item Removed');
    }else{
        redirect('orders-create.php', 'There is no Item');
    }

}else{
    redirect('orders-create.php', 'Param not Numeric');
}


?>