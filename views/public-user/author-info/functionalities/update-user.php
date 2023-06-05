<?php
session_start();
include_once dirname(__FILE__, 4) . "/helpers/db.php";
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
      $update_query = "UPDATE table_authors SET $field = $1 WHERE author_id = $2";
      $stmt = pg_prepare($conn, "update_user", $update_query);
      $result = pg_execute($conn, "update_user", array($value, $author_id));
    
      if ($result) {
        $rows_affected = pg_affected_rows($result);
        if ($rows_affected > 0) {
          echo "Record updated successfully.";
        } else {
          echo "No record was updated.";
        }
      } else {
        echo "Error updating record.";
      }
  }
?>  