<?php
function countPublications($conn, $additionalQuery){
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $no_of_records_per_page = 10;
    // Get total number of records
    $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_publications WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%'".$additionalQuery.";");
    $total_records = pg_fetch_result($result_count, 0, 0);
    $total_pages = ceil($total_records / $no_of_records_per_page);

    if (isset($_GET['search'])){
        return "Search Count for \"".$_GET['search']."\" : ".$total_records;

    }
    else{
        return "Publications Count : ".$total_records;
    }
}

include_once 'functionalities/publication-get-info.php';

$additionalQuery = authorSearch($conn);
?>