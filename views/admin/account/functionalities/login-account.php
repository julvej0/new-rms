<?php 
session_start();
include_once "../../../../db/db.php";


if (isset($_POST['login'] )) {
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];

    // fetch existing account
    $fetch_query = "SELECT * FROM table_user WHERE email = $1";
    $fetch_result = pg_query_params($conn, $fetch_query, array($email));
    if (!$fetch_result) {
        echo "An error occurred: " . pg_last_error($conn);
        exit;
    }

    // check if user exists and compare hashed passwords
    if (pg_num_rows($fetch_result) > 0) {
        $user = pg_fetch_assoc($fetch_result);
        
        if (password_verify($password, $user['password'])) {
             
            //create a session
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['account_type'] = $user['account_type'];
            $_SESSION['user_name'] = $user['user_fname'] . " " . $user['user_mname'] . " ". $user['user_lname'];
            

            // check account type and redirect accordingly
            if ($user['account_type'] === 'Admin') {
                header("Location: ../../../../views/admin/dashboard/dashboard.php");
                exit();
            } else {
                header("Location: ../../../../views/public-user/home/home.php");
                exit();
            }
        }
        else{
            header("Location: ../../../../views/admin/account/login.php?login=incorrect");
            exit();
        }
    }
    else{
        header("Location: ../../../../views/admin/account/login.php?login=notexist");
        exit();
    }
}
else {
    header("Location: ../login.php");
    exit();
}
?>
