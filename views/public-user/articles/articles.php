<title>RMS | Patented Articles</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./articles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<body>
    <section id="main-content">
        <div class="page-title">
            <h3 class="animate__animated animate__zoomIn">PUBLICATIONS</h3>
        </div>
        <div class="table-container animate__animated animate__fadeInUp" id="tbl-container">
            <div class="header">
                <div class="left">
                    <h4>DOCUMENTS</h4>
                </div>
                <div class="right">
                    <form>
                        <div class="form-control" method="GET" action="">
                            <input type='text'name='search-table' placeholder='Search Article or Author' value="<?= isset($search) ? htmlentities($search) : '' ?>">
                            <i class='bx bx-search icon' ></i>
                        </div>
                    </form>
                    <div class="sort-btn">
                        <button id="btn-sort"><i class='bx bx-sort icon' ></i>Sort</button>
                        <ul class="sort-links">
                            <li><a href="#">by Title</a></li>
                            <li><a href="#">by Date</a></li>
                            <li><a href="#">by Campus</a></li>
                        </ul>
                    </div>
                    <div class="filter-btn">
                        <button id="btn-filter"><i class='bx bx-filter icon' ></i>Filter</button>
                        <div class="filter-options">
                            <form action="">
                                <p>By Date :</p> <i class='bx bx-x icon'></i>
                                <div class="form-control">
                                    <label for="from">From</label>
                                    <input type="text" id="to">
                                </div>
                                <div class="form-control">
                                    <label for="to">To</label>
                                    <input type="text" id="to">
                                </div>
                                <p>By Campus :</p>
                                <div class="checkbox-filter">
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="all">
                                        <label for="all">Select All</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="alangilan">
                                        <label for="alangilan">Alangilan</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="lipa">
                                        <label for="lipa">Lipa</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="pb-main">
                                        <label for="pb-main">Pablo Borbon</label>
                                    </div>
                                    <div class="checkbox-control">
                                        <input type="checkbox" id="rosario">
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
                <!-- <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date Published</th>
                            <th>Campus</th>
                            <th>Authors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dasd</td>
                            <td>dasd</td>
                            <td>dasd</td>
                            <td>dasd</td>
                        </tr>
                    </tbody>
                </table> -->

                <?php
                    require_once "functionalities/articles-data.php";
                ?>
            </div>
        <div class="table-footer">
                    
        </div>
        </div>
    </section>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./articles.js"></script>
<?php 
    include '../../../includes/admin/templates/footer.php';
?>