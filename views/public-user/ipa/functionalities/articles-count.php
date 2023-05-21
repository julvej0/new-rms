<?php

function countIPAssets($conn, $additionalQuery, $search, $campuses, $dateStart, $dateEnd){
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : '';
    // Get total number of records
    $count_sql = "SELECT COUNT(*)
            FROM (
                    SELECT * 
                    FROM table_ipassets 
                    WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, status, certificate) ILIKE '%$search_query%' ";


    if ($additionalQuery !== "empty_search" ) {
        $count_sql .= $additionalQuery;
    }

    $count_sql .= " )AS searched_ipa WHERE 1=1 ";

    if ($campuses !== 'empty_campus') {
        $count_sql.= "AND (";
        if(is_array($campuses)){
            foreach ($campuses as $campus){
                if ( $campus == $campuses[0]){
                    $count_sql .= "  searched_ipa.campus = '$campus' ";
                }
                else{
                    $count_sql .= " OR  searched_ipa.campus = '$campus' ";
                }
            
            }

        }
        else{
            $count_sql .= "  searched_ipa.campus = '$campuses' ";
        }
        
        $count_sql .= ") ";
    }
    if ($dateStart !== 'empty_dStart' && $dateEnd !== 'empty_dEnd' ) {
        $count_sql .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) BETWEEN $dateStart AND $dateEnd";
    }

    $result_count = pg_query($conn, $count_sql);
    $total_records = pg_fetch_result($result_count, 0, 0);

    return $total_records;
}

?>