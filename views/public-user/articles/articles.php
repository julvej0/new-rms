<title>RMS | Patented Articles</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./articles.css">


<!-- Table Cotainer -->

<div class='table-container'>

    <!-- Start of Table -->

    <div class='main-table'>

        <!-- Table Header -->
        <div>
            <div class='table-header-container'>
                <div class='table-header'>
                    <p>LIST OF ARTICLES</p>
                </div>
                <form method="GET" action="">
                    <div class='table-search'>
                        <input type='text' id='search-table' name='search-table' placeholder='Search Article' value="<?= isset($search) ? htmlentities($search) : '' ?>">
                    </div>
                    <div class='search-button'>
                        <button id='btn-search' type='submit'>
                            <img src='https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/search-512.png' alt='Search'>
                        </button>
                    </div>
                </form>
                
                <div class='sort-button'>
                    <button id='btn-sort'>
                        <i class="fas fa-sort-amount-up"></i>
                    </button>
                    <span>SORT</span>
                </div>
                <div class='filter-button'>
                    <button id='btn-filter'>
                        <i class="fas fa-filter"></i>
                    </button>
                    <span>FILTER</span>
                </div>
            </div>
        </div>
        
    </div>
    <section>
        <!-- Content of the Table-->
        <div id='table-data'>
            <?php
                include_once "functionalities/articles-data.php";
            ?>   
        </div>
    </section>
    
</div>





<?php 
    include '../../../includes/admin/templates/footer.php';
?>