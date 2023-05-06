<?php

$year_rows = getDistinctYear($conn);
foreach ($year_rows as $year_filter) {
    ?>
    <li><a href='<?php echo filterIPA($search, $type, $class, $year_filter);?>'> <?php echo $year_filter;?></a></li>
<?php
 }


?>