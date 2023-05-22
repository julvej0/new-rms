<?php
    $items_per_page = 10; //total item per page
    $search_query = $search != 'empty_search' ? $search : ''; //check if the user searched
    $total_records = countAuthors($conn, $search, $gender, $role); //function for total author base on search and filter

    //determining what items will be displayed 
    $offset = ($page_number - 1) * $items_per_page; //10 intervals

    //select query base on search
    $sql = "SELECT * FROM table_authors WHERE CONCAT(author_id, author_name, affiliation) ILIKE '%".rtrim($search_query)."%' ";

    //additional query if the user has filter
    if ($gender !== "empty_gender") {
        $sql .= " AND gender = '$gender' ";
    }
    if ($role !== "empty_role") {
        $sql .= " AND type_of_author = '$role' ";
    }

    //default order with offset
    $sql .= "ORDER BY author_id DESC LIMIT $items_per_page OFFSET $offset";
    $result = pg_query($conn, $sql); // run the query

    //check for result
    if(pg_num_rows($result) > 0){
        //display result
        while ($row = pg_fetch_assoc($result)) {
    ?>
    <tr>
        <td ><?=$row['author_id'];?></td>
        <td ><?=$row['author_name'];?></td>
        <td><?=$row['type_of_author']== '' ? 'N/A' :   $row['type_of_author']; ?></td>
        <td><?=$row['gender']== '' ? 'N/A' :   $row['gender']; ?></td>
        <td><?php
                //check if affiliation is null
                if (is_null($row['affiliation'])){
                    echo "N/A";
                }
                else{
                    //display affiliation 
                    $affiliation = explode(' || ', $row['affiliation']); //separate internal and external affiliation

                    // initializations
                    $internal_affiliation = "";  //container for internal
                    $external_affiliation = "";  //container for external

                    //extract internal
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

                    //extract external
                    if (count($affiliation)>1){
                        foreach (explode('_', $affiliation[1]) as $ex_aff){
                            $external_affiliation = $ex_aff . "<br>";
                        }
                    }

                    //if both empty 
                    if ($internal_affiliation == "" && $external_affiliation == "" ){
                        echo "N/A";
                    }
                    //if existing
                    else{
                        $all_affiliation =array($internal_affiliation, $external_affiliation);
                        echo implode('', $all_affiliation);
                    }
                
                    
            }
                
            ?>
        </td>
        <td id="white-side" class="a-action-btns stickey-col">
            <a class="edit-btn" id="a-edit-btn" name="edit" onclick="window.location.href='new-author.php?id=<?php echo $row['author_id'];?>'"><i class="fa-solid fa-pen-to-square icon"></i></a>
            <button class="delete-btn" id="ipa-delete-btn" name="delete" onclick="confirmDelete('<?php echo $row['author_name'];?>', '<?php echo $row['author_id'];?>')"><i class="fa-solid fa-trash-can icon"></i></button>
        </td>
        
        <?php
            }
        }
        else{
            echo '<td colspan="6">No Author Found!</td>';
        }
        ?>
    </tr>

    
    