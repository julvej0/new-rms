<title>RMS | Patented Articles</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./ipa.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<body>
    <section id="main-content">
        <div class="page-title">
            <h3 class="animate__animated animate__zoomIn">IP ASSETS</h3>
        </div>
        <div class="table-container animate__animated animate__fadeInUp" id="tbl-container">
            <div class="header">
                <div class="left">
                    <h4>DOCUMENTS</h4>
                </div>
                <div class="right">
                    <form method="GET" action="">
                        <div class="form-control">
                            <input type='text' name='search-table' placeholder='Search Article or Author' value="<?= isset($search) ? htmlentities($search) : '' ?>">
                            <i class='bx bx-search icon' ></i>
                        </div>
                    </form>
                    <div class="sort-btn">
                        <button id="btn-sort"><i class='bx bx-sort icon' ></i>Sort</button>
                        <ul class="sort-links">
                            <li><a href="?sort=title">by Title</a></li>
                            <li><a href="?sort=date">by Date</a></li>
                            <li><a href="?sort=campus">by Campus</a></li>
                        </ul>
                    </div>
                    <div class="filter-btn">
                        <button id="btn-filter"><i class='bx bx-filter icon' ></i>Filter</button>
                        <div class="filter-options">
                            <form method="GET" action="">
                                <p>By Date :</p> <i class='bx bx-x icon'></i>
                                <div class="form-control">
                                    <label for="from">From</label>
                                    <input type="text" id="to" name='date-start' placeholder="FROM">
                                </div>
                                <div class="form-control">
                                    <label for="to">To</label>
                                    <input type="text" id="to" name='date-end' placeholder="TO">
                                </div>
                                <p>By Campus :</p>
                                <div class="checkbox-filter">
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="all" name="select-campus[]" value="Select All">
                                        <label for="all">Select All</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="alangilan" name="select-campus[]" value="Alangilan">
                                        <label for="alangilan">Alangilan</label>
                                    </div>
                                    <div class="checkbox-control" name="select-campus[]" value="Lipa">
                                        <input type="checkbox" id="lipa">
                                        <label for="lipa">Lipa</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="pb-main" name="select-campus[]" value="Pablo Borbon">
                                        <label for="pb-main">Pablo Borbon</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="rosario" name="select-campus[]" value="Rosario">
                                        <label for="rosario">Rosario</label>
                                    </div>
                                </div>
                                <input type="submit" value="Filter">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tableContainer" class="table">
                <?php include_once  "functionalities/articles-data.php";?>   
            </div>

        <div class="table-footer">
            <div class="total-articles">
                <p>Patent Document Count : </p>
            </div>
            <div class="pagination">
                <li><a href="#"><i class='bx bx-chevrons-left icon' ></i></a></li>
                <li><a href="#"><i class='bx bx-chevron-left icon' ></i></a></li>
                <li><span class="current-page">1</span></li>
                <li><a href="#"><i class='bx bx-chevron-right icon' ></i></a></li>
                <li><a href="#"><i class='bx bx-chevrons-right icon' ></i></a></li>
            </div>        
        </div>
        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ipa.js"></script>



<?php 
    include '../../../includes/admin/templates/footer.php';
?>