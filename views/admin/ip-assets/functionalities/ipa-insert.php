<?php
include_once '../../../../db/db.php';
if (isset($_POST['submitIPA'])) {
    $date_of_creation = $_POST["date_of_creation"];
    $date_of_creation = isset($_POST['date_of_creation']) ? $_POST['date_of_creation'] : null;
    if (!$date_of_creation) {
        $date_of_creation = null;
    }else{
        $date_of_creation = $_POST["date_of_creation"];
    }
    $date_registered = $_POST['date_registered'];
    $date_registered = isset($_POST['date_registered']) ? $_POST['date_registered'] : null;
    if (!$date_registered) {
        $date_registered = "";
    }else{
        $date_registered = $_POST["date_registered"];
    }
    $registration_number = $_POST['registration_number'];
    $title_of_work = $_POST['title_of_work'];
    $type_of_document = $_POST['type_of_ipa'];
    $class_of_work = $_POST['class_of_work'];
    $campus = $_POST['campus'];
    $college = $_POST['college'];
    $program = $_POST['program'];
    $authors = $_POST['author_id'];
    $hyperlink = $_POST['hyperlink'];
    
    $authors_string = implode(",", $authors); // join the array values with a comma delimiter

    $insert_query = "INSERT INTO table_ipassets (registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, hyperlink) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";
    $insert_stmt = pg_prepare($conn, "insert_ipa_details", $insert_query);
    $insert_result = pg_execute($conn, "insert_ipa_details", array($registration_number, $title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink));
    
    if ($insert_result) {
        echo "Insert successful.";
        header("Location: ../ip-assets.php?success");
    } else {
        echo "Insert failed.";
    }
} else {
    header("Location: ../ip-assets.php?failed");
}   
?>