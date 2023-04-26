<?php
if (isset($_POST['insert'])) {
    $author_name = $_POST['a-name'];
    $gender = $_POST['a-gender'];
    $types = $_POST['a-role'];
    
    $campus_affiliations = $_POST['campus_affiliations'];
    $program_affiliations = $_POST['program_affiliations'];
    $college_affiliations = $_POST['college_affiliations'];
    $external_affiliations = $_POST['external_affiliations'];
    $internal_affiliations = [];

    if (!is_null($campus_affiliations) && !is_null($campus_affiliations) && !is_null($campus_affiliations)){
        for ($i = 0; $i < count($campus_affiliations); $i++) {
            $internal_affiliations[] = $campus_affiliations[$i] . ", ". $program_affiliations[$i] . ", ". $college_affiliations[$i];
        }
        $arrayString1 = implode('_ ', $internal_affiliations);

    }
    if (!is_null($external_affiliations)){
        $arrayString2 = implode('_ ', $external_affiliations);
    }
   
    if (!is_null($arrayString1) || !is_null($arrayString2)){
        $array3 = array($arrayString1, $arrayString2);                                                                                                                                                                                                                                    
        $affiliation = implode(' || ', $array3);
    } 
    else{
        $affiliation = "";
    }
    

    if(empty($author_name)||$gender=='Select'||$types=='Select'||empty($affiliation)){
        header("Location: ..\\new-author.php?error=incomplete");
    }
    else{
        $insert_query = "INSERT INTO table_authors (author_name, gender, type_of_author, affiliation) VALUES ($1, $2 ,$3,$4)";
        $insert_stmt = pg_prepare($conn,"insert_author", $insert_query);
        $insert_result = pg_execute($conn,"insert_author",array($author_name, $gender, $types, $affiliation));

        if ($insert_result) {
            echo "Insert successful.";
            header("Location: ..\authors-list.php?add=success");
        } else {
            echo "Insert failed.";
            header("Location: ..\authors-list.php?add=failed");
        }
       

    }
}
else {
    header("Location: ..\authors-list.php");
}   
    


?>