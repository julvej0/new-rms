<!-- <?php
$items_per_page = 10; // items per page
$total_records = countLogs($logurl); // get total records

$search_query = $search != "empty_search" ? $_GET['search'] : ""; // check if log searched

$offset = ($page_number - 1) * $items_per_page; // intervals of 10 

//global variable from db.php
$json_data = file_get_contents($logurl);
$data = json_decode($json_data, true);

$filtered_data = array_filter($data['table_logs'], function ($row) use ($search_query) {
    // Filter based on the search query in relevant columns
    $columns_to_search = ['sr_code', 'log_fname', 'log_mname', 'log_lname', 'account_type', 'email', 'log_contact'];
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
    return strcasecmp($a['account_type'], $b['account_type']);
});

// Apply pagination
$filtered_data = array_slice($filtered_data, $offset, $items_per_page);

// check if there is a result
if (count($filtered_data) > 0) {
    foreach ($filtered_data as $row) {
        $logPic = '../../../../../../new-rms-webdev/views/admin/account-management/uploads/log.png'; // image url

        // display results
        ?>
        <tr>
            <td><?= $row['sr_code']; ?></td>
            <td><img id="log-image" src="<?= isset($row['log_img']) ? $row['log_img'] : $logPic; ?>"
                    alt="log Image" style="width:6.25rem; height:6.25rem;"></td>
            <td><?= $row['log_fname'] . " " . $row['log_mname'] . " " . $row['log_lname']; ?></td>
            <td><?= isset($row['account_type']) ? $row['account_type'] : ""; ?></td>
            <td><?= isset($row['log_contact']) ? $row['log_contact'] : "N/A"; ?></td>
            <td><?= $row['email']; ?></td>
        </tr>
    <?php
    }
} else {
    echo '<tr><td colspan="6">No Author Found!</td></tr>'; // if result is empty
}
?> -->
