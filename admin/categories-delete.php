<?php

require '../config/functions.php';

$paramResultId =  checkParamId('id');

if(is_numeric($paramResultId)){
    $catergoryId = validate($paramResultId);
    //echo $catergoryId;

    $category = getById('categories',$catergoryId);

    if($category['status'] == 200){

        $adminDeleteRes = delete('categories', $catergoryId);
        if($adminDeleteRes){
            redirect('categories.php','Category Deleted Successfully');

        }else{
            redirect('categories.php', $category['message']);

        }
    }else{
        redirect('categories.php', $category['message']);
    }

}else{
    redirect('categories.php', 'Something Went Wrong');
}


?>