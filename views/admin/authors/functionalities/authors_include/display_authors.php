<?php
echo '<script src="https://kit.fontawesome.com/02052a094f.js" crossorigin="anonymous"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
$items_per_page = 10; // total item per page
$search_query = $search != 'empty_search' ? $search : ''; // check if the user searched
$role_query = $role != 'empty_role' ? $role : ''; // check if the user searched
$gender_query = $gender != 'empty_gender' ? $gender : ''; // check if the user searched
$total_records = countAuthors($authorurl); // function for total author base on search and filter
// determining what items will be displayed
$offset = ($page_number - 1) * $items_per_page; // 10 intervals

//global variable from db.php
$json_data = @file_get_contents($authorurl);
if ($json_data === false) {
    echo '<tr><td colspan="6">No Author Found!</td></tr>';
    return false;
}

$data = json_decode($json_data, true);

$filtered_data = array_filter($data['table_authors'], function ($row) use ($search_query, $role_query, $gender_query) {
    $match_search = false;
    $match_role = false;
    $match_gender = false;
    if (isset ($row['author_name']) && stripos($row['author_name'], $search_query) !== false) {
        $match_search = true;
    }

    if (isset ($row['gender']) && $row['gender'] == $gender_query || $gender_query == '') {
        $match_gender = true;
    }

    if (isset ($row['type_of_author']) && $row['type_of_author'] == $role_query || $role_query == '') {
        $match_role = true;
    }

    return $match_search && $match_gender && $match_role;
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
            <td>
                <?= $row['author_id']; ?>
            </td>
            <td>
                <?= $row['author_name']; ?>
            </td>
            <td>
                <?= isset($row['type_of_author']) ? $row['type_of_author'] : "N/A"; ?>
            </td>
            <td>
                <?= isset($row['gender']) ? $row['gender'] : "N/A"; ?>
            </td>
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
                <button class="edit-btn" id="a-edit-btn" name="edit"
                    onclick="window.location.href='./new/new-author.php?id=<?php echo $row['author_id'] ?>'"
                    title="Click to Edit"><i class="fas fa-pen-to-square"></i></button>
                <button class="delete-btn" id="ipa-delete-btn" name="delete"
                    onclick="confirmDelete('<?= $row['author_name'] ?>', '<?= $row['author_id'] ?>')" title="Click to Delete"><i
                        class="fas fa-trash-can"></i></button>
            </td>
        </tr>
        <?php
    }
} else {
    echo '<tr><td colspan="6">No Author Found!</td></tr>';
}
?>