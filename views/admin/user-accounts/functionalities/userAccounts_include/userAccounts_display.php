<?php
    $items_per_page = 10;
    $total_records = countUserAccounts($conn);

    $search_query = $search != "empty_search"? $_GET['search'] : "";
    $offset = ($page_number - 1) * $items_per_page;
    $sql = "SELECT * FROM table_user WHERE CONCAT(sr_code, user_fname, user_mname, user_lname, email, user_contact) ILIKE '%$search_query%'";
    if ($type !== "empty_type") {
        $sql .= " AND account_type = '$type' ";
    }

    $sql .= "ORDER BY user_id DESC LIMIT $items_per_page OFFSET $offset";
    $result = pg_query($conn, $sql);

    if(pg_num_rows($result) > 0){
    while ($row = pg_fetch_assoc($result)) {
    ?>
    <tr>
        <td ><?=$row['sr_code'];?></td>
        <td ><img id="user-image" src="<?=$row['user_img']; ?>" alt="User Image" style="width:6.25rem; height:6.25rem;"></td>
        <td ><?=$row['user_fname']." ".$row['user_mname']." ".$row['user_lname'];?></td>
        <td><?=$row['user_contact']; ?></td>
        <td><?=$row['email']; ?></td>
       
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>';
        }
        ?>
    </tr>

    
    