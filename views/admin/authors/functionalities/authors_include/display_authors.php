
<?php
echo '<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>';
$items_per_page = 10; // total item per page
$search_query = $search != 'empty_search' ? $search : ''; // check if the user searched
$total_records = countAuthors($authorurl); // function for total author base on search and filter

// determining what items will be displayed
$offset = ($page_number - 1) * $items_per_page; // 10 intervals

//global variable from db.php
$json_data = file_get_contents($authorurl);
$data = json_decode($json_data, true);

$filtered_data = array_filter($data['table_authors'], function ($row) use ($search_query) {
    // Filter based on the search query in relevant columns
    $columns_to_search = ['author_id', 'author_name', 'type_of_author', 'gender', 'affiliation'];
    foreach ($columns_to_search as $column) {
        if (isset($row[$column]) && stripos($row[$column], $search_query) !== false) {
            return true;
        }
    }
    return false;
});

$total_records = count($filtered_data); // update total records

// Sort the data based on 'author_id' column in ascending order
usort($filtered_data, function ($a, $b) {
    return strcasecmp($a['author_id'], $b['author_id']);
});

// Apply pagination
$filtered_data = array_slice($filtered_data, $offset, $items_per_page);

// check for result
if (count($filtered_data) > 0) {
    // display result
    foreach ($filtered_data as $row) {
        ?>
        <tr>
            <td><?= $row['author_id']; ?></td>
            <td><?= $row['author_name']; ?></td>
            <td><?= isset($row['type_of_author']) ? $row['type_of_author'] : "N/A"; ?></td>
            <td><?= isset($row['gender']) ? $row['gender'] : "N/A"; ?></td>
            <td>
                <?php
                // check if affiliation is null or undefined
                if (!isset($row['affiliation']) || is_null($row['affiliation'])) {
                    echo "N/A";
                } else {
                    // display affiliation
                    $affiliation = explode(' || ', $row['affiliation']); // separate internal and external affiliation

                    // initializations
                    $internal_affiliation = ""; // container for internal
                    $external_affiliation = ""; // container for external

                    // extract internal
                    if (count($affiliation) > 0) {
                        foreach (explode('_', $affiliation[0]) as $in_aff) {
                            if ($in_aff != "") {
                                $internal_affiliation .= $in_aff . ", BatStateU <br>";
                            } else {
                                $internal_affiliation = "";
                            }
                        }
                    }

                    // extract external
                    if (count($affiliation) > 1) {
                        foreach (explode('_', $affiliation[1]) as $ex_aff) {
                            $external_affiliation = $ex_aff . "<br>";
                        }
                    }

                    // if both empty
                    if ($internal_affiliation == "" && $external_affiliation == "") {
                        echo "N/A";
                    }
                    // if existing
                    else {
                        $all_affiliation = array($internal_affiliation, $external_affiliation);
                        echo implode('', $all_affiliation);
                    }
                }
                ?>
                </td>
                <td id="white-side" class="a-action-btns stickey-col">
                    <button class="edit-btn" id="a-edit-btn" name="edit" onclick="window.location.href='new-author.php?id=<?php echo $row['author_id']?>'" title="Click to Edit"><i class="fas fa-pen-to-square"></i></button>
                    <button class="delete-btn" id="ipa-delete-btn" name="delete" onclick="confirmDelete('<?=$row['author_id']?>')" title="Click to Delete"><i class="fas fa-trash-can"></i></button>
                </td>
        </tr>
                <?php
    }
} else {
    echo '<tr><td colspan="6">No Author Found!</td></tr>';
}
?>