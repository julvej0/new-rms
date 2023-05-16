<?php
include_once '../../../../../db/db.php';
if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $delete_query = "DELETE FROM table_publications WHERE publication_id=$1";
    $delete_stmt = pg_prepare($conn,"delete_pub_details", $delete_query);
    $delete_result = pg_execute($conn,"delete_pub_details",array($id));

    

    if ($delete_result) {
        echo "Success";
        
    } else {
        echo "Error";
        
    }
    
} 
else {
    header("Location: ../../../../../views/admin/publications/publications.php");
}   
