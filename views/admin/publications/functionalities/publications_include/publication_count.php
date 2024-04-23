<?php
//get total number of ip asset from db base on search and filters
function countPublications($search, $type, $fund, $year)
{
    if($search == "empty_search") $search = "";
    if($type == "empty_type") $type = "";
    if($fund == "empty_fund") $fund = "";
    if($year == "empty_year") $year = "";
    // Get total number of records
    $count = @file_get_contents('http://localhost:5000/table_publications' . "?search=$search&type=$type&fund=$fund&year=$year");
    $json_data = json_decode($count, true);

    if($json_data != null){
        $total_count = $json_data['total_count'];
    }else{
        $total_count = 0;
    }
    //get result
    $total_records = $total_count ? $total_count : 0;

    return $total_records; //return number of records base on search and filters

}

?>