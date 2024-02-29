<?php
session_start();
require_once dirname(__FILE__, 5) . "/helpers/db.php";

echo ("<script>console.log('user_email: " . $_SESSION['user_email'] . "');</script>");
// Check if the user is logged in as an admin
if ($_SESSION['account_type'] != 'Admin') {
    header("Location: ../../../views/public-user/home/home.php");
    exit;
}

// Fetch user details from the database
$user_query = "SELECT * FROM table_user WHERE email = $1";
$user_result = pg_query_params($conn, $user_query, array($_SESSION['user_email']));
if (!$user_result) {
    echo "An error occurred: " . pg_last_error($conn);
    exit;
}
$user = pg_fetch_assoc($user_result);

if (!$user) {
    echo "User not found.";
    header("Location: ../../login/login.php");
    exit;
}

// Get the user_id from the user details
$user_id = $user['user_id'];

// Store the user_id in a session variable
$_SESSION['user_id'] = $user_id;

?>