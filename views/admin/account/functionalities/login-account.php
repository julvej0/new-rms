<?php 
session_start();
include_once "../../../../db/db.php";

if (isset($_POST['email'], $_POST['password'] )) {
    $email = $_POST['email'];
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
            // store user ID in session variable
            $_SESSION['user_email'] = $user['email'];

            // check account type and redirect accordingly
            if ($user['account_type'] == 'admin') {
                header("Location: ../../../../account-management/user-profile.php");
            } else {
                echo 'success';
                
            }
            exit();
        } else {
            //sweetalert here saying Account Doesn't Exist.
            header("Location: ../login.php");
        }
    } else {
        header("Location: ../login.php");
    }
}
?>
