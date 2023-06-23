<?php
//this is for the the destroying the session of the user, when he/she logged out.
    session_start();
    //if he/she is an admin it will go to login page, else it wiould go to the home page which is for the public-users.
    if($_SESSION['account_type'] == 'admin'){
        session_destroy();
        header('Location: ../login.php');
    }
    else{
        session_destroy();
        header('Location: ../../views/public-user/home/home.php');
    }
?>
