<?php
session_start();
include_once dirname(__FILE__, 4) . "/helpers/db.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-author.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $field = $_POST['field'];
  $value = $field === 'user_contact' ? $_POST['value'] : $_POST['value'];
  $author_id = $_POST['author_id'];

  // validate the new value
  if ($field === 'user_contact' && !ctype_digit($value)) {
    echo "Please enter a valid phone number.";
    exit;
  }
  
  // update the user record in the database
  $value = [$field => $value];
  $udpate_result = updateAuthorById($authorurl, $author_id, $value);


  if ($udpate_result == "successful") {
    // $rows_affected = pg_affected_rows($result);
    echo "Record updated successfully.";
  } else {
    echo "Error updating record.";
  }
}
?>