<?php
session_start();
include_once dirname(__FILE__, 5) . "/helpers/db.php";

if (isset($_POST['email'], $_POST['current-password'], $_POST['new-password'])) {
    $email = $_POST['email'];
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];

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

    // verify current password
    $currentPasswordCorrect = password_verify($currentPassword, $user['password']);
    if (!$currentPasswordCorrect) {
        echo "Current password is incorrect.";
        exit();
    }

    // update password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $update_query = "UPDATE table_user SET password = $1 WHERE email = $2";
    $stmt = pg_prepare($conn, "update_password", $update_query);
    $result = pg_execute($conn, "update_password", array($hashedPassword, $email));

    // check if the update was successful
    if ($result) {
        echo "successful";
        exit();
    } else {
        echo "failure";
        exit();
    }
}
?>
