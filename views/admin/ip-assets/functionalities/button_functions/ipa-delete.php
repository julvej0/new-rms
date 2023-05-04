<?php
include_once '../../../../../db/db.php';

if (isset($_POST['delete'])) {
    $reg_num = $_POST['row_id'];

    $filename = "./uploads/" . $reg_num . "_certificate.png";

    if (file_exists($filename)) { // check if the file exists
        if (unlink($filename)) { // delete the file
            echo "File deleted successfully";
        } else {
            echo "Error deleting file";
        }
    } else {
        echo "File does not exist";
    }

    // Create SQL DELETE statement
    $delete_query = "DELETE FROM table_ipassets WHERE registration_number=$1";

    // Prepare the SQL statement
    $delete_stmt = pg_prepare($conn, "delete_ipa_details", $delete_query);

    // Execute the prepared statement with the input values
    $delete_result = pg_execute($conn, "delete_ipa_details", array($reg_num));

    if (!$delete_result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Check if the delete was successful
    if (pg_affected_rows($delete_result) > 0) {
        header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?delete=applied");
    } else {
        header("Location: ../../../../../views/admin/ip-assets/ip-assets.php?delete=!applied");
    }
} else {
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php");
}
