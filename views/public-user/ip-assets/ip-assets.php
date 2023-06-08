<title>RMS | PUBLISHED ARTICLES</title>
<?php 
    include dirname(__FILE__, 4) . '/components/header/header.php';
    include dirname(__FILE__, 4) . '/components/public-user/templates/user-navbar.php'; 

    include './functionalities/articles-count.php';
    include './functionalities/articles-sort.php';


    $search_query = (isset($_GET['search-table']) && $_GET['search-table'] != '' && strpos($_GET['search-table'], "'") === false) ?  $_GET['search-table'] : 'empty_search';
    $sort_query = (isset($_GET['sort']) && $_GET['sort'] != '' ) ?  $_GET['sort'] : 'empty_sort';
    $campus_query = isset($_GET['select-campus']) ?  $_GET['select-campus'] : 'empty_campus';
    $dateStart_query = (isset($_GET['date-start']) && $_GET['date-start'] != '') ?  $_GET['date-start'] : 'empty_dStart';
    $dateEnd_query = (isset($_GET['date-end']) && $_GET['date-end'] != '') ?  $_GET['date-end'] : 'empty_dEnd';

    $page_number= isset($_GET['page']) ?  intval($_GET['page']) : 1 ;

?>

<!-- TODO: add a Loading message inside the table to show it's doing something -->
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./ip-assets.css">
<link rel="stylesheet" href="../../../css/animatev4.1.1.min.css"/>
<body>
    <section id="main-content">
        <div class="page-title">
            <h3 class="animate__animated animate__fadeIn">IP ASSETS</h3>
        </div>
        <div class="table-container animate__animated animate__fadeIn" id="tbl-container">
            <div class="header">
                <div class="left">
                    <h4>DOCUMENTS</h4>
                </div>
                <div class="right">
                    <form>
                        <div class="form-control" method="GET" action="">
                            <input type='text' name='search-table' placeholder='Search Article or Author' value="<?=isset($_GET['search-table']) ?  $_GET['search-table'] : ''?>">
                            <i class='bx bx-search icon' ></i>
                        </div>
                    </form>
                    <div class="sort-btn">
                        <button id="btn-sort"><i class='bx bx-sort icon' ></i>Sort</button>
                        <ul class="sort-links">
                            <li><a href="<?= sortLink($search_query, 'title', $dateStart_query, $dateEnd_query, $campus_query) ?>">by Title</a></li>
                            <li><a href="<?= sortLink($search_query, 'date', $dateStart_query, $dateEnd_query, $campus_query) ?>">by Date</a></li>
                            <li><a href="<?= sortLink($search_query, 'campus', $dateStart_query, $dateEnd_query, $campus_query) ?>">by Campus</a></li>
                        </ul>
                    </div>
                    <div class="filter-btn">
                        <button id="btn-filter"><i class='bx bx-filter icon' ></i>Filter</button>
                        <div class="filter-options">
                            <form action="">
                                <input type="hidden" name="search-table" value="<?=$search_query != 'empty_search' ?  $search_query : '' ?>">
                                <input type="hidden" name="sort" value="<?=$sort_query != 'empty_sort' ?  $sort_query : '' ?>">

                                <p>By Date :</p> <i class='bx bx-x icon'></i>
                                <div class="form-control">
                                    <label for="from">From</label>
                                    <input type="text" id="to" name='date-start' placeholder="FROM">
                                </div>
                                <div class="form-control">
                                    <label for="to">To</label>
                                    <input type="text" id="to" name='date-end' placeholder="TO" >
                                </div>
                                <p>By Campus :</p>
                                <div class="checkbox-filter">
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="all">
                                        <label for="all">Select All</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="alangilan" name="select-campus[]" class='campus-bsu' value="Alangilan">
                                        <label for="alangilan">Alangilan</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="central" name="select-campus[]" class='campus-bsu' value="Central">
                                        <label for="central">Central</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="lipa" name="select-campus[]" class='campus-bsu' value="Lipa">
                                        <label for="lipa">Lipa</label> 
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="lobo" name="select-campus[]" class='campus-bsu' value="Lobo">
                                        <label for="lobo">Lobo</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="mabini" name="select-campus[]" class='campus-bsu' value="Mabini">
                                        <label for="mabini">Mabini</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="malvar" name="select-campus[]" class='campus-bsu' value="Malvar">
                                        <label for="malvar">Malvar</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="nasugbu" name="select-campus[]" class='campus-bsu' value="Nasugbu">
                                        <label for="nasugbu">Nasugbu</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="pb-main" name="select-campus[]" class='campus-bsu' value="Pablo Borbon">
                                        <label for="pb-main">Pablo Borbon</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="rosario" name="select-campus[]" class='campus-bsu' value="Rosario">
                                        <label for="rosario">Rosario</label>
                                    </div>
                                </div>
                                <input type="submit" value="Filter">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table">
                <?php
                    require_once "functionalities/articles-data.php";
                ?>
            </div>
            <div class="table-footer">
                <?php
                    require_once "functionalities/articles-pagination.php";
                ?>
            </div>
        </div>
    </section>

    <script src="ip-assets.js"></script>
</body>


