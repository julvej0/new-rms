<?php
function getDistinctYear($conn){
    $result_distinct = pg_query($conn, "SELECT DISTINCT EXTRACT(YEAR FROM date_registered) AS year_only FROM table_ipassets ORDER BY year_only DESC");
    $result = pg_num_rows($result_distinct);

    if ($result > 0) {
        while ($row = pg_fetch_assoc($result_distinct)) {
            $table_rows[] = $row['year_only'];
        }
        return $table_rows;
    } else {
        return null;
    }
}
?>