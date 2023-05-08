<?php
    require_once('functionalities/ipa-get-info.php');

    $additionalQuery= authorSearch($conn);
    $table_rows = get_data($conn, $additionalQuery);
    $items_per_page = 10;
?>

<table>
    <thead>
        <tr>
            <th class="col-registration">Registration Number</th>
            <th class="col-title" style="min-width: 350px;">Title</th>
            <th class="col-type">Type</th>
            <th class="col-cow">Class of Work</th>
            <th class="col-date-cre">Date of Creation</th>
            <th class="col-date-reg">Date Registered</th>
            <th class="col-campus">Campus</th>
            <th class="col-college">College</th>
            <th class="col-program">Program</th>
            <th class="col-authors">Authors</th>
            <th class="col-status">Status</th>
            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
        $no_of_records_per_page = 10;
        // Get total number of records
        $ipa_search = "SELECT COUNT(*)
                            FROM (
                                SELECT * 
                                FROM table_ipassets 
                                WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors, status, certificate) ILIKE '%$search_query%' ";

            if ($additionalQuery !== null) {
            $ipa_search .= $additionalQuery;
            }

            $ipa_search .= " )AS searched_ipa WHERE 1=1 ";

            if ($type !== "empty_type") {
            $ipa_search .= " AND searched_ipa.type_of_document = '$type' ";
            }
            if ($class !== "empty_class") {
            $ipa_search .= " AND searched_ipa.class_of_work = '$class' ";
            }
            if ($year !== "empty_year") {
            $ipa_search .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) = '$year' ";
            }

        $result_count = pg_query($conn,$ipa_search);
        $total_records = pg_fetch_result($result_count, 0, 0);
        $total_pages = ceil($total_records / $no_of_records_per_page);
        
        

        if ($table_rows !== null) {
        foreach ($table_rows as $row) {
    ?>
    <tr>
        <td class="reg-num-col col-registration"><?=$row['registration_number'];?></td>
        <td class="title-col col-title"><?=$row['title_of_work'];?></td>
        <td class="type-col col-type"><?=$row['type_of_document'];?></td>
        <td class="cow-col col-cow"><?=$row['class_of_work'];?></td>
        <td class="cre-col col-date-cre"><?=$row['date_of_creation'];?></td>
        <td class="date-reg-col col-date-reg"><?=$row['date_registered'];?></td>
        <td class="campus-col col-campus"><?=$row['campus'];?></td>
        <td class="college-col col-college"><?=$row['college'];?></td>
        <td class="program-col col-program"><?=$row['program'];?></td>
        <td class="authors-col col-authors"><?=$row['authors'];?></td>
        <td class="status-col col-status"><?=$row['status'];?></td>

        
        <td class='pb-action-btns stickey-col'>
        <?php
            $dir = "functionalities/button_functions/";
            $certificate = $row['certificate'];
            $hyperlink = $row['hyperlink'];

            if (empty($hyperlink)) {
                // if hyperlink value is missing, set href attribute of <a> tag to the src attribute of <img> tag
                $hyperlink = $dir . $certificate;
            }
            ?>

            <a href="<?=$hyperlink;?>" target="<?php echo strpos($hyperlink, 'drive.google.com') !== false ? '_blank' : '_blank'; ?>" class="gdrive-btn">
                <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
            </a>
            <form action="edit-ipa.php" method="POST">
                <input type="hidden" name="row_id" value="<?=$row['registration_number']?>">
                <button type="submit" class="edit-btn" name="edit"><i class="fa-solid fa-pen-to-square"></i></button>
            </form>
            <form action="functionalities/button_functions/ipa-delete.php" method="POST">
                <input type="hidden" name="row_id" value="<?=$row['registration_number']?>">
                <button type="submit" class="delete-btn" name="delete"><i class="fa-solid fa-trash-can"></i></button>
            </form>
        </td>
    </tr>
    <?php
        }
    }else{
        ?>
        <tr>
            <td colspan='10' style="text-align:center">No Records Found!</td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>