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

    $users = array_column($useremail['table_user'],'email');

    // Find the row with the equivalent email
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }

    return null; // User not found
}

// Function to update user password using API
function updateUserPassword($userurl, $email, $password) {
    $url = $userurl . '?email=' . urlencode($email);
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
        echo "Password update successful.";
        exit();
    } else {
        echo "Password update failed. Error: " . $response;
        exit();
    }
}

include_once dirname(__FILE__, 5) . "/helpers/db.php";

if (isset($_POST['email'], $_POST['current-password'], $_POST['new-password'])) {
    $email = $_POST['email'];
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];

    // Check if user exists by fetching user data using API
    $user = getUserData($userurl, $email);
    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Verify current password
    $currentPasswordCorrect = password_verify($currentPassword, $user['password']);
    if (!$currentPasswordCorrect) {
        echo "Current password is incorrect.";
        exit();
    }

    // Update password using API
    updateUserPassword($userurl, $email, password_hash($newPassword, PASSWORD_DEFAULT));
}
?>



//this function is for changing the password of the user in which it based on the user email, it will update the table on the database.
session_start();
include_once dirname(__FILE__, 4) . "/helpers/db.php";


if (isset($_POST['email'], $_POST['otp'], $_POST['password'])) {
    
    $otp = $_POST['otp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


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


    // check if the OTP entered by the user matches the one sent to their email
    if ($otp == $_SESSION['verification_code']) {
        // the OTP is valid, so clear the session and return a success message

        // update password
        $update_query = "UPDATE table_user SET password = $1 WHERE email = $2";
        $stmt = pg_prepare($conn, "update_password", $update_query);
        $result = pg_execute($conn, "update_password", array($hashedPassword, $email));

        // check if the update was successful
        if ($result) {
            echo "successful";
            unset($_SESSION['verification_code']);
            exit();

        } else {
            echo "failure";
            unset($_SESSION['verification_code']);
            exit();
        }

    } else {
        // the OTP is invalid, so return an error message
        echo "The OTP you entered is incorrect. Please try again.";
        exit();
    }
}
