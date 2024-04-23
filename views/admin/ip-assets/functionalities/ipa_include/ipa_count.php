<?php
//get total number of ip asset from db base on search and filters
function countIPA($ipassetsurl, $authorurl, $search, $type, $class, $year)
{
    if($search == "empty_search") $search = "";
    if($type == "empty_type") $type = "";
    if($class == "empty_class") $class = "";
    if($year == "empty_year") $year = "";
    // Get total number of records
    $count = @file_get_contents($ipassetsurl . "?search=$search&type=$type&class=$class&year=$year");
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