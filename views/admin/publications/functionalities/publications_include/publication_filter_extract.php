<?php 

//get all years available from db
function getDistinctYear($conn){
    $result_distinct = pg_query($conn, "SELECT DISTINCT EXTRACT(YEAR FROM date_published) AS year_only FROM table_publications ORDER BY year_only DESC");
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

//get all type available from db
function getDistinctType($conn){
    $result_distinct = pg_query($conn, "SELECT DISTINCT type_of_publication AS types FROM table_publications");
    $result = pg_num_rows($result_distinct);

    if ($result > 0) {
        while ($row = pg_fetch_assoc($result_distinct)) {
            $table_rows[] = $row['types'];
        }
        return $table_rows;
    } else {
        return null;
    }
}
?>