<title>RMS | PUBLICATIONS</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
    require_once('functionalities/publication-get-info.php');

    $table_rows = get_data($conn);
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="publications.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!--Font Awesome CDN-->

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
?>
    <main>
        <div class="header">
            <h1 class="title">Publications</h1>
            <div class='left'>
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <a href="./new-publication.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New Article</a>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="th-header">Title</th>
                            <th class="th-header">Type</th>
                            <th class="th-header">Publisher</th>
                            <th class="th-header">Research Area</th>
                            <th class="th-header">College</th>
                            <th class="th-header">Quartile</th>
                            <th class="th-header">Campus</th>
                            <th class="th-header">SDG's</th>
                            <th class="th-header">Date Published</th>
                            <th class="th-header">Authors</th>
                            <th class="th-header">Funding</th>
                            <th class="th-header">Fund Type</th>
                            <th class="th-header">Fund Source</th>
                            <th class="th-header">Citations</th>
                            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                            //Search Query
                            $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                            $no_of_records_per_page = 10;
                            // Get total number of records
                            $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_publications WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%';");
                            $total_records = pg_fetch_result($result_count, 0, 0);
                            $total_pages = ceil($total_records / $no_of_records_per_page);
                        
                        if ($table_rows !== null) {
                        foreach ($table_rows as $row) {
                        ?>
                        <tr>
                            <td class="publication-col col-title" style="min-width: 15.625rem"><?=$row['title_of_paper'];?></td>
                            <td class="publication-col col-type"><?=$row['type_of_publication'];?></td>
                            <td class="publication-col col-publisher"><?=$row['publisher'];?></td>
                            <td class="publication-col col-research-area"><?=$row['department'];?></td>
                            <td class="publication-col col-college"><?=$row['college'];?></td>
                            <td class="publication-col col-quartile"><?=$row['quartile'];?></td>
                            <td class="publication-col col-campus"><?=$row['campus'];?></td>
                            <td class="publication-col col-sdg"><?=$row['sdg_no'];?></td>
                            <td class="publication-col col-date-published"><?=$row['date_published'];?></td>
                            <td class="publication-col col-authors"><?=$row['authors'];?></td>  
                            <td class="publication-col col-funding"><?=$row['nature_of_funding'];?></td>
                            <td class="publication-col col-fund-type"><?=$row['funding_type'];?></td>
                            <td class="publication-col col-fund-agency"><?=$row['funding_source'];?></td>
                            <td class="publication-col col-citations"><?=$row['number_of_citation'];?></td>
                            <td class='pb-action-btns stickey-col'>
                            <!-- Open certificate in a new tab-->
                                <a href="<?=$row['google_scholar_details'];?>" target="_blank" class="gdrive-btn">
                                        <i class="fa-solid fa-arrow-up-right-from-square icon"></i>
                                </a>
                                <form action="pb_edit_page.php" method="POST">
                                    <input type="hidden" name="row_id" value="<?=$row['publication_id']?>">
                                    <button type="submit" class="edit-btn" name="edit"><i class="fa-solid fa-pen-to-square icon"></i></button>
                                </form>
                                <form action="functionalities/publication-delete.php" method="POST" class="delete-form">
                                    <input type="hidden" name="row_id" value="<?=$row['publication_id']?>">
                                    <button type="submit" class="delete-btn" name="delete"><i class="fa-solid fa-trash-can icon"></i></button>
                                </form>                            
                        </td>
                    </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan='15' style="text-align:center">No Records Found!</td>
                    </tr>
                <?php
                }
                ?>
                    </tbody>
                </table>
            </div>
            <div class="table-footer">

            <?php
                function countPublications($conn){
                    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                    $no_of_records_per_page = 10;
                    // Get total number of records
                    $result_count = pg_query($conn, "SELECT COUNT(*) FROM table_publications WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%';");
                    $total_records = pg_fetch_result($result_count, 0, 0);
                    $total_pages = ceil($total_records / $no_of_records_per_page);

                    if (isset($_GET['search'])){
                        return "Author Count for \"".$_GET['search']."\" : ".$total_records;

                    }
                    else{
                        return "Author Count : ".$total_records;
                    }
                }
            ?>
                <p><?=countPublications($conn)?></p>
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
<script src="./publications.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>