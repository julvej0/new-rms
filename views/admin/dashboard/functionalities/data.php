<?php

// Execute SQL query
$query = "SELECT campus, COUNT(*) as dataset FROM table_ipassets GROUP BY campus";
$result = pg_query($conn, $query);

// Process query result
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = array(
        "name" => $row["campus"],
        "data" => $row["dataset"]
    );
}
$json_data = json_encode($data);

// Return JSON data
header('Content-Type: application/json');
echo $json_data;
?>  