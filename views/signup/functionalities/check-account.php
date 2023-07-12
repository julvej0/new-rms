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


check the   $params from the   $users if exist


//this function is for checking if the user inputted on the signup page is existing or not existing on the database.
include_once "./helpers/db.php";
if (isset($_GET['srcode']) && isset($_GET['email'])) {
  $srcode = $_GET['srcode'];
  $email = $_GET['email'];

  $check_query = "SELECT * FROM table_user WHERE sr_code = $1 OR email = $2";
  $check_stmt = pg_prepare($conn, "check_account", $check_query);
  $check_result = pg_execute($conn, "check_account", array($srcode, $email));

  if (pg_num_rows($check_result) > 0) {
    echo "exists";
  } else {
    echo "not exists";
  }
} 