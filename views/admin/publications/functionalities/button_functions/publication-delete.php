<?php
include_once '../../../../../db/db.php';

// Check if the 'id' parameter is set in the POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the delete query and statement
    $delete_query = "DELETE FROM table_publications WHERE publication_id=$1";
    $delete_stmt = pg_prepare($conn, "delete_pub_details", $delete_query);
    
    // Execute the delete statement with the provided ID parameter
    $delete_result = pg_execute($conn, "delete_pub_details", array($id));

    // Check if the deletion was successful
    if ($delete_result) {
        echo "Success"; // Notify the client about the success
    } else {
        echo "Error"; // Notify the client about the error
    }
} else {
    // If the 'id' parameter is not set, redirect to the publications page
    header("Location: ../../../../../views/admin/publications/publications.php");
}
