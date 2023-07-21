<?php 
session_start();
include_once dirname(__FILE__, 4) . "/helpers/db.php";

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
        echo "<script>console.log('password: " . $password . "');</script>";
             
            //create a session
            session_start();
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['account_type'] = $user['account_type'];
            $_SESSION['user_name'] = $user['user_fname'] . " " . $user['user_mname'] . " ". $user['user_lname'];

            // check account type and redirect accordingly
            if ($user['account_type'] === 'Admin') {
                header("Location: ../../admin/dashboard/dashboard.php");
                exit();
            } else {
                header("Location: ../../public-user/home/home.php");
                exit();
            }
        }
        else{
            // header("Location: ../views/login/login.php?login=incorrect");
            echo "<script>console.log('login incorrect: " . $password . " hash: " . $user['password'] . "');</script>";
            exit();
        }
    }
    else{
        // header("Location: ../views/login/login.php?login=notexist");
        echo "<script>console.log('login notexist: " . $password . " hash: " . $user['password'] . "');</script>";
        exit();
    }
}
else {
    header("Location: ../login.php");
    exit();
}
?>