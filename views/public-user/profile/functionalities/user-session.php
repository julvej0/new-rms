<?php
//NOTE: Using @ to suppress errors hides the notice about another session_start.
@session_start();

include dirname(__FILE__, 5) . './helpers/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: ../../../views/public-user/home/home.php");
    exit;
}

// Fetch user details from the database
$userEmail = $_SESSION['user_email'];

$userJson = file_get_contents($userurl); // Assuming $userurl is defined elsewhere

$user = json_decode($userJson, true);
$users = array_column($user['table_user'], 'email'); // Assuming $userdata is defined elsewhere

// Check if $userEmail is in $users
if (!in_array($userEmail, $users)) {
    echo "User not found.";
    header("Location: ../../login/login.php");
    exit;
} else {
    foreach ($user['table_user'] as $users) {
        $email = $users['email'];
        if ($userEmail === $email) {

            $user = $users;
        }
    }
}

?>