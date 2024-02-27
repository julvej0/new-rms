<?php
// session_start();
include_once dirname(__FILE__, 5) . "/helpers/db.php";

// Function to fetch user data using API
function getUserData($userurl, $email) {
    $response = file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        $userId = $user['user_id'];
        $userPassword = $user['password'];
        if ($user['email'] === $email) {
            return array('id' => $userId, 'password' => $userPassword);
        }
    }

    return null; // User not found
}

function updateUserPassword($userurl, $user, $password) {
    $url = $userurl . '/' . $user;
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

if (isset($_POST['email'], $_POST['current-password'], $_POST['new-password'])) {
    $email = $_POST['email'];
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];

    // check if user exists
    $user = getUserData($userurl, $email);
    if (!$user) {
        echo "User not found.";
        exit();
    }

    // verify current password
    $currentPasswordCorrect = password_verify($currentPassword, $user['password']);
    if (!$currentPasswordCorrect) {
        echo "incorrect";
        exit();
    }

    // Update password using API
    updateUserPassword($userurl, $user['id'], password_hash($newPassword, PASSWORD_DEFAULT));
}
?>
