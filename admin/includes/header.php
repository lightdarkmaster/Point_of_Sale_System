<?php  
require '../config/functions.php';
require 'authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Point of Sale</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/mystyle.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="icon" type="image/png" href="assets/img/poslogo.jpg">
    </head>
    <body class="sb-nav-fixed"> 

<?php include('navbar.php')?>

<div id="layoutSidenav">
<?php include('sidebar.php')?>
<div id="layoutSidenav_content">
<main>
