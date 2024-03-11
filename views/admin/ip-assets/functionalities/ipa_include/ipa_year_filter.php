<?php

//get all years available from db
include_once dirname(__FILE__, 6) . "/helpers/db.php";
$year_rows = getDistinctYear($ipassetsurl);

if($year_rows == null){
    ?><li><a>Empty</a></li><?php
    return null;
}
?><li><a href="<?= filterIPA($search, $type, $class, 'empty_year'); ?>">All</a></li><?php
//diplay year from filter
foreach ($year_rows as $year_filter) {
    ?>
    <li><a href='<?php echo filterIPA($search, $type, $class, $year_filter);?>'> <?php echo $year_filter;?></a></li>
<?php
 }


?>