<?php

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