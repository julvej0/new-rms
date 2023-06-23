<?php
    $items_per_page = 10; //items per page
    $total_records = countUserAccounts($conn); //get total records

    $search_query = $search != "empty_search"? $_GET['search'] : ""; //check if user searched

    $offset = ($page_number - 1) * $items_per_page; //interbals of 10 

    //query to select all data from db
    $sql = "SELECT * FROM table_user WHERE CONCAT(sr_code, user_fname, user_mname, user_lname, email, user_contact) ILIKE '%".rtrim($search_query)."%'";
    if ($type !== "empty_type") {
        $sql .= " AND account_type = '$type' ";
    }

    $sql .= "ORDER BY user_id DESC LIMIT $items_per_page OFFSET $offset"; //default order and offset
    $result = pg_query($conn, $sql); //fetch data

    //check if there is a result
    if(pg_num_rows($result) > 0){
    while ($row = pg_fetch_assoc($result)) {
        $userPic = '../../../../../../new-rms-webdev/views/admin/account-management/uploads/user.png'; //image url

        //display results
    ?>
    <tr>
        <td ><?=$row['sr_code'];?></td>
        <td><img id="user-image" src="<?=isset($row['user_img']) ? $row['user_img'] : $userPic;?>" alt="User Image" style="width:6.25rem; height:6.25rem;"></td>
        <td ><?=$row['user_fname']." ".$row['user_mname']." ".$row['user_lname'];?></td>
        <td ><?=$row['account_type']?></td>
        <td><?=$row['user_contact'] != null ? $row['user_contact'] : "N/A"; ?></td>
        <td><?=$row['email']; ?></td>
       
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>'; //if result is empty
        }
        ?>
    </tr>

    
    