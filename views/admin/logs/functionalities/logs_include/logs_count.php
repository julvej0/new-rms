<?php
//count total accounts from database
function countLogs($logurl)
{
    // Make the HTTP request to the endpoint
    $response = @file_get_contents($logurl);

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

    // Get the number of logs from the response
    $logCount = count($data['table_log']);

    return $logCount;
}
?>