<?php
include_once '../../../../../db/db.php';
if (isset($_POST['id'])) {
    $id=$_POST['id'];

    if (updateIpasset($conn, $id) == "Task Completed" && updatePublication($conn, $id) == "Task Completed" && updateAccountType($conn, $id)== "Task Completed")  {
        $delete_query = "DELETE FROM table_authors WHERE author_id=$1";
        $delete_stmt = pg_prepare($conn,"delete_author", $delete_query);
        $delete_result = pg_execute($conn,"delete_author",array($id));

        if($delete_result){
           
            echo "Success";
            exit();
        }
        else{
            echo "Error";
            exit();
        }
    }
    else {
        echo "Error";
        exit();
        
    }
}
else {
    header("Location: ../../authors.php");
}   



function updateIpasset($conn, $id){
    $selectIPAsset = "SELECT * FROM table_ipassets WHERE authors ILIKE $1";
    $selectIPAsset_stmt = pg_prepare($conn,"s_author_ipassets", $selectIPAsset);
    $selectIPAsset_result = pg_execute($conn,"s_author_ipassets",array("%$id%"));

    if(pg_num_rows($selectIPAsset_result)>0){
        while ($row = pg_fetch_assoc($selectIPAsset_result)) {
            $authorIds = explode(',', $row['authors']);
            $result = array_diff($authorIds, array($id));
    
            $authorsToString = implode(',', $result);
    
            $table_rows[] = array(
                'registration_number' => $row['registration_number'],
                'authors' => $authorsToString
            );
        }
           
    
        foreach ($table_rows as $row){
            $updateIPAsset = "UPDATE table_ipassets SET authors = $1 WHERE registration_number = $2";
            $updateIPAsset_stmt = pg_prepare($conn,"update_ipassets", $updateIPAsset);
            $updateIPAsset_result = pg_execute($conn,"update_ipassets",array($row['authors'], $row['registration_number']));
    
            if($updateIPAsset_result){
                return "Task Completed";
            }
            else{
                return "Not Updated";
            }
        }
    }
    else{
        return "Task Completed";
    }
    

}


function updatePublication($conn, $id){
    $selectPublication = "SELECT * FROM table_publications WHERE authors ILIKE $1";
    $selectPublication_stmt = pg_prepare($conn,"s_author_publication", $selectPublication);
    $selectPublication_result = pg_execute($conn,"s_author_publication",array("%$id%"));

    if(pg_num_rows($selectPublication_result)>0){
        while ($row = pg_fetch_assoc($selectPublication_result)) {
            $authorIds = explode(',', $row['authors']);
            $result = array_diff($authorIds, array($id));
    
            $authorsToString = implode(',', $result);
    
            $table_rows[] = array(
                'publication_id' => $row['publication_id'],
                'authors' => $authorsToString
            );
        }
           
    
        foreach ($table_rows as $row){
            $updatePublication = "UPDATE table_publications SET authors = $1 WHERE publication_id = $2";
            $updatePublication_stmt = pg_prepare($conn,"update_publication", $updatePublication);
            $updatePublication_result = pg_execute($conn,"update_publication",array($row['authors'], $row['publication_id']));
    
            if($updatePublication_result){
                return "Task Completed";
            }
            else{
                return "Not Updated";
            }
        }
    }
    else{
        return "Task Completed";
    }
    

}

function updateAccountType($conn, $id){
    $update_query = "UPDATE table_user SET account_type = $1 WHERE email IN (SELECT email FROM table_authors WHERE author_id = $2)";
    $update_stmt = pg_prepare($conn,"update_account", $update_query);
    $update_result = pg_execute($conn,"update_account",array("Regular", $id));

    if ($update_result){
        return "Task Completed";
    }
    else{
        return "Not Updated";
    }

}



?>