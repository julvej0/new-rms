<?php
    $items_per_page = 8;
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($page_number - 1) * $items_per_page;
    $sql = "SELECT * FROM table_authors WHERE author_name ILIKE '%$search_query%' ORDER BY author_id LIMIT $items_per_page OFFSET $offset";
    $result = pg_query($conn, $sql);
    if (isset($_GET['search'])){
    $deleteURL = '?search='.$search_query.'&page='.$page_number;
    }
    else{
    $deleteURL = '?page='.$page_number;
    }

    if(pg_num_rows($result) > 0){
    while ($row = pg_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?=$row['author_id'];?></td>
        <td><?=$row['author_name'];?></td>
        <td><?php
                if (is_null($row['gender'])) {
                    echo 'Not yet Set';
                } else {
                    echo $row['gender'];
                }
            ?>
        </td>
        <td><?php
                if (is_null($row['type_of_author'])) {
                    echo 'Not yet Set';
                } else {
                    echo $row['type_of_author'];
                }
            ?>
        </td>
        <td><?php
                if (is_null($row['affiliation'])) {
                    echo 'Not yet Set';
                } else {
                    $affiliation = explode(' || ', $row['affiliation']);
                    $affiliation2 = implode('<br>', $affiliation);
                    $affiliation3 = explode('_', $affiliation2);
                    $affiliation4 = implode(',<br> ', $affiliation3);
                    
                    
                    echo $affiliation4;
                }
            ?>
        </td>
        <td id="white-side" class="a-action-btns">
            <a class="edit-btn" id="a-edit-btn" name="edit" onclick="window.location.href='new-author.php?id=<?php echo $row['author_id'];?>'"> Edit </a>
            
            <a type="button" class="delete-btn" id="ipa-delete-btn" name="delete" onclick="window.location.href='<?php echo $deleteURL.'&id='.$row['author_id'];?>'">Delete</a>
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>';
        }
        ?>
    </tr>