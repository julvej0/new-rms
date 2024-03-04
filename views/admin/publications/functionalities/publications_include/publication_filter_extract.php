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

function getDistinctYear($url) {
    $response = file_get_contents($url);

    if ($response === false) {
        echo "An error occurred while fetching data.";
        exit();
    }

    $userData = json_decode($response, true)['table_ipassets'];

    $distinctYears = [];

    foreach ($userData as $asset) {
        $year = date('Y', strtotime($asset['date_registered']));
        if (!in_array($year, $distinctYears)) {
            $distinctYears[] = $year;
        }
    }

    rsort($distinctYears);

    return $distinctYears;
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