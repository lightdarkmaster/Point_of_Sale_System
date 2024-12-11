<?php  

require 'config/functions.php';

if(isset($_SESSION['loggedIn'])){

    logoutSession();
    redirect('login.php', 'Logged Out Successfully');
}


?>