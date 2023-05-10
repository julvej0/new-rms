<title>RMS | EDIT PUBLICATION</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="publications.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!--Font Awesome CDN-->

<body>
<?php
    include '../../../includes/admin/templates/navbar.php';
    include_once 'functionalities/publications_include/publication_filter_extract.php';
    
    include_once 'functionalities/publications_include/publication_filter.php';
    
    $search = isset($_GET['search']) ? $_GET['search']: 'empty_search';

    $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';
    $fund = isset($_GET['fund']) ? $_GET['fund']: 'empty_fund';
    $year = isset($_GET['year']) ? $_GET['year']: 'empty_year';

    $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>
    <main>
        <div class="header">
            <h1 class="title">Publications</h1>
            <div class="btn-container">
                    <button class="select-columns-btn" onclick="rotateButton()" id="button-icon"><i class="fa-solid fa-plus fa-2xs"></i></button>   
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
            <div class='left'>
            
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn"><?=$type!="empty_type" ? $type: 'Type'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterPublication($search, 'Original', $fund, $year)?>">Original</a></li>
                        <li><a href="<?=filterPublication($search, 'Review', $fund, $year)?>">Review</a></li>
                        <li><a href="<?=filterPublication($search, 'Proceedings', $fund, $year)?>">Proceedings</a></li>
                        <li><a href="<?=filterPublication($search, 'Communication', $fund, $year)?>">Communication</a></li>
                        <li><a href="<?=filterPublication($search, 'International', $fund, $year)?>">International</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$fund!="empty_fund" ? $fund: 'Fund'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterPublication($search, $type, 'funded', $year)?>">Funded</a></li>
                        <li><a href="<?=filterPublication($search, $type, 'non-funded', $year)?>">Non-funded</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$year!="empty_year" ? $year: 'Year'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <?php
                            include_once 'functionalities/publications_include/publication_filter_display.php';
                        ?>
                       
                    </ul>
                </div>
                <a href="./new-publication.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New</a>
            </div>
        </div>
        <section>

        <div class="table-container">
                <?php
                    include_once 'functionalities/publications_include/publication_table.php';
                ?>
            </div>
            
        
                <?php
                    include_once 'functionalities/publications_include/pagination.php';
                ?>
        </section>
    </main>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="publications.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>