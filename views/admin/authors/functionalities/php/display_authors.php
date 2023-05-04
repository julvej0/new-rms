<?php
    $items_per_page = 10;
    $search_query = $search != 'empty_search' ? $search : '';
    $gender_filter = $gender != 'empty_gender' ? $gender : null;
    $role_filter = $role != 'empty_role' ? $role : null;
    $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;

    
    $offset = ($page_number - 1) * $items_per_page;
    $sql = "SELECT * FROM table_authors WHERE author_name ILIKE '%$search_query%' ";
    $params = [];
    if ($gender_filter !== null) {
        $sql .= " AND gender = '$gender_filter' ";
        $params[] = $gender_filter;
    }
    if ($role_filter !== null) {
        $sql .= " AND type_of_author = '$role_filter' ";
        $params[] = $role_filter;
    }
    $sql .= "ORDER BY author_id DESC LIMIT $items_per_page OFFSET $offset";
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
        <td ><?=$row['author_id'];?></td>
        <td ><?=$row['author_name'];?></td>
        <td><?=$row['type_of_author']== '' ? 'Not Yet Set' :   $row['type_of_author']; ?></td>
        <td><?=$row['gender']== '' ? 'Not Yet Set' :   $row['gender']; ?></td>
        <td><?php
                if (is_null($row['affiliation'])){
                    echo "Not Yet Set";
                }
                else{
                    $affiliation = explode(' || ', $row['affiliation']);
                    $internal_affiliation = "";
                    $external_affiliation = "";
                    if (count($affiliation)>0){
                        
                        foreach (explode('_', $affiliation[0]) as $in_aff){
                            if ($in_aff != ""){
                                $internal_affiliation .= $in_aff . ", BatStateU <br>";

                            }
                            else{
                                $internal_affiliation = "";
                            }
                            
                        }
                    }

                    if (count($affiliation)>1){
                        foreach (explode('_', $affiliation[1]) as $ex_aff){
                            $external_affiliation = $ex_aff . "<br>";
                        }
                    }

                    if ($internal_affiliation == "" && $external_affiliation == "" ){
                        echo "Not Yet Set";
                    }
                    else{
                        $all_affiliation =array($internal_affiliation, $external_affiliation);
                        echo implode('', $all_affiliation);
                    }
                
                    
            }
                
            ?>
        </td>
        <td id="white-side" class="a-action-btns stickey-col">
            <a class="edit-btn" id="a-edit-btn" name="edit" onclick="window.location.href='new-author.php?id=<?php echo $row['author_id'];?>'"> Edit </a>
            <button type="button" class="delete-btn" id="ipa-delete-btn" name="delete" onclick="confirmDelete('<?php echo $row['author_name'];?>', '<?php echo $row['author_id'];?>', <?php echo isset($_GET['page']) ? $_GET['page'] : 1 ;?>, '<?php echo isset($_GET['search']) ? $_GET['search'] : 'empty_search' ;?>')">Delete</button>
           
            
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>';
        }
        ?>
    </tr>

    
    