<?php

function countIPAssets($conn, $search, $campuses, $dateStart, $dateEnd)
{
    //make a author search functionality
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : '';
    // Get total number of records
    $count = get_data($search, "", $dateStart, $dateEnd, $campuses);
    $total_records = count($count);

    return $total_records;
}

?>