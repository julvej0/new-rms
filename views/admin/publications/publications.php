<title>RMS | PUBLICATIONS</title>
<?php 
    include dirname(__FILE__, 4) . '/components/header/header.php';
    include dirname(__FILE__, 4) . '/helpers/db.php';
    include dirname(__FILE__, 4) . '/components/navbar/navbar.php';
?>

<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./publications.css">

<body>
<?php
    include_once 'functionalities/publications_include/publication_filter_extract.php';
    include_once 'functionalities/publications_include/publication_filter_display.php';
    include_once 'functionalities/publications_include/publication_filter.php';
   
    $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
    $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';
    $fund = isset($_GET['fund']) ? $_GET['fund']: 'empty_fund';
    $year = isset($_GET['year']) ? $_GET['year']: 'empty_year';

    $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>
<section id='appbar-and-content'>
    <?php include_once  dirname(__FILE__, 4) . '/components/navbar/admin-navbar.php'; ?> 
    <main>
        <div class="header">
            <h1 class="title">Publications</h1>
            <div class='left'>
                <div class="btn-container">
                    <button class="select-columns-btn" onclick="rotateButton()" id="button-icon" title="Edit Table Column"  ><i class="fa-solid fa-caret-down"></i></button>   
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
                        <input type='text' name='search' value='<?php echo isset($_GET['search']) ? $_GET['search']: ''?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn"><?=$type!="empty_type" ? $type: 'Type'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <?php
                            displayTypeFilter($conn, $search, $fund, $year);
                        ?>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$fund!="empty_fund" ? $fund: 'Fund'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterPublication($search, $type, 'funded', $year)?>">Funded</a></li>
                        <li><a href="<?=filterPublication($search, $type, 'non-funded', $year)?>">Non-funded</a></li>
                    </ul>
                </div>
                <!-- <div class="filter_dd">
                    <button class="dropbtn">Dropdown</button>
                    <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                    </div>
                </div> -->
                <div class="filter">
                    <button class="btn"><?=$year!="empty_year" ? $year: 'Year'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <?php
                            
                            displayYearFilter($conn, $search, $type, $fund);
                        ?>
                       
                    </ul>
                </div>
                <a href="./new/new-publication.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New</a>
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
     
    <!-- Modal Popup -->
     <div id="myModalpub" class="modal">
        <div class="modal-content1">
            <h3 style="float: left; position: relative; margin-top: -35px;">Download</h3>
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe src="../publications/functionalities/download/download_pub.php"></iframe>
        </div>
    </div>

</section>
<script src="publications.js"></script>
<script src="./functionalities/download/download_pub.js"></script>
</body>

<?php
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>
<?php
    //SweetAlert2 mixin alerts
    if(isset($_GET['delete'])){
        echo
        '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "success",
            title: "Publication was deleted successfully!"
          })
    
        </script>
        ';
    }

    if(isset($_GET['update'])){
        $updateStatus = $_GET['update'];
        if ($updateStatus == 'success') {
        echo
        '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "success",
            title: "Publication was updated succesfully!"
          })
    
        </script>';
        }elseif ($updateStatus == 'failed') {
            echo
            '
            <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                }
              })
              
              Toast.fire({
                icon: "error",
                title: "Failed to update Publication!"
              })
        
            </script>';
        }
    }
    if (isset($_GET['upload'])){
        $uploadStatus = $_GET['upload'];
        if ($uploadStatus == 'success') {
        echo
        '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
          })
          
          Toast.fire({
            icon: "success",
            title: "Publication was uploaded succesfully!"
          })
    
        </script>
        
        ';
        }elseif ($uploadStatus == 'failed'){
        echo
        '
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            }
            })
            
            Toast.fire({
                icon: "error",
                title: "Failed to upload Publication!"
            })
    
        </script>
        
        ';
        }
    }
?>