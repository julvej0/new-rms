<?php
    require_once('functionalities/ipa-get-info.php');
    require_once('functionalities/ipa_include/ipa_count.php');

    $additionalQuery = authorSearch($conn, $search);
    $table_rows = get_data($conn, $additionalQuery, $search, $type, $class, $year, $page_number);
    $total_records = countIPA($conn, $additionalQuery, $search, $type, $class, $year);
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
    

            ?>


            
            <a onclick="redirect('<?=$hyperlink != null? $hyperlink : 'no_url';?>')"  class="gdrive-btn">
                <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
            </a>
            <form action="edit-ipa.php" method="POST">
                <input type="hidden" name="row_id" value="<?=$row['registration_number']?>">
                <button type="submit" class="edit-btn" name="edit"><i class="fa-solid fa-pen-to-square"></i></button>
            </form>
           
            <button class="delete-btn" name="delete" onclick="confirmDelete('<?=$row['registration_number']?>')"><i class="fa-solid fa-trash-can"></i></button>
           
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

<script>
   
</script>
