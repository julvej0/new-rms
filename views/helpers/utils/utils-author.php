<?php
require_once(dirname(__FILE__, 4) . "\helpers\db.php");
function createAuthor($authorurl, $authorName, $gender, $type, $affiliation, $email)
{
    $postData = array(
        'id' => 'AID005875',
        'author_name' => $authorName,
        'gender' => $gender,
        'type_of_author' => $type,
        'affiliation' => $affiliation,
        'email' => $email
    );

    $jsonData = json_encode($postData);

    $ch = curl_init($authorurl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Use PUT method for updating
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Send the data as JSON
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set the content type header

    $response = curl_exec($ch);
    // throw new Exception($response);

    if (str_contains($response, 'error')) {
        echo 'cURL error: ' . $response;
    } else {
        $response_data = json_decode($response, true);
        if ($response_data != false) {
            echo 'User record updated successfully.';
        } else {
            echo 'Failed to update user record.';
        }
    }
    curl_close($ch);
}


function getDataById($url, $id)
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