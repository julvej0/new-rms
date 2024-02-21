<?php
$items_per_page = 10; // items per page
$total_records = countUserAccounts($userurl); // get total records

$search_query = $search != "empty_search" ? $_GET['search'] : ""; // check if user searched

$offset = ($page_number - 1) * $items_per_page; // intervals of 10 

//global variable from db.php
$json_data = file_get_contents($userurl);
$data = json_decode($json_data, true);

$filtered_data = array_filter($data['table_user'], function ($row) use ($search_query) {
    // Filter based on the search query in relevant columns
    $columns_to_search = ['sr_code', 'user_fname', 'user_mname', 'user_lname', 'account_type', 'email', 'user_contact'];
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
        $userPic = '../../../account-management/uploads/user.png'; // image url 
        // display results
        ?>
        <tr>
            <td><?= $row['sr_code']; ?></td>
            <td><img id="user-image" src="<?= isset($row['user_img']) ? $row['user_img'] : $userPic; ?>"
                    alt="User Image" style="width:6.25rem; height:6.25rem;"></td>
            <td><?= $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname']; ?></td>
            <td><?= isset($row['account_type']) ? $row['account_type'] : ""; ?></td>
            <td><?= isset($row['user_contact']) ? $row['user_contact'] : "N/A"; ?></td>
            <td><?= $row['email']; ?></td>
        </tr>
    <?php
    }
} else {
    echo '<tr><td colspan="6">No Author Found!</td></tr>'; // if result is empty
}
?>
