<?php

if (isset($_GET['srcode']) && isset($_GET['email'])) {
  $srcode = $_GET['srcode'];
  $email = $_GET['email'];
  
  // Make the API request
  $response = file_get_contents($userurl);
  
  // Process the response
  if ($response !== false) {
    $userdata = json_decode($response, true);

    $users = array_column($userdata['table_user'], 'email', 'srcode');

    if (isset($users[$srcode]) && $users[$srcode] === $email) {
      echo "exists";
    } else {
      echo "not exists";
    }
  } else {
    echo "Error: Failed to fetch user data from the API.";
  }
}
?>