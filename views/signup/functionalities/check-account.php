<?php

//this function is for checking if the user inputted on the signup page is existing or not existing on the database.
include_once dirname(__FILE__, 3) . "helpers/db.php";

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
?>
