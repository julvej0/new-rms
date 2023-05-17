<title>RMS | Patented Articles</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./articles.css">

<div class="article-content">
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
                            <input type='text' id='search-table' name='search-table' placeholder='Search Article or Author' value="<?= isset($search) ? htmlentities($search) : '' ?>">
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
                    <div class="filter-button">
                        <button id="btn-filter">
                            <i class="fas fa-filter"></i>
                        </button>
                        <span>FILTER</span>
                        <form method="GET" action="">
                            <div class="filter-options">
                                <label>Date Published</label>
                                    <div class="nested-options">
                                        <label><input type="number" name='date-start' placeholder="FROM" > </label>
                                        <label><input type="number" name='date-end' placeholder="TO" > </label>
                                        <!-- Add more nested options as needed -->
                                    </div>
                                </label>
                                <label>
                                    <input type="checkbox"  name="select-campus[]" id='select-campus' value="All Campus"> Campus
                                        <div class="nested-options">
                                            <label><input type="checkbox" name="select-campus[]" id='alangilan'class='campus-bsu'value="Alangilan"> Alangilan </label>
                                            <label><input type="checkbox" name="select-campus[]" id='balayan' class='campus-bsu'value="Balayan"> Balayan </label>
                                            <label><input type="checkbox" name="select-campus[]" id='lemery'  class='campus-bsu'value="Lemery"> Lemery </label>
                                            <label><input type="checkbox" name="select-campus[]" id='lipa'    class='campus-bsu' value="Lipa"> Lipa</label>
                                            <label><input type="checkbox" name="select-campus[]" id='lobo'    class='campus-bsu'value="Lobo"> Lobo</label>
                                            <label><input type="checkbox" name="select-campus[]" id='malvar'  class='campus-bsu'value="Malvar"> Malvar</label>
                                            <label><input type="checkbox" name="select-campus[]" id='mabini'  class='campus-bsu' value="Mabini"> Mabini</label>
                                            <label><input type="checkbox" name="select-campus[]" id='nasugbu' class='campus-bsu'value="Nasugbu"> Nasugbu</label>
                                            <label><input type="checkbox" name="select-campus[]" id='sanjuan' class='campus-bsu'value="San Juan"> San Juan</label>
                                            <!-- Add more nested options as needed -->
                                        </div>
                                </label>
                                <input type="submit" id='filter-btn' value="FILTER">
                            </div>
                        </form>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
    const filterButton = document.getElementById('btn-filter');
    const filterOptions = document.querySelector('.filter-options');

    filterButton.addEventListener('click', function() {
        filterOptions.style.display = filterOptions.style.display === 'none' ? 'block' : 'none';
    });


    let checkAll = document.querySelector('input[id=select-campus]');
    let campuses = document.querySelectorAll('input[class=campus-bsu]');

    checkAll.addEventListener('change', function() {
        if (this.checked) {
            campuses.forEach(function(checkbox){
                checkbox.checked = true;
            });
        } else{
            campuses.forEach(function(checkbox){
                checkbox.checked = false;
            });
        }
    });
    
    



</script>
</body>
<?php 
    include '../../../includes/admin/templates/footer.php';
?>