<?php

require '../config/functions.php';

$paramResultId =  checkParamId('id');

if(is_numeric($paramResultId)){
    $productId = validate($paramResultId);
    //echo $productId;

    $product = getById('products',$productId);

    if($product['status'] == 200){

        $productDeleteRes = delete('products', $productId);
        if($productDeleteRes){

            $deleteImage = "../".$product['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }
            redirect('products.php','Product Deleted Successfully');

        }else{
            redirect('products.php', $product['message']);

        }
    }else{
        redirect('products.php', $product['message']);
    }

}else{
    redirect('products.php', 'Something Went Wrong');
}


?>