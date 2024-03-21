<?php
function createAuthor($authorurl, $authorName, $gender, $type, $affiliation, $email)
{
    $postData = array(
        'author_id' => bin2hex(random_bytes(5)),
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
    $response_data = json_decode($response, true);
    curl_close($ch);
    if (strpos($response, 'error') !== false) {
        return 'cURL error: ' . $response;
    } else {
        if ($response_data !== false) {
            return 'Author created successfully.';
        } else {
            return 'Author creation failed.';
        }
    }
}

function getAuthorByEmail($url, $email)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $authorsData = json_decode($response, true)['table_authors'];
    foreach ($authorsData as $author) {
        if ($author['email'] === $email) {
            return $author;
        }
    }

    return null; // Author not found
}

function getAuthorByName($url, $name)
{
    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }
    $authorsData = json_decode($response, true)['table_authors'];
    foreach ($authorsData as $author) {
        if ($author['author_name'] === $name) {
            return $author;
        }
    }
    return null; // Author not found
}

function updateAuthorById($authorurl, $authorId, $value)
{
    $url = $authorurl . '/' . $authorId;
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
        return "Update author failed. Error: " . $response;
    }
}

function getAuthorById($url, $id)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $authorsData = json_decode($response, true)['table_authors'];
    foreach ($authorsData as $author) {
        if ($author['author_id'] === $id) {
            return $author;
        }
    }

    return null; // Author not found
}

function getAuthors($url)
{

    $response = @file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $authorsData = json_decode($response, true)['table_authors'];

    return $authorsData; // Author not found
}


function sortByAuthorName($array)
{
    usort($array, function ($a, $b) {
        return strcmp($a['author_name'], $b['author_name']);
    });

    return $array;
}