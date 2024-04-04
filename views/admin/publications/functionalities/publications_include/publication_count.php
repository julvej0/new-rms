<?php
//get total number of ip asset from db base on search and filters
function countPublications($search, $type, $fund, $year)
{
    $no_of_records_per_page = 10;
    $search_query = $search != "empty_search" ? $search : ''; //check if user searched
    $count = get_data($search_query, $type, $fund, $year, "");
    $total_records = count($count);

    return $total_records; //return number of records base on search and filters

}

?>