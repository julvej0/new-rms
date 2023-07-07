<?php
$items_per_page = 10; // items per page
$total_records = countLogs($logurl); // get total records

$search_query = $search != "empty_search" ? $_GET['search'] : ""; // check if log searched

$offset = ($page_number - 1) * $items_per_page; // intervals of 10 

//global variable from db.php
$json_data = file_get_contents($logurl);
$data = json_decode($json_data, true);

$filtered_data = array_filter($data['table_log'], function ($row) use ($search_query) {
    // Filter based on the search query in relevant columns
    $columns_to_search = ['created_at', 'activity', 'description'];
    foreach ($columns_to_search as $column) {
        if (isset($row[$column]) && stripos($row[$column], $search_query) !== false) {
            return true;
        }
    }
    return false;
});

$total_records = count($filtered_data); // update total records

// Sort the data based on 'account_type' column in ascending order
usort($filtered_data, function ($a, $b) {
    return strcasecmp($a['created_at'], $b['created_at']);
});

// Apply pagination
$filtered_data = array_slice($filtered_data, $offset, $items_per_page);

// check if there is a result
if (count($filtered_data) > 0) {
    foreach ($filtered_data as $row) {
        // display results
        ?>
        <tr>
            <td><?= $row['created_at']; ?></td>
            <td><?= $row['sr_code']; ?></td>
            <td><?= $row['log_fname'] . "" . $row['log_mname'] . " " . $row['log_lname']; ?></td>
            <td><?= isset($row['activity']) ? $row['activity'] : "N/A"; ?></td>
            <td><?= $row['description']; ?></td>
        </tr>
    <?php
    }
} else {
    echo '<tr><td colspan="6">No Author Found!</td></tr>'; // if result is empty
}
?>
