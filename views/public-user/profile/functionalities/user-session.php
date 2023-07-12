<?php

include dirname(__FILE__, 4) . '/helpers/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../../views/public-user/home/home.php");
    exit;
}

// Fetch user details from the database
$userEmail = $_SESSION['user_email'];

$userJson = file_get_contents($userurl); // Assuming $userurl is defined elsewhere

$user = json_decode($userJson, true);

$users = array_column($userdata['table_user'], 'email'); // Assuming $userdata is defined elsewhere

// Check if $userEmail is in $users
if (!in_array($userEmail, $users)) {
    echo "User not found.";
    header("Location: ../../login/login.php");
    exit;
}

?>




include dirname(__FILE__, 4) . '/helpers/db.php';

// Check if the user is logged in

echo("<script>console.log('user_email: " . $_SESSION['user_email'] . "');</script>");
if (!isset($_SESSION['user_email'])) {
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

