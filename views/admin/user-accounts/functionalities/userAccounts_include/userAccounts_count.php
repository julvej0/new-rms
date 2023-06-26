<?php
    //count total accounts from database
    function countUserAccounts($userurl){
       // Make the HTTP request to the endpoint
       $response = file_get_contents($userurl);
   
       // Check if the request was successful
       if ($response === false) {
           echo "Failed to retrieve data from the endpoint.";
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
       $userCount = count($data['table_user']);
   
       return $userCount;
   }
?>