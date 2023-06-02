<?php
session_start();
include_once dirname(__FILE__, 4) . "/helpers/db.php";

if (isset($_POST['email'], $_POST['otp'], $_POST['srcode'], $_POST['password'], $_POST['fname'], $_POST['lname'], $_POST['mname'])) {

    $mname = $_POST['mname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $otp = $_POST['otp'];
    $srcode = $_POST['srcode'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $accountType = 'Regular';

    // check if the OTP entered by the user matches the one sent to their email
    if ($otp == $_SESSION['verification_code']) {
        // the OTP is valid, so clear the session and return a success message

        // insert new record
        $insert_query = "INSERT INTO table_user (sr_code, email, password, account_type, user_fname, user_lname, user_mname) VALUES ($1, $2, $3, $4, $5, $6, $7)";
        $insert_stmt = pg_prepare($conn, "insert_user", $insert_query);
        $insert_result = pg_execute($conn, "insert_user", array($srcode, $email, $hashedPassword, $accountType, $fname, $lname, $mname));

        if ($insert_result) {
            echo "success";
            unset($_SESSION['verification_code']);

        } else {
            echo "fail";
            unset($_SESSION['verification_code']);
        }


    } else {
        // the OTP is invalid, so return an error message
        echo "The OTP you entered is incorrect. Please try again.";
    }
}
?>