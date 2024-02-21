<?php
// $userurl = "http://localhost:5000/table_user";
// $ch = curl_init($userurl);
// // $ch = curl_init("http://localhost:5000/table_user");
// $data = json_encode(["password"=>"$2y$10$7E.EiGxMPYnxDnFJYayEWus1zLgy0nx\/JhqfHLvEFwDpZdylF3QqC"]);
// $id = 3;


// // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
// // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// // curl_setopt($ch, CURLOPT_HTTPHEADER, [
// //     'Content-Type: application/json',
// //     'Content-Length: ' . strlen($data)
// // ]);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $response = curl_exec($ch);
// // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); //HTTP_CODE
// curl_close($ch);
// print_r($userurl . "/" . $id);

function getUserData() {
    $userurl = "http://localhost:5000/table_user";
    $email = "20-08137@g.batstate-u.edu.ph";
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

print_r(getUserData());



if (isset($_POST['email'], $_POST['current-password'], $_POST['new-password'])) {
    $email = $_POST['email'];
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];

    try {
        // Check if user exists by fetching user data using API
        $user = getUserData($userurl, $email);

        // Verify current password
        $currentPasswordCorrect = password_verify($currentPassword, $user['password']);
        if (!$currentPasswordCorrect) {
            throw new Exception("Current password is incorrect.");
        }

        // Update password using API
        updateUserPassword($userurl, $email, password_hash($newPassword, PASSWORD_DEFAULT));

        // Password update successful
        echo "Password update successful.";
    } catch (Exception $e) {
        // Handle exceptions
        echo $e->getMessage();
    }
}