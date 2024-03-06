<?php
function displayYearFilter($url, $search, $type, $fund){
    //get all years available from db
    $year_rows = getDistinctYear($url);
    if($year_rows == null){
        return;
    }

    //diplay year from filter
    foreach ($year_rows as $year_filter) {
        ?>
        <li><a href='<?php echo filterPublication($search, $type, $fund, $year_filter);?>'> <?php echo $year_filter;?></a></li>
    <?php
 }
    
}

function displayTypeFilter($url, $search, $fund, $year){
    //get all years type from db
    $type_rows = getDistinctType($url);
    if($type_rows == null){
        return;
    }
    //diplay type from filter
    foreach ($type_rows as $type_filter) {
        ?>
        <li><a href='<?php echo filterPublication($search, $type_filter, $fund, $year);?>'> <?php echo $type_filter;?></a></li>
    <?php
 }
    
}


?>