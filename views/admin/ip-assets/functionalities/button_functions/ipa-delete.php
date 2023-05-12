<?php
include_once '../../../../../db/db.php';
if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $filename = "./uploads/" . $id . "_certificate.png";
    if (file_exists($filename)) { // check if the file exists
        unlink($filename);// delete the file
        if (file_exists($filename)) { 
            echo "Error";
        }
    } 

    $delete_query = "DELETE FROM table_ipassets WHERE registration_number=$1";
    $delete_stmt = pg_prepare($conn,"delete_author", $delete_query);
    $delete_result = pg_execute($conn,"delete_author",array($id));

    

    if ($delete_result) {
        echo "Success";
        
    } else {
        echo "Error";
        
    }
    
} 
else {
    header("Location: ../../../../../views/admin/ip-assets/ip-assets.php");
}   
