<?php

//get all years available from db
// function getDistinctYear($conn){
//     $result_distinct = pg_query($conn, "SELECT DISTINCT EXTRACT(YEAR FROM date_published::timestamp) AS year_only FROM table_publications ORDER BY year_only DESC");
//     $result = pg_num_rows($result_distinct);

//     if ($result > 0) {
//         while ($row = pg_fetch_assoc($result_distinct)) {
//             $table_rows[] = $row['year_only'];
//         }
//         return $table_rows;
//     } else {
//         return null;
//     }
// }

function getDistinctYear($url)
{
    $response = @file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $userData = json_decode($response, true)['table_publications'];

    $distinctYears = [];

    foreach ($userData as $asset) {
        $year = isset($asset['date_published']) ? date('Y', strtotime($asset['date_published'])) : null;
        // print_r($year . "haha");
        if (!in_array($year, $distinctYears) && $year != null) {
            $distinctYears[] = $year;
        }
    }

    rsort($distinctYears);

    return $distinctYears;
}

function getDistinctType($url)
{
    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }

    $userData = json_decode($response, true)['table_publications'];

    $distinctTypes = [];

    foreach ($userData as $publication) {
        $type = isset($publication["type_of_publication"]) ? $publication["type_of_publication"] : null;
        if (!in_array($type, $distinctTypes) && $type != null) {
            $distinctTypes[] = $type;
        }
    }
    rsort($distinctTypes);
    return $distinctTypes;

}

//get all type available from db
// function getDistinctType($conn){
//     $result_distinct = pg_query($conn, "SELECT DISTINCT type_of_publication AS types FROM table_publications");
//     $result = pg_num_rows($result_distinct);

//     if ($result > 0) {
//         while ($row = pg_fetch_assoc($result_distinct)) {
//             $table_rows[] = $row['types'];
//         }
//         return $table_rows;
//     } else {
//         return null;
//     }
// }

?>