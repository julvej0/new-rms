<?php
session_start();

function getUserIdBySrCode($userurl, $srCode)
{
    $response = file_get_contents($userurl);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        exit();
    }

    $userData = json_decode($response, true)['table_user'];
    foreach ($userData as $user) {
        $userId = $user['user_id'];
        $userSrCode = $user['sr_code'];
        if ($userSrCode === $srCode) {
            return $userId;
        }
    }
}

function updateUserRecord($userurl, $userId, $field, $value)
{
    $url = $userurl . '/' . $userId;
    $data = json_encode([$field => $value]);
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
        echo "Update record failed. Error: " . $response;
        exit();
    }
}

include_once dirname(__FILE__, 5) . "/helpers/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $value = $_POST['value'];
    $srCode = $_POST['sr_code'];

    // validate the new value
    if ($field === 'user_contact' && !ctype_digit($value)) {
        echo "Please enter a valid phone number.";
        exit;
    }

    //get user id by fetching user data using API
    $userId = getUserIdBySrCode($userurl, $srCode);

    //update record using API
    updateUserRecord($userurl, $userId, $field, $value);

}
?>