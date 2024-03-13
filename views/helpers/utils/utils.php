<?php

function getUserIdByEmail($userurl, $email)
{
    $response = @file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
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
        exit();
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
        exit();
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
        exit();
    }
    return $httpCode;
}

function getIpAssetById($url, $id)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $ipassetsData = json_decode($response, true)['table_ipassets'];
    foreach ($ipassetsData as $ipasset) {
        if ($ipasset['registration_number'] === $id) {
            return $ipasset;
        }
    }

    return null; // User not found
}

function getAuthorById($url, $id)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $ipassetsData = json_decode($response, true)['table_authors'];
    foreach ($ipassetsData as $ipasset) {
        if ($ipasset['author_id'] === $id) {
            return $ipasset;
        }
    }

    return null; // User not found
}

function getAuthors($url)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $ipassetsData = json_decode($response, true)['table_authors'];
    
    return $ipassetsData; // User not found
}


function sortByAuthorName($array)
{
    usort($array, function ($a, $b) {
        return strcmp($a['author_name'], $b['author_name']);
    });

    return $array;
}