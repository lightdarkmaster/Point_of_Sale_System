<?php

include('../config/functions.php');

if(isset($_POST['saveAdmin'])){

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = validate($_POST['is_ban']) == true ? 1:0;

    $EMAILCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $EMAILCheckQuery);
    if($checkResult){
        if(mysqli_num_rows($checkResult) > 0){
            redirect('admins-edit.php?id'.$adminId, 'Email Already Used try another one');
        }
    }

    if($name != '' && $email != '' && $password != ''){

        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");

        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('admins-create.php', 'Email Already Exists. ');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];

        $result = insert('admins',$data);
        if($result){
            redirect('admins.php', 'Admin Created Sucessfully');
        }else{
            redirect('admins-create.php', 'Something Went Wrong!');
        }

    }else{
        redirect('admins-create.php', 'Please fill required fields. ');
    }

}

if(isset($_POST['updateAdmin'])){   

    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);

    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId,'Please Fill Required fields');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = validate($_POST['is_ban']) == true ? 1:0;

    if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData['data']['password'];
    }

    if($name != '' && $email != ''){

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];

        $result = update('admins',$adminId,$data);
        if($result){
            redirect('admins-edit.php?id='.$adminId, 'Admin Updated Sucessfully');
        }else{
            redirect('admins-create.php', 'Something Went Wrong!');
        }

    }else{
        redirect('admins-edit.php?id='.$adminId,  'Please fill required fields');
    }
}


?>