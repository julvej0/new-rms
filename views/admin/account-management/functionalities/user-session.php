<?php
session_start();
require_once dirname(__FILE__, 5) . "/helpers/db.php";
require_once dirname(__FILE__, 4) . "/helpers/utils.php";

echo ("<script>console.log('user_email: " . $_SESSION['user_email'] . "');</script>");
// Check if the user is logged in as an admin
if ($_SESSION['account_type'] != 'Admin') {
    header("Location: ../../../views/public-user/home/home.php");
    exit;
}

// Fetch user details from the API
$user_id = getUserIdByEmail($userurl, $_SESSION['user_email']);

$user = getUserByEmail($userurl, $_SESSION['user_email']);

if ($user_id === null) {
    echo "User not found.";
    header("Location: ../../login/login.php");
    exit;
}

// Store the user_id in a session variable
$_SESSION['user_id'] = $user_id;

?>