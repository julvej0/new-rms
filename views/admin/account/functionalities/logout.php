<?php
    session_start();
    if($_SESSION['account_type'] == 'admin'){
        session_destroy();
        header('Location: ../login.php');
    }
    else{
        session_destroy();
        header('Location: ../../../../views/public-user/home/home.php');
    }
    

    


?>
