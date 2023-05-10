<?php
session_start();
include_once "../../../db/db.php";

// check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../admin/account/login.php");
    session_destroy();
    exit();
}

// // check if user has admin access
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     header("Location: ../../admin/account/login.php");
//     session_destroy();
//     exit();
// }


// // check if accessed through valid entry point
// $referrer = $_SERVER['HTTP_REFERER'];
// $valid_entry_point = "http://localhost/new-rms-webdev/views/admin/account/login.php"; // replace with your actual login page URL

// if ($referrer !== $valid_entry_point) {
//     header("Location: ../../admin/account/login.php");
//     session_destroy();
//     exit();
// }

// fetch user details from database
$user_query = "SELECT * FROM table_user WHERE email = $1";
$user_result = pg_query_params($conn, $user_query, array($_SESSION['user_email']));
if (!$user_result) {
    echo "An error occurred: " . pg_last_error($conn);
    exit;
}
$user = pg_fetch_assoc($user_result);

if (!$user) {
    echo "User not found.";
    header("Location: ../../admin/account/login.php");
    exit;
}

?>
