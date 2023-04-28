<title>RMS | EDIT PUBLICATION</title>
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
                <div class="btn-container">
                    <button class="select-columns-btn" onclick="rotateButton()" id="button-icon">+</button>   
                    <div class="checkbox-container" id="checkbox-container">
                        <input type="checkbox" name="col-title" id="col-title" checked>
                        <label class="checkbox-button" for="col-title">Title</label><br>
                        <input type="checkbox" name="col-type" id="col-type">
                        <label class="checkbox-button" for="col-type">Type</label><br>              
                        <input type="checkbox" name="col-publisher" id="col-publisher">
                        <label class="checkbox-button" for="col-publisher">Publisher</label><br>
                        <input type="checkbox" name="col-research-area" id="col-research-area">
                        <label class="checkbox-button" for="col-research-area">Research Area</label><br>
                        <input type="checkbox" name="col-college" id="col-college" checked >
                        <label class="checkbox-button" for="col-college">College</label><br>
                        <input type="checkbox" name="col-quartile" id="col-quartile">
                        <label class="checkbox-button" for="col-quartile">Quartile</label><br>
                        <input type="checkbox" name="col-campus" id="col-campus" checked>
                        <label class="checkbox-button" for="col-campus">Campus</label><br>
                        <input type="checkbox" name="col-sdg" id="col-sdg">
                        <label class="checkbox-button" for="col-sdg">SDG</label><br>
                        <input type="checkbox" name="col-date-published" id="col-date-published" checked >
                        <label class="checkbox-button" for="col-date-published">Date Published</label><br>
                        <input type="checkbox" name="col-authors" id="col-authors" checked >
                        <label class="checkbox-button" for="col-authors">Authors</label><br>
                        <input type="checkbox" name="col-funding" id="col-funding">
                        <label class="checkbox-button" for="col-funding">Funding</label><br>
                        <input type="checkbox" name="col-fund-type" id="col-fund-type">
                        <label class="checkbox-button" for="col-fund-type">Fund Type</label><br>
                        <input type="checkbox" name="col-fund-agency" id="col-fund-agency" >
                        <label class="checkbox-button" for="col-fund-agency">Fund Agency</label><br>
                        <input type="checkbox" name="col-citations" id="col-citations" checked >
                        <label class="checkbox-button" for="col-citations">Citations</label>
                    </div>
                </div>
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
                            <th class="col-title" style="min-width: 350px;">Title</th>
                            <th class="col-type">Type</th>
                            <th class="col-publisher" style="min-width: 190px;">Publisher</th>
                            <th class="col-research-area">Research Area</th>
                            <th class="col-college">College</th>
                            <th class="col-quartile">Quartile</th>
                            <th class="col-campus">Campus</th>
                            <th class="col-sdg">SDG's</th>
                            <th class="col-date-published">Date Published</th>
                            <th class="col-authors" style="min-width: 190px;">Authors</th>
                            <th class="col-funding">Funding</th>
                            <th class="col-fund-type">Fund Type</th>
                            <th class="col-fund-agency">Fund Source</th>
                            <th class="col-citations">Citations</th>
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
                                <form action="edit-publication.php" method="POST">
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
<script>
            // Floating action rotate
            let isRotated = false;
            const checkboxContainer = document.getElementById("checkbox-container");

            function rotateButton() {
                const buttonIcon = document.getElementById("button-icon");
                if (isRotated) {
                    buttonIcon.style.transform = "rotate(0deg)";
                    checkboxContainer.style.opacity = 0;
                    setTimeout(() => {
                        checkboxContainer.style.display = "none";
                    }, 300); // wait for transition to complete before hiding container
                    isRotated = false;
                } else {
                    buttonIcon.style.transform = "rotate(135deg)";
                    checkboxContainer.style.display = "block";
                    setTimeout(() => {
                        checkboxContainer.style.opacity = 1;
                    }, 0); // wait for display to update before starting transition
                    isRotated = true;
                }
            }





            // get all the checkboxes
            var checkboxes = document.querySelectorAll('input[type=checkbox]');

            // loop through each checkbox
            checkboxes.forEach(function(checkbox) {

            // Hide cells that correspond to unchecked checkboxes by default
            var colName = checkbox.name;
            var cells = document.querySelectorAll('.' + colName);
            cells.forEach(function(cell) {
            cell.style.display = checkbox.checked ? 'table-cell' : 'none';
            });

            // add event listener for when the checkbox state changes
            checkbox.addEventListener('change', function() {
                // get the name of the checkbox
                var colName = this.name;
                // get the table cells that correspond to this column name
                var cells = document.querySelectorAll('.' + colName);
                // loop through each cell and hide/show it based on checkbox state
                cells.forEach(function(cell) {
                cell.style.display = checkbox.checked ? 'table-cell' : 'none';
                });
            });
            });

            // loop through each checkbox
            checkboxes.forEach(function(checkbox) {

                // get the stored state of the checkbox
                var storedState = sessionStorage.getItem(checkbox.name);

                // if there is a stored state, update the checkbox state to match it
                if (storedState !== null) {
                checkbox.checked = storedState === 'true';
                }

                // add event listener for when the checkbox state changes
                checkbox.addEventListener('change', function() {
                // store the state of the checkbox in session storage
                sessionStorage.setItem(checkbox.name, checkbox.checked);
                
                // get the name of the checkbox
                var colName = this.name;
                // get the table cells that correspond to this column name
                var cells = document.querySelectorAll('.' + colName);
                // loop through each cell and hide/show it based on checkbox state
                cells.forEach(function(cell) {
                    cell.style.display = checkbox.checked ? 'table-cell' : 'none';
                });
                });

                // Hide cells that correspond to unchecked checkboxes by default
                var colName = checkbox.name;
                var cells = document.querySelectorAll('.' + colName);
                cells.forEach(function(cell) {
                cell.style.display = checkbox.checked ? 'table-cell' : 'none';
                });
            });

            </script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>