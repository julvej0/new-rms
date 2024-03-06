<?php
//get distinct year from db 
// function getDistinctYear($conn){
//     $result_distinct = pg_query($conn, "SELECT DISTINCT EXTRACT(YEAR FROM date_registered::timestamp) AS year_only FROM table_ipassets ORDER BY year_only DESC");
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
    $response = file_get_contents($url);
    if ($response === false) {
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
?>