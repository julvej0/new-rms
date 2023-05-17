<?php
include_once '../../../../../db/db.php';
if (isset($_POST['a-name'],$_POST['a-gender'],$_POST['a-role'], $_POST['a-email'])) {
    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'] != "" ? $_POST['a-gender'] : null;
    $email = $_POST['a-email'] != "" ? $_POST['a-email'] : null;
    $types = $_POST['a-role'] != "" ? $_POST['a-role'] : null;

    if(isset($_POST['a-aff-dept']) && isset($_POST['a-aff-prog']) && isset($_POST['a-aff-camp'])){
        $department_affiliations = $_POST['a-aff-dept'];
        $program_affiliations = $_POST['a-aff-prog'];
        $campus_affiliations = $_POST['a-aff-camp'];
        $internal_affiliations = [];

        for ($i = 0; $i < count($campus_affiliations); $i++) {
            $internal_affiliations[] = $department_affiliations[$i] . ", ". $program_affiliations[$i] . ", ". $campus_affiliations[$i];
        }
        $arrayInternal = implode('_ ', $internal_affiliations);
    
    }
    else{
        $arrayInternal ='';
    }

    if(isset($_POST['a-ex-aff'])){
        $external_affiliations = $_POST['a-ex-aff'];
        if (is_array($external_affiliations)){
            $arrayExternal = implode('_ ', $external_affiliations);
        }
        else{
            $arrayExternal = $external_affiliations;
        }
        
    }
    else{
        $arrayExternal = '';
    }
    
    if ($arrayInternal!='' || $arrayExternal!='' ){
        $arrayCombined = array($arrayInternal, $arrayExternal);                                                                                                                                                                                                                                    
        $affiliation = implode(' || ', $arrayCombined);
    } 
    else{
        $affiliation = null;
    }
    
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