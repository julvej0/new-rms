<?php
//get total number of ip asset from db base on search and filters
function countIPA($conn, $additionalQuery, $search, $type, $class, $year ){
    $search_query = $search != "empty_search" ? $search : ''; //check if user searched
    // Get total number of records
    $count_sql = "SELECT COUNT(*)
            FROM (
                SELECT * 
                FROM table_ipassets 
                WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors, status, certificate) ILIKE '%$search_query%' ";

    //check if searched matches authors' name
    if ($additionalQuery !== "empty_search") {
        $count_sql .= $additionalQuery;
    }

    $count_sql .= " )AS searched_ipa WHERE 1=1 ";

    //check if user used filters
    if ($type !== 'empty_type') {
        $count_sql .= " AND searched_ipa.type_of_document = '$type' ";
    }
    if ($class !== 'empty_class') {
        $count_sql .= " AND searched_ipa.class_of_work = '$class' ";
    }
    if ($year !== 'empty_year') {
        $count_sql .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) = '$year' ";
    }

    //get result
    $result_count = pg_query($conn, $count_sql);
    $total_records = pg_fetch_result($result_count, 0, 0);

    return $total_records; //return number of records base on search and filters
}

?>