<?php
session_start();
include_once "../../../../db/db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $value = $field === 'user_contact' ? intval($_POST['value']) : $_POST['value'];
    $srCode = $_POST['sr_code'];
  
    // update the user record in the database
    $update_query = "UPDATE table_user SET $field = $1 WHERE sr_code = $2";
    $stmt = pg_prepare($conn, "update_user", $update_query);
    $result = pg_execute($conn, "update_user", array($value, $srCode));
  
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
