<?php
$items_per_page = 10; // items per page
$total_records = countLogs($logurl); // get total records

$search_query = $search != "empty_search" ? $_GET['search'] : ""; // check if log searched

$offset = ($page_number - 1) * $items_per_page; // intervals of 10 

//global variable from db.php
$json_data = @file_get_contents($logurl);
$data = json_decode($json_data, true);

if ($json_data !== false) {

    $filtered_data = array_filter($data['table_log'], function ($row) use ($search_query) {
        // Filter based on the search query in relevant columns
        $columns_to_search = ['date_time', 'activity', 'description'];
        foreach ($columns_to_search as $column) {
            if (isset ($row[$column]) && stripos($row[$column], $search_query) !== false) {
                return true;
            }
        }
        return false;
    });

    $total_records = count($filtered_data); // update total records

    // Sort the data based on 'date_time' column in ascending order
    usort($filtered_data, function ($a, $b) {
        $timestamp_a = strtotime($a['date_time']);
        $timestamp_b = strtotime($b['date_time']);

        return $timestamp_b - $timestamp_a;
    });
} else {
    $filtered_data = [];
}

// Function to fetch user data from the API URL based on user_id
function fetchUserData($userurl, $user_id)
{
    $json_data = file_get_contents($userurl);

    // Decode the JSON response into an associative array
    $data = json_decode($json_data, true);

    // Find the user data based on user_id
    foreach ($data['table_user'] as $user) {
        if ($user['user_id'] === $user_id) {
            return $user;
        }
    }

    // Return null if user data is not found
    return null;
}

// Apply pagination
$filtered_data = array_slice($filtered_data, $offset, $items_per_page);

if (count($filtered_data) > 0) {
    foreach ($filtered_data as $row) {
        // Extract the date from the 'date_time' column
        $formatted_date = isset($row['date_time']) ? date('F d, Y - h:i A', strtotime($row['date_time'])) : "N/A";

        // Get the user_id from the current row
        $user_id = isset($row['user_id']) ? $row['user_id'] : null;

        // Fetch additional details from the API URL based on user_id
        $user_data = fetchUserData($userurl, $user_id);

        $sr_code = isset($user_data['sr_code']) ? $user_data['sr_code'] : "N/A";

        $user_full_name = "N/A";
        if ($user_data) {
            $user_full_name = isset($user_data['user_fname']) ? $user_data['user_fname'] . " " . $user_data['user_mname'] . " " . $user_data['user_lname'] : "N/A";
        }

        // Display the log data
        ?>
        <tr>
            <td>
                <?= $formatted_date; ?>
            </td>
            <td>
                <?= $sr_code; ?>
            </td>
            <td>
                <?= $user_full_name; ?>
            </td>
            <td>
                <?= isset($row['activity']) ? $row['activity'] : "N/A"; ?>
            </td>
            <td>
                <?= $row['description']; ?>
            </td>
        </tr>
        <?php
    }

} else {
    echo '<tr><td colspan="6">No Log Found!</td></tr>'; // if result is empty
}


?>