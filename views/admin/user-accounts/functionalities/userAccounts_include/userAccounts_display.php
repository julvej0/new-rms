<?php
    $items_per_page = 10;
    $total_records = countUserAccounts($conn);

    
    $offset = ($page_number - 1) * $items_per_page;
    $sql = "SELECT * FROM table_user ";
    $sql .= "ORDER BY user_id DESC LIMIT $items_per_page OFFSET $offset";
    $result = pg_query($conn, $sql);

    if(pg_num_rows($result) > 0){
    while ($row = pg_fetch_assoc($result)) {
    ?>
    <tr>
        <td ><?=$row['sr_code'];?></td>
        <td ><?=$row['user_fname']." ".$row['user_mname']." ".$row['user_lname'];?></td>
        <td><?=$row['user_contact']; ?></td>
        <td><?=$row['email']; ?></td>
       
        </td>
        <td id="white-side" class="a-action-btns stickey-col">
            <a class="edit-btn" id="a-edit-btn" name="edit" ></i></a>
            <button class="delete-btn" id="ipa-delete-btn" name="delete"></i></button>
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>';
        }
        ?>
    </tr>

    
    