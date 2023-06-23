<?php
include_once '../../../../../db/db.php';//db connection

//check if parameter exist
if(isset($_GET['author_name'])){
    $author_name = $_GET['author_name'];//initialization

    //query to check if author exists
    $check = "SELECT * FROM table_authors WHERE author_name = $1 OR author_name ILIKE $2";
    $check_stmt = pg_prepare($conn,"check_author", $check);
    $check_result = pg_execute($conn,"check_author", array($author_name, "%$author_name%"));

    //check total matches
    if(pg_num_rows($check_result)>0){
        echo "Exists"; //author name exists
        exit();
    }
    else{
        echo "Does Not Exists"; //author name does not exists
        exit();
    }
}
else{
    exit();
}

?>