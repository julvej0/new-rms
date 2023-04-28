<?php
include_once '../../../../../db/db.php';
if (isset($_POST['delete'])) {
    $id=$_POST['id'];
    $page_number=$_POST['page'];

    $delete_query = "DELETE FROM table_authors WHERE author_id=$1";
    $delete_stmt = pg_prepare($conn,"delete_author", $delete_query);
    $delete_result = pg_execute($conn,"delete_author",array($id));

    if ($delete_result) {
        echo "Insert successful.";
        header("Location: ../../authors.php?page=".$page_number."&delete=success");
    } else {
        echo "Insert failed.";
        header("Location: ../../authors.php?page=".$page_number."&delete=failed");
    }
    } 
else {
    header("Location: ..\authors-list.php");
}   


?>