<?php
include_once '../../../../db/db.php';
if (isset($_POST['updateIPA'])) {
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

    $authors = isset($_POST['author_id']) ? $_POST['author_id'] : null;
    if (!$authors) {
        $authors = "";
        $authors_string = ""; // join the array values with a comma delimiter
    }else{
        $authors = $_POST["author_id"];
        $authors_string = implode(",", $authors); // join the array values with a comma delimiter
    }

    $registration_number = $_POST['registration_number'];
    $title_of_work = $_POST['title_of_work'];
    $type_of_document = $_POST['type_of_ipa'];
    $class_of_work = $_POST['class_of_work'];
    $campus = $_POST['campus'];
    $college = $_POST['college'];
    $program = $_POST['program'];
    $hyperlink = $_POST['hyperlink'];
    $status = $_POST['registerInfo'];

    // Create SQL UPDATE statement
    $update_query = "UPDATE table_ipassets SET title_of_work=$1, type_of_document=$2, class_of_work=$3, date_of_creation=$4, date_registered=$5, campus=$6, college=$7, program=$8, authors=$9, hyperlink=$10, status=$11 WHERE registration_number=$12";

    // Prepare the SQL statement
    $update_stmt = pg_prepare($conn, "update_ipa_details", $update_query);

    // Execute the prepared statement with the input values
    $update_result = pg_execute($conn, "update_ipa_details", array($title_of_work, $type_of_document, $class_of_work, $date_of_creation, $date_registered, $campus, $college, $program, $authors_string, $hyperlink, $status, $registration_number));

    if (!$update_result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Check if the update was successful
    if (pg_affected_rows($update_result) > 0) {
        header("Location: ../ip-assets.php?update=applied");
    } else {
        header("Location: ../ip-assets.php?update=!update");
    }
} else {
    header("Location: ../ip-assets.php");
}

?>