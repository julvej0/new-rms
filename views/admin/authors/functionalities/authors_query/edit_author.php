<?php
include_once '../../../../../db/db.php';
if (isset($_POST['a-name'],$_POST['a-gender'],$_POST['a-role'],$_POST['a-id'])) {
    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'];
    $types = $_POST['a-role'];
    $id = $_POST['a-id'];

    if(isset($_POST['a-aff-dept']) && isset($_POST['a-aff-prog']) && isset($_POST['a-aff-camp'])){
        $department_affiliations = $_POST['a-aff-dept'];
        $program_affiliations = $_POST['a-aff-prog'];
        $campus_affiliations = $_POST['a-aff-camp'];
        $internal_affiliations = [];

        for ($i = 0; $i < count($campus_affiliations); $i++) {
            $internal_affiliations[] = $department_affiliations[$i] . ", ". $program_affiliations[$i] . ", ". $campus_affiliations[$i];
        }
        $arrayString1 = implode('_ ', $internal_affiliations);
    
    }
    else{
        $arrayString1 ='';
    }

    if(isset($_POST['a-ex-aff'])){
        $external_affiliations = $_POST['a-ex-aff'];
        if (is_array($external_affiliations)){
            $arrayString2 = implode('_ ', $external_affiliations);
        }
        else{
            $arrayString2 = $external_affiliations;
        }
        
    }
    else{
        $arrayString2 = '';
    }
    
    if ($arrayString1!='' || $arrayString2!='' ){
        $array3 = array($arrayString1, $arrayString2);                                                                                                                                                                                                                                    
        $affiliation = implode(' || ', $array3);
    } 
    else{
        $affiliation = '';
    }
    
    
    

    if(empty($author_name)||$gender==''||$types==''||$affiliation==''){
        header("Location: ../../new-author.php?error=incomplete");
    }
    else{
        $update_query = "UPDATE table_authors SET author_name=$1, gender=$2, type_of_author=$3, affiliation=$4 WHERE author_id=$5";
        $update_stmt = pg_prepare($conn,"edit_author", $update_query);
        $update_result = pg_execute($conn,"edit_author",array($author_name, $gender, $types, $affiliation, $id));
    
        if ($update_result) {
            header("Location: ../../authors.php?search=".$author_name."&update=success");
        } else {
            header("Location: ../../authors.php?search=".$author_name."&update=failed");
        }
       

    }
}
else {
    header("Location: ../../authors.php");
}   
    


?>