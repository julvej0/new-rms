<?php
//get total number of ip asset from db base on search and filters
function countPublications($conn, $additionalQuery, $search, $type, $fund, $year ){
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : ''; //check if user searched
    // Get total number of records
    $count_sql = "SELECT COUNT(*)
            FROM (
                SELECT * 
                FROM table_publications 
                WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%' ";

    //check if searched matches authors' name
    if ($additionalQuery !== "empty_search") {
        $count_sql .= $additionalQuery;
    }

    $count_sql .= " )AS searched_pub WHERE 1=1 ";

    //check if user used filters
    if ($type !== 'empty_type') {
        $count_sql .= " AND searched_pub.type_of_publication = '$type' ";
    }
    if ($fund !== 'empty_fund') {
        $count_sql .= " AND searched_pub.nature_of_funding = '$fund' ";
    }
    if ($year !== 'empty_year') {
        $count_sql .= " AND EXTRACT(YEAR FROM searched_pub.date_published) = '$year' ";
    }

    //get result
    $result_count = pg_query($conn, $count_sql);
    $total_records = pg_fetch_result($result_count, 0, 0);

    return $total_records; //return number of records base on search and filters

}

?>