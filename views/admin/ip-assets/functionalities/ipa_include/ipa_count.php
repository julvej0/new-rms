<?php
function countIPA($conn, $additionalQuery){
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $type_filter = isset($_GET['type']) ? $_GET['type'] : null;
    $class_filter = isset($_GET['class']) ? $_GET['class'] : null;
    $year_filter = isset($_GET['year']) ? $_GET['year']: null;

    $no_of_records_per_page = 10;
    // Get total number of records
    $count_sql = "SELECT COUNT(*)
            FROM (
                SELECT * 
                FROM table_ipassets 
                WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors, status, certificate) ILIKE '%$search_query%' ";

        if ($additionalQuery !== null) {
        $count_sql .= $additionalQuery;
        }

        $count_sql .= " )AS searched_ipa WHERE 1=1 ";

        if ($type_filter !== null) {
        $count_sql .= " AND searched_ipa.type_of_document = '$type_filter' ";
        }
        if ($class_filter !== null) {
        $count_sql .= " AND searched_ipa.class_of_work = '$class_filter' ";
        }
        if ($year_filter !== null) {
        $count_sql .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) = '$year_filter' ";
        }

    $result_count = pg_query($conn, $count_sql);
    $total_records = pg_fetch_result($result_count, 0, 0);
    $total_pages = ceil($total_records / $no_of_records_per_page);

    if (isset($_GET['search'])){
        return "Search Count for \"".$_GET['search']."\" : ".$total_records;

    }
    else{
        return "Article Count : ".$total_records;
    }
}

include_once 'functionalities/ipa-get-info.php';

$additionalQuery = authorSearch($conn);
?>