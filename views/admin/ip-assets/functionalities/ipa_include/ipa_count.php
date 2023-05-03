<?php
function countIPA($conn){
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $no_of_records_per_page = 10;
    // Get total number of records
    $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_ipassets WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors, status) ILIKE '%$search_query%';");
    $total_records = pg_fetch_result($result_count, 0, 0);
    $total_pages = ceil($total_records / $no_of_records_per_page);

    if (isset($_GET['search'])){
        return "Search Count for \"".$_GET['search']."\" : ".$total_records;

    }
    else{
        return "Article Count : ".$total_records;
    }
}
?>