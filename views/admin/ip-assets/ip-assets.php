<title>RMS | IP ASSETS</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./ip-assets.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"> <!--Font Awesome CDN-->

<body>
    <?php
        include '../../../includes/admin/templates/navbar.php';
        include_once 'functionalities/ipa_include/ipa_filter.php';
        include_once 'functionalities/ipa_include/ipa_year.php';
        include_once 'functionalities/ipa_include/ipa_count.php';

        $search = isset($_GET['search']) ? $_GET['search']: 'empty_search';
        $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';
        $class = isset($_GET['class']) ? $_GET['class']: 'empty_class';
        $year = isset($_GET['year']) ? $_GET['year']: 'empty_year';
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
                
                <div class="filter">
                    <button class="btn"><?php echo $type!="empty_type" ? $type: 'Type'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterIPA($search, 'Copyright', $class, $year);?>">Copyright</a></li>
                        <li><a href="<?php echo filterIPA($search, 'Original', $class, $year);?>">Original</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?php echo $class!="empty_class" ? 'Class '.$class: 'Class'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterIPA($search, $type, 'A', $year);?>">Class A</a></li>
                        <li><a href="<?php echo filterIPA($search, $type, 'O', $year);?>">Class O</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?php echo $year!="empty_year" ? $year: 'Year'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <?php include_once 'functionalities/ipa_include/ipa_year_filter.php' ?>
                    </ul>
                </div>
                <a href="./new-ip-asset.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New</a>
            </div>
        </div>
        <section>
            <div class="table-container">
                <?php
                    include_once 'functionalities/ipa_include/ipa_table.php';
                ?>
            </div>
        
                <?php
                    include_once 'functionalities/ipa_include/pagination.php';
                ?>
            
            </div>
            </section>
    </main>
    
        <!-- Modal Popup -->
     <div id="myModal" class="modal">
        <div class="modal-content1">
            <h3 style="float: left; position: relative; margin-top: -35px;">Download</h3>
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe src="functionalities/download/download_ip-assets.php"></iframe>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="./ip-assets.js"></script>
<script src="functionalities/download//download_button.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>