<?php
include_once '../../../../../db/db.php';
if (isset($_POST['id'],$_POST['page'], $_POST['search'])) {
    $id=$_POST['id'];
    $page_number=$_POST['page'];
    $search =$_POST['search'];

    $delete_query = "DELETE FROM table_authors WHERE author_id=$1";
    $delete_stmt = pg_prepare($conn,"delete_author", $delete_query);
    $delete_result = pg_execute($conn,"delete_author",array($id));

    if ($delete_result) {
       echo "Success";
        
    } else {
        echo "Error";
        
    }
    } 
else {
    header("Location: ../../authors.php");
}   




?>