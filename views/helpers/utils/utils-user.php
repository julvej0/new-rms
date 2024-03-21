<?php

function getUserIdByEmail($userurl, $email)
{
    $response = @file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        $userId = $user['user_id'];
        if ($user['email'] === $email) {
            return $userId;
        }
    }

    return null; // User not found
}

function getUserByEmail($userurl, $email)
{
    $response = @file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }
    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }

    return null; // User not found
}

// function getting user id 
function getUserIdBySrCode($userurl, $srCode)
{
    $response = @file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        $userId = $user['user_id'];
        if ($user['sr_code'] === $srCode) {
            return $userId;
        }
    }

    return null; // User not found
}


// for updating user image
function updateUserImageById($userurl, $userId, $image_path, $string)
{
    $url = $userurl . '/' . $userId;
    $data = json_encode([$string => $image_path]);
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
    if ($httpCode != 200) {
        echo "An error occurred while fetching user data.";
        return null;
    }
    return $httpCode;
}

function getUsers($userurl)
{
    $response = @file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $userData = json_decode($response, true)['table_user'];

    return $userData; // User not found
}


function updateUser($userurl, $column, $columnValue, $value)
{
    $users = getUsers($userurl);
    $userId = "";
    foreach ($users as $key => $user) {
        if ($user[$column] === $columnValue) {
            $userId = $user['user_id'];
            break;
        }
    }
    if ($userId === "") {
        return "No user found.";
    }
    $url = $userurl . '/' . $userId;
    $data = json_encode($value);
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
        return "successful";
    } else {
        return "Update user failed. Error: " . $response;
    }
}

