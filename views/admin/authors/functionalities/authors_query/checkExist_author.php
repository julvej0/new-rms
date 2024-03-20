<?php
$response = file_get_contents($authorurl);

// Check if the request was successful
if ($response !== false) {
    // Process the response data
    $data = json_decode($response, true);

    // Check if the author name exists
    if (isset($_GET['author_name'])) {
        $author_name = $_GET['author_name'];

        // Search for the author name in the response data
        $authorExists = false;
        foreach ($data as $author) {
            if (strcasecmp($author['author_name'], $author_name) === 0) {
                $authorExists = true;
                break;
            }
        }

        if ($authorExists) {
            echo "Exists"; // author name exists
        } else {
            echo "Does Not Exist"; // author name does not exist
        }
    } else {
        echo "Author name parameter is missing";
    }
} else {
    echo "Failed to retrieve data from the API";
}


?>