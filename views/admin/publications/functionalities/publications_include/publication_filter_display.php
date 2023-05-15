<?php
function displayYearFilter($conn, $search, $type, $fund){
    $year_rows = getDistinctYear($conn);
    foreach ($year_rows as $year_filter) {
        ?>
        <li><a href='<?php echo filterPublication($search, $type, $fund, $year_filter);?>'> <?php echo $year_filter;?></a></li>
    <?php
 }
    
}

function displayTypeFilter($conn, $search, $fund, $year){
    $type_rows = getDistinctClass($conn);
    foreach ($type_rows as $type_filter) {
        ?>
        <li><a href='<?php echo filterPublication($search, $type_filter, $fund, $year);?>'> <?php echo $type_filter;?></a></li>
    <?php
 }
    
}


?>