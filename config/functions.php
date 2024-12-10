<?php
session_start();

require 'dbcon.php';

function validate($inputData) {
    global $conn;
    if (isset($inputData) && is_string($inputData)) {
        $validatedData = mysqli_real_escape_string($conn, $inputData);
        return trim($validatedData);
    }
    return $inputData;
}

function redirect($url, $status) {
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}

function alertMessage() {
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h6>' . $_SESSION['status'] . '</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);
    }
}

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

function getAll($tableName, $status = null) {
    global $conn;

    if ($status == 'active') {
        $query = "SELECT * FROM $tableName WHERE status='0'";
    } else {
        $query = "SELECT * FROM $tableName";
    }
    return mysqli_query($conn, $query);
}

function getById($tableName, $id) {
    global $conn;

    $query = "SELECT * FROM $tableName WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return [
                'status' => 404,
                'data' => $row,
                'message' => 'Record Found',
            ];
        } else {
            return ['status' => 404, 'message' => 'No Data Found'];
        }
    }
    return ['status' => 500, 'message' => 'Something Went Wrong'];
}

function delete($tableName, $id) {
    global $conn;

    $query = "DELETE FROM $tableName WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>
