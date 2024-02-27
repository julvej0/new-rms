<?php

function getUserId($userurl, $tableData)
{
    $response = file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        $userId = $user['user_id'];
        if ($user['email'] === $tableData || $user['sr_code'] === $tableData) {
            return $userId;
        }
    }

    return null; // User not found
}


// Function to update user password using API
function updateUserById($userurl, $userId, $userData, $string)
{
    $url = $userurl . '/' . $userId;
    $data = json_encode([$string => $userData]);
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

    return $httpCode;
}