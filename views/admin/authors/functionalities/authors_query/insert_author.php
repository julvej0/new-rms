<?php
include_once '../../../../../db/db.php'; //db connection

//check if every data needed exists
if (isset($_POST['a-name'],$_POST['a-gender'],$_POST['a-role'], $_POST['a-email'])) {
     //initialize
    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'] != "" ? $_POST['a-gender'] : null;
    $email = $_POST['a-email'] != "" ? $_POST['a-email'] : null;
    $types = $_POST['a-role'] != "" ? $_POST['a-role'] : null;

     //combining the affiliation for updating
    if(isset($_POST['a-aff-dept']) && isset($_POST['a-aff-prog']) && isset($_POST['a-aff-camp'])){
         //initialize
        $department_affiliations = $_POST['a-aff-dept'];
        $program_affiliations = $_POST['a-aff-prog'];
        $campus_affiliations = $_POST['a-aff-camp'];
        $internal_affiliations = [];
        
        //combine each internal into a string
        for ($i = 0; $i < count($campus_affiliations); $i++) {
            $internal_affiliations[] = $department_affiliations[$i] . ", ". $program_affiliations[$i] . ", ". $campus_affiliations[$i];
        }
        $arrayInternal = implode('_ ', $internal_affiliations); //turn array to string
    
    }
    else{
        $arrayInternal =''; //if no internal affiliation exists
    }

    //check for external affiliation input
    if(isset($_POST['a-ex-aff'])){
        $external_affiliations = $_POST['a-ex-aff']; //initialize
        //check content
        if (is_array($external_affiliations)){
            $arrayExternal = implode('_ ', $external_affiliations);
        }
        else{
            $arrayExternal = $external_affiliations;
        }
        
    }
    else{
        $arrayExternal = ''; //if external affiliation input does not exists
    }
    
    if ($arrayInternal!='' || $arrayExternal!='' ){
        $arrayCombined = array($arrayInternal, $arrayExternal); //combine internal and external                                                                                                                                                                                                                                 
        $affiliation = implode(' || ', $arrayCombined); //turn to string for updating
    } 
    else{
        $affiliation = null; //if no affilition inputs
    }
    
    //update query
    $insert_query = "INSERT INTO table_authors (author_name, gender, type_of_author, affiliation, email) VALUES ($1, $2 ,$3,$4, $5)";
    $insert_stmt = pg_prepare($conn,"insert_author", $insert_query);
    $insert_result = pg_execute($conn,"insert_author",array($author_name, $gender, $types, $affiliation, $email));

    if ($insert_result) {
        //update user type
        $update_query = "UPDATE table_user SET account_type=$1 WHERE email =$2;";
        $update_stmt = pg_prepare($conn,"edit_accType", $update_query);
        $update_result = pg_execute($conn,"edit_accType",array("Author", $email));

        
        if ($update_result) {
            header("Location: ../../authors.php?add=success");
            exit();
        }
        else{
            header("Location: ../../authors.php?add=failed");
            exit();
        }


       
    } else {
        header("Location: ../../authors.php?add=failed");
        exit();
    }
       

    
}
else {
    header("Location: ../../authors.php");
    exit();
}   
    


?>