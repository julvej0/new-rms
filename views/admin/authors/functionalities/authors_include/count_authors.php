<?php
    //function for total authors from database
    //the total adjusts base on search and filer
    function countAuthors($authorurl){
        // Make the HTTP request to the endpoint
        $response = @file_get_contents($authorurl);
    
        // Check if the request was successful
        if ($response === false) {
            return false;
        }
    
        // Parse the JSON response
        $data = json_decode($response, true);
    
        // Check if the JSON was parsed successfully
        if ($data === null) {
            echo "Failed to parse JSON response.";
            return false;
        }
    
        // Get the number of users from the response
        $userCount = count($data['table_authors']);
    
        return $userCount;
    }
?>