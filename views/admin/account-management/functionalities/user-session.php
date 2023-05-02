<?php
session_start();
include_once "../../../db/db.php";

// check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../../../../admin/account/login.php");
    exit();
}

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
    exit;
}
?>
