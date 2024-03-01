<?php
include_once '../../../../../helpers/db.php';
// Check if the 'id' parameter is set
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $filename = "./uploads/" . $id . "_certificate.png";

    // Check if the file exists
    if (file_exists($filename)) {
        unlink($filename); // Delete the file

        // Check if the file still exists (to ensure successful deletion)
        if (file_exists($filename)) {
            echo "Error";
        }
    }

    // Delete the record from the database
    $delete_query = "DELETE FROM table_ipassets WHERE registration_number=$1";
    $delete_stmt = pg_prepare($conn, "delete_author", $delete_query);
    $delete_result = pg_execute($conn, "delete_author", array($id));

    // Check if the deletion was successful
    if ($delete_result) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    // Redirect to the appropriate page if the 'id' parameter is not set
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php");
}
?>
