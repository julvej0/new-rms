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

function deleteIpAssetById($url, $id)
{
    $url = $url . '/' . $id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    if (str_contains($response, 'error') || $response == false) {
        echo "An error occurred while deleting the IP asset.";
        return null;
    }
    return $httpCode;
}

function getSearchIpassetsById($url, $id, $search)
{
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

function updateIpassetsByAuthor($url, $author)
{
    $response = @file_get_contents($url);
    if ($response === false) {
        echo "An error occurred while fetching user data.";
        return null;
    }
    $ipassetsData = json_decode($response, true)['table_ipassets'];
    foreach ($ipassetsData as $key => $ipasset) {
        $authors = explode(',', $ipasset['authors']);
        if (strpos($ipasset['authors'], $author) !== false) {
            $result = array_diff($authors, array($author));
            $authorToString = implode(',', $result);
            $url = 'http://localhost:5000/table_ipassets/' . $ipasset['registration_number'];
            $jsonData = array(
                'registration_number' => $ipasset['registration_number'],
                'title_of_work' => $ipasset['title_of_work'],
                'type_of_document' => $ipasset['type_of_document'],
                'class_of_work' => $ipasset['class_of_work'],
                'date_of_creation' => $ipasset['date_of_creation'],
                'date_registered' => $ipasset['date_registered'],
                'campus' => $ipasset['campus'],
                'college' => $ipasset['college'],
                'program' => $ipasset['program'],
                'authors' => $authorToString,
                'hyperlink' => $ipasset['hyperlink'],
                'status' => $ipasset['status']
            );
            $data = json_encode($jsonData);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($httpCode != 200) {
                return null;
            }
        }
    }
    return 'Task Completed';
}