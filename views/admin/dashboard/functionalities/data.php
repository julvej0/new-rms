<?php
    $query = "SELECT EXTRACT(YEAR FROM date_published) AS year, COUNT(*) AS count
            FROM table_publications
            GROUP BY EXTRACT(YEAR FROM date_published)
            ORDER BY EXTRACT(YEAR FROM date_published) ASC;";

    $query_run = pg_query($conn, $query);

    if (pg_num_rows($query_run) > 0) {
        $year = array();
        $year_data = array();
        while($data = pg_fetch_array($query_run)){
            $year[] = $data['year'];
            $year_data[] = $data['count'];
        }
    }

    $data = array(
        'year' => $year,
        'year_data' => $year_data
    );

    // Clear any previously buffered output
    ob_end_clean();

    // Send header before outputting any data
    header('Content-Type: application/json');

    // Output JSON data
    echo json_encode($data);
?>
