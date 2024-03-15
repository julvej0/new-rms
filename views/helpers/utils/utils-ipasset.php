<?php

function getIpAssetById($url, $id)
{
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $ipassetsData = json_decode($response, true)['table_ipassets'];
    foreach ($ipassetsData as $ipasset) {
        if ($ipasset['registration_number'] === $id) {
            return $ipasset;
        }
    }

    return null; // User not found
}

function getIpassets($url)
{
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $ipassetsData = json_decode($response, true)['table_ipassets'];

    return $ipassetsData; // User not found
}

function deleteIpAssetById($url, $id){
    $url = $url . '/' . $id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    if (str_contains($response,'error') || $response == false) {
        echo "An error occurred while deleting the IP asset.";
        return null;
    }
    return $httpCode;
}

function getSearchIpassetsById($url, $id, $search){
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }

    $ipassetsData = json_decode($response, true)['table_ipassets'];
    $ipassets = array();
    foreach ($ipassetsData as $ipasset) {
        if ($ipasset['registration_number'] === $id) {
            return $ipasset;
        }
    }

    return null;
}