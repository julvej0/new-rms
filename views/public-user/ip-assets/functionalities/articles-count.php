<?php

function countIPAssets($search, $campuses, $dateStart, $dateEnd)
{
    //make a author search functionality
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : '';
    // Get total number of records
    $count = get_data($search_query, "", $dateStart, $dateEnd, $campuses);
    $total_records = count($count);

    return $total_records;
}

?>