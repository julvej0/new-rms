<?php 
session_start();
include_once "../../../../db/db.php";


if (isset($_POST['email'], $_POST['otp'], $_POST['password'])) {
    
    $otp = $_POST['otp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    // check if user exists
    $user_query = "SELECT * FROM table_user WHERE email = $1";
    $user_result = pg_query_params($conn, $user_query, array($email));
    if (!$user_result) {
        echo "An error occurred: " . pg_last_error($conn);
        exit();
    }
    $user = pg_fetch_assoc($user_result);
    if (!$user) {
        echo "User not found.";
        exit();
    }


    // check if the OTP entered by the user matches the one sent to their email
    if ($otp == $_SESSION['verification_code']) {
        // the OTP is valid, so clear the session and return a success message

        // update password
        $update_query = "UPDATE table_user SET password = $1 WHERE email = $2";
        $stmt = pg_prepare($conn, "update_password", $update_query);
        $result = pg_execute($conn, "update_password", array($hashedPassword, $email));

        // check if the update was successful
        if ($result) {
            echo "successful";
            unset($_SESSION['verification_code']);
            exit();

        } else {
            echo "failure";
            unset($_SESSION['verification_code']);
            exit();
        }

    } else {
        // the OTP is invalid, so return an error message
        echo "The OTP you entered is incorrect. Please try again.";
        exit();
    }
}
?>
