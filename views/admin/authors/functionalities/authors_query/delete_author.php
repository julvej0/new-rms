<?php
include_once '../../../../../helpers/db.php'; //db connection

//determine if id parameter is existing
if (isset($_POST['id'])) {
    $id=$_POST['id'];//initialize

    //check if the author was removed from publication and ipasset
    if (updateIpasset($conn, $id) == "Task Completed" && updatePublication($conn, $id) == "Task Completed" && updateAccountType($conn, $id)== "Task Completed")  {
        //deleting the author
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
    header("Location: ../../authors.php"); //if id does not exists
}   


//updating authors column if table_ipasset due to author removal
function updateIpasset($conn, $id){
    $selectIPAsset = "SELECT * FROM table_ipassets WHERE authors ILIKE $1"; //query to get all entries related to author
    $selectIPAsset_stmt = pg_prepare($conn,"s_author_ipassets", $selectIPAsset);
    $selectIPAsset_result = pg_execute($conn,"s_author_ipassets",array("%$id%"));

    if(pg_num_rows($selectIPAsset_result)>0){
        while ($row = pg_fetch_assoc($selectIPAsset_result)) {
            $authorIds = explode(',', $row['authors']); //turn to array
            $result = array_diff($authorIds, array($id)); //remove author from the array
    
            $authorsToString = implode(',', $result); // turn to string
    
            $table_rows[] = array(
                'registration_number' => $row['registration_number'],
                'authors' => $authorsToString
            );
        }
           

        //for each entries that matches the search
        foreach ($table_rows as $row){
            //update each row's authors
            $updateIPAsset = "UPDATE table_ipassets SET authors = $1 WHERE registration_number = $2";
            $updateIPAsset_stmt = pg_prepare($conn,"update_ipassets", $updateIPAsset);
            $updateIPAsset_result = pg_execute($conn,"update_ipassets",array($row['authors'], $row['registration_number']));
    
            if($updateIPAsset_result){
                return "Task Completed"; //author was sucessfully removed from the database
            }
            else{
                return "Not Updated"; // author was not removed from the database
            }
        }
    }
    else{
        return "Task Completed";
    }
    

}
//make na API
//updating authors column if table_ipasset due to author removal
function updatePublication($conn, $id){
    $selectPublication = "SELECT * FROM table_publications WHERE authors ILIKE $1"; //query to get all entries related to author
    $selectPublication_stmt = pg_prepare($conn,"s_author_publication", $selectPublication);
    $selectPublication_result = pg_execute($conn,"s_author_publication",array("%$id%"));

    if(pg_num_rows($selectPublication_result)>0){
        while ($row = pg_fetch_assoc($selectPublication_result)) {
            $authorIds = explode(',', $row['authors']); //turn to array
            $result = array_diff($authorIds, array($id)); //remove author from the array
    
            $authorsToString = implode(',', $result); // turn to string
    
            $table_rows[] = array(
                'publication_id' => $row['publication_id'],
                'authors' => $authorsToString
            );
        }
           
       //for each entries that matches the search
       foreach ($table_rows as $row){
        //update each row's authors
            $updatePublication = "UPDATE table_publications SET authors = $1 WHERE publication_id = $2";
            $updatePublication_stmt = pg_prepare($conn,"update_publication", $updatePublication);
            $updatePublication_result = pg_execute($conn,"update_publication",array($row['authors'], $row['publication_id']));
    
            if($updatePublication_result){
                return "Task Completed"; //author was sucessfully removed from the database
            }
            else{
                return "Not Updated"; //author was not removed from the database  
            }
        }
    }
    else{
        return "Task Completed";
    }
    

}

//updating the account type after removal
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