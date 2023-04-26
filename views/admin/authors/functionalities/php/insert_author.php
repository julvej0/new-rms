<?php
include_once '../../../../../db/db.php';
if (isset($_POST['insert'])) {
    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'];
    $types = $_POST['a-role'];

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
        $insert_query = "INSERT INTO table_authors (author_name, gender, type_of_author, affiliation) VALUES ($1, $2 ,$3,$4)";
        $insert_stmt = pg_prepare($conn,"insert_author", $insert_query);
        $insert_result = pg_execute($conn,"insert_author",array($author_name, $gender, $types, $affiliation));

        if ($insert_result) {
            echo "Insert successful.";
            header("Location: ../../authors.php?add=success");
        } else {
            echo "Insert failed.";
            header("Location: ../../authors.php?add=failed");
        }
       

    }
}
else {
    header("Location: ../../authors.php");
}   
    


?>