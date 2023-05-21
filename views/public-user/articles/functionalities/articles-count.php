<?php

function countPublications($conn, $additionalQuery, $search, $campuses, $dateStart, $dateEnd){
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : '';
    // Get total number of records
    $count_sql = "SELECT COUNT(*)
            FROM (
                SELECT * 
                FROM table_publications 
                WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%' ";

    if ($additionalQuery !== "empty_search" ) {
        $count_sql .= $additionalQuery;
    }

    $count_sql .= " )AS searched_pub WHERE 1=1 ";

    if ($campuses !== 'empty_campus') {
        $count_sql.= "AND (";
        if(is_array($campuses)){
            foreach ($campuses as $campus){
                if ( $campus == $campuses[0]){
                    $count_sql .= "  searched_pub.campus = '$campus' ";
                }
                else{
                    $count_sql .= " OR  searched_pub.campus = '$campus' ";
                }
            
            }

        }
        else{
            $count_sql .= "  searched_pub.campus = '$campuses' ";
        }
        
        $count_sql .= ") ";
    }
    if ($dateStart !== 'empty_dStart' && $dateEnd !== 'empty_dEnd' ) {
        $count_sql .= " AND EXTRACT(YEAR FROM searched_pub.date_published) BETWEEN $dateStart AND $dateEnd";
    }

    $result_count = pg_query($conn, $count_sql);
    $total_records = pg_fetch_result($result_count, 0, 0);

    return $total_records;
}

?>