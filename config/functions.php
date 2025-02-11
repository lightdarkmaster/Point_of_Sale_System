<?php
session_start();
//import database connection
require 'dbcon.php';

//pag validate han data
function validate($inputData) {
    global $conn;
    if (isset($inputData) && is_string($inputData)) {
        $validatedData = mysqli_real_escape_string($conn, $inputData);
        return trim($validatedData);
    }
    return $inputData;
}
//pag redirect to other page ngan status
function redirect($url, $status) {
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}
//pag display alertmessages
function alertMessage() {
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h6>' . $_SESSION['status'] . '</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);
    }
}
//pag insert hin data ha table
function insert($tableName, $data) {
    global $conn;

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("', '", array_map('validate', $values)) . "'";

    $query = "INSERT INTO $tableName ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}
//pag update han data ha table
function update($tableName, $id, $data) {
    global $conn;

    $updateDataString = "";

    foreach ($data as $column => $value) {
        $updateDataString .= $column . "='" . validate($value) . "',";
    }

    $finalUpdatedData = rtrim($updateDataString, ',');

    $query = "UPDATE $tableName SET $finalUpdatedData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}
//pag kuha tanan na data ha database table
function getAll($tableName, $status = null) {
    global $conn;

    if ($status == 'active') {
        $query = "SELECT * FROM $tableName WHERE status='0'";
    } else {
        $query = "SELECT * FROM $tableName";
    }
    return mysqli_query($conn, $query);
}
//pag kuha hin specific na data ha table gamit hin id
function getById($tableName, $id) {
    global $conn;

    $query = "SELECT * FROM $tableName WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return [
                'status' => 200,
                'data' => $row,
                'message' => 'Record Found',
            ];
        } else {
            return ['status' => 404, 'message' => 'No Data Found'];
        }
    }
    return ['status' => 500, 'message' => 'Something Went Wrong'];
}
//pag delete hin data ha database
function delete($tableName, $id) {
    global $conn;

    $query = "DELETE FROM $tableName WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

//pag check han parameter ID
function checkParamId($type){
    if(isset($_GET[$type])){
        if($_GET[$type] != ''){
            return $_GET[$type];
        }else{
        return '<h5>No ID is Found</h5>';

        }

    }else{
        return '<h5>No ID is Given</h5>';
    }
}

//pag logout han user
function logoutSession(){

    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggedInUser']);

}
//pag display hin json response
function jsonResponse($status, $status_type, $message){

    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}
//pagkuha han values kada table gin gamit ko ha dashboard la, amo la nak gamitan
function getCount($tableName){
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $tableName";

    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    }else{
        return 'Something Went Wrong';
    }
}
//done na nga yaing..
?>


