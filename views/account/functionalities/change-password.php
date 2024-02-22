<?php
session_start();
// Function to fetch user data using API
function getUserData($userurl, $email) {
    $response = file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $useremail = json_decode($response, true);
    $userEmail = array_column($useremail['table_user'],'email');
    $userId = array_column($useremail['table_user'],'user_id');
    $users = array_combine($userEmail, $userId);
    // Find the row with the equivalent email
    foreach ($users as $user => $id) {
        if ($user === $email) {
            return $id;
        }
    }

    return null; // User not found
}

// Function to update user password using API
function updateUserPassword($userurl, $user, $password) {
    $url = $userurl . "/" . $user;
    $data = json_encode(['password' => $password]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        echo "successful";
        exit();
    } else {
        echo "Password update failed. Error: " . $response;
        exit();
    }
}
include_once dirname(__FILE__, 5) . '\new-rms-webdev\helpers\db.php';

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $newPassword = $_POST['password'];
    // Check if user exists by fetching user data using API
    $user = getUserData($userurl, $email);

    // Update password using API
    updateUserPassword($userurl, $user, password_hash($newPassword, PASSWORD_DEFAULT));
     
}
?>