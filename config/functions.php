<?php
session_start();

require 'dbcon.php';

//pag validate han data
function validate($inputData){
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

//pag redirect tikang ha usa na page ha iba na page
function redirect($url, $status){
    $_SESSION['status'] = $status;
    header('Location: '.$url);
    exit(0);
}


//pag display message or status pagkatapos hin bisan ano na process
function alertMessage(){
    if(isset($_SESSION['status'])){
         $_SESSION['status'];
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h6>'.$_SESSION['status'].'</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);
}
}


//Pag insert hin record

function insert($tableName, $data){

    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_keys($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("', '",$values)."'";

    $query = "INSERT INTO $table () VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

//pag update han data
function update($tableName, $id, $data){
    
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach($data as $column => $value){

        $updateDataString .=$column.'='."'value',";
    }

    $finalUpdatedData = substr(trim($updateDataString),0,-1);

    $query = "UPDATE $table SET $finalUpdatedData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

//pagkuha tanan na record
    function getAll($tableName, $status = NULL){
        
        global $conn;

        $table = validate($tableName);
        $status = validate($status);

        if($status == 'status'){
            $query = "SELECT * FROM $table WHERE status='0'";
        }else{
            $query = "SELECT * FROM $table";
        }
        return mysqli_query($conn, $query);
    }

    function getById($tableName, $id){

        global $conn;

        $table = validate($tableName);
        $id = validate($id);

        $query = "SELECT * FROM $table WHERE ID='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result){

            if(mysqli_num_rows($result) == 1){

                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $row = mysqli_fetch_assoc($result);
                $response = [
                    'status' => 404,
                    'data' => $row,
                    'message' => 'Record Found'
                ];

            }else{
                $response = [
                    'status' => 404,
                    'message' => 'No Data Found'
                ];
            }

        }else{
            $response = [
                'status' => 500,
                'message' => 'Something Went Wrong'
            ];
            return $response;
        }
    }

    function delete($tableName, $id){

        global $conn;

        $table = validate($tableName);
        $id = validate($id);

        $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        return $result;
    }
?>