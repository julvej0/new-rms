<title>RMS | IP ASSETS</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
    require_once('functionalities/ipa-get-info.php');

    $additionalQuery= authorSearch($conn);
    $table_rows = get_data($conn, $additionalQuery);
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./ip-assets.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!--Font Awesome CDN-->

<body>
    <?php
        include '../../../includes/admin/templates/navbar.php';
    ?>

    <main>
        <div class="header">
            <h1 class="title">IP-assets</h1>
            <div class="left">
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <a href="./new-ip-asset.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New Article</a>
            </div>
        </div>
        <section>
            <div class="table-container">
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
                            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                        $no_of_records_per_page = 10;
                        // Get total number of records
                        $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_ipassets WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors) ILIKE '%$search_query%'".$additionalQuery.";");
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
                        <td class="tbl-col"><?=$row['date_of_creation'];?></td>
                        <td class="date-reg-col col-date-reg"><?=$row['date_registered'];?></td>
                        <td class="campus-col col-campus"><?=$row['campus'];?></td>
                        <td class="college-col col-college"><?=$row['college'];?></td>
                        <td class="program-col col-program"><?=$row['program'];?></td>
                        <td class="authors-col col-authors"><?=$row['authors'];?></td>


                        <td class='pb-action-btns stickey-col'>
                            <!-- Open certificate in a new tab-->
                            <a href="<?=$row['hyperlink'];?>" target="<?php echo strpos($row['hyperlink'], 'drive.google.com') !== false ? '_blank' : ''; ?>" class="gdrive-btn">
                                <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
                            </a>
                            <form action="edit-ipa.php" method="POST">
                                <input type="hidden" name="row_id" value="<?=$row['registration_number']?>">
                                <button type="submit" class="edit-btn" name="edit"><i class="fa-solid fa-pen-to-square"></i></button>
                            </form>
                            <form action="functionalities/ipa-delete.php" method="POST">
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
            </div>
            <div class="table-footer">

            <?php
                function countIPA($conn){
                    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                    $no_of_records_per_page = 10;
                    // Get total number of records
                    $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_ipassets WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors) ILIKE '%$search_query%';");
                    $total_records = pg_fetch_result($result_count, 0, 0);
                    $total_pages = ceil($total_records / $no_of_records_per_page);

                    if (isset($_GET['search'])){
                        return "Search Count for \"".$_GET['search']."\" : ".$total_records;

                    }
                    else{
                        return "IP Asset Count : ".$total_records;
                    }
                }
            ?>
                <p><?=countIPA($conn)?></p>
                <div class="pagination">
                <?php if ($total_pages > 1) {
                    $current_page = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
                    $max_pages_to_show = 1000; // maximum number of pages to show in the pagination
                    $start_page = max(1, $current_page - (int)($max_pages_to_show / 2));
                    $end_page = min($start_page + $max_pages_to_show - 1, $total_pages); ?>
                    
                        <li>
                            <a href="?pageno=<?php echo ($start_page); ?>" class="prev-btn" <?php echo ($current_page==1 ? "style='pointer-events: none; cursor: ' not-allowed;'" : ""); ?>><i class='bx bx-chevrons-left icon'></i></a>
                        </li>
                        <li>
                            <a href="?pageno=<?php echo ($current_page-1); ?>" class="prev-btn" <?php echo ($current_page==1 ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-left icon'></i></a>
                        </li>
                        <li>
                            <?php if ($total_pages > 1) { ?>
                                <div class="page-num"><span class="current-page"><?php echo $current_page; ?></span></div>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="?pageno=<?php echo ($current_page+1); ?>" class="next-btn" <?php echo ($current_page==$total_pages ? "style='pointer-events: none;'" : ""); ?>><i class='bx bx-chevron-right icon' ></i></a>
                        </li>
                        <li>
                            <a href="?pageno=<?php echo ($end_page); ?>" class="next-btn" <?php echo ($current_page==$total_pages ? "style='pointer-events: none;'" : ""); ?>><i class='bx bxs-chevrons-right icon' ></i></a>
                        </li>
            
                    
                <?php } ?>
                </div>
            </div>
        </section>
    </main>

</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ip-assets.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>