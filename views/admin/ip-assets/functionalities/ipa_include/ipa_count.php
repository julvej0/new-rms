<?php
//get total number of ip asset from db base on search and filters
function countIPA($ipassetsurl, $authorurl, $search, $type, $class, $year)
{
    $search_query = $search != "empty_search" ? $search : ''; //check if user searched
    // Get total number of records
    $count = get_data($ipassetsurl, $authorurl, $search_query, $type, $class, $year, 1);
    
    //get result
    $total_records = count($count);

    return $total_records; //return number of records base on search and filters
}

?>