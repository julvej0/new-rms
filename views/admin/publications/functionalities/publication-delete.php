<?php
include_once '../../../../db/db.php';

if (isset($_POST['delete'])) {
    $pub_id = $_POST['row_id'];

    // Create SQL DELETE statement
    $delete_query = "DELETE FROM table_publications WHERE publication_id=$1";

    // Prepare the SQL statement
    $delete_stmt = pg_prepare($conn, "delete_pub_details", $delete_query);

    // Execute the prepared statement with the input values
    $delete_result = pg_execute($conn, "delete_pub_details", array($pub_id));

    if (!$delete_result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Check if the delete was successful
    if (pg_affected_rows($delete_result) > 0) {
        header("Location: ../publications.php?delete=applied");
    } else {
        header("Location: ../publications.php?delete=!deleted");
    }
} else {
    header("Location: ../publications.php");
}

?>