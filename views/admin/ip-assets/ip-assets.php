<title>RMS | PATENT DOCUMENTS</title>
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

        $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
        $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';
        $class = isset($_GET['class']) ? $_GET['class']: 'empty_class';
        $year = isset($_GET['year']) ? $_GET['year']: 'empty_year';

        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;

    ?>

    <main>
        <div class="header">
            <h1 class="title">PATENT DOCUMENTS</h1>
            <div class="left">
                <div class="btn-container">
                <button class="select-columns-btn" onclick="rotateButton()" id="button-icon"><i class="fa-solid fa-plus fa-2xs"></i></button>  
                    <div class="checkbox-container" id="checkbox-container">
                        <input type="checkbox" name="col-registration" id="col-registration" checked>
                        <label class="checkbox-button" for="col-registration">Registration Number</label><br>
                        <input type="checkbox" name="col-title" id="col-title" checked >
                        <label class="checkbox-button" for="col-title">Title</label><br>
                        <input type="checkbox" name="col-type" id="col-type">
                        <label class="checkbox-button" for="col-type">Type</label><br>
                        <input type="checkbox" name="col-cow" id="col-cow" >
                        <label class="checkbox-button" for="col-cow">Class of Work</label><br>
                        <input type="checkbox" name="col-date-cre" id="col-date-cre" checked >
                        <label class="checkbox-button" for="col-date-cre">Date of Creation</label><br>
                        <input type="checkbox" name="col-date-reg" id="col-date-reg" checked >
                        <label class="checkbox-button" for="col-date-reg">Date Registered</label><br>
                        <input type="checkbox" name="col-campus" id="col-campus" checked >
                        <label class="checkbox-button" for="col-campus">Campus</label><br>
                        <input type="checkbox" name="col-college" id="col-college" >
                        <label class="checkbox-button" for="col-college">College</label><br>
                        <input type="checkbox" name="col-program" id="col-program" >
                        <label class="checkbox-button" for="col-program">Program</label><br>
                        <input type="checkbox" name="col-authors" id="col-authors" checked >
                        <label class="checkbox-button" for="col-authors">Authors</label>
                        <input type="checkbox" name="col-status" id="col-status" checked >
                        <label class="checkbox-button" for="col-status">Status</label>
                    </div>
                </div>
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php echo isset($_GET['search']) ? $_GET['search']: ''?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                
                <div class="filter">
                    <button class="btn"><?=$type!="empty_type" ? $type: 'Type'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterIPA($search, 'Copyright', $class, $year);?>">Copyright</a></li>
                        <li><a href="<?=filterIPA($search, 'Original', $class, $year);?>">Original</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$class!="empty_class" ? 'Class '.$class: 'Class'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterIPA($search, $type, 'A', $year);?>">Class A</a></li>
                        <li><a href="<?=filterIPA($search, $type, 'O', $year);?>">Class O</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$year!="empty_year" ? $year: 'Year'  ?><i class='bx bx-chevron-down icon'></i></button>
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
<?php //SweetAlert2 mixin alerts
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
            title: "Patented Document was deleted succesfully!"
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
            title: "Patented Document was updated succesfully!"
          })
    
        </script>
        
        ';
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
                title: "Failed to update Patented Document!"
              })
        
            </script>
            
            ';
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
            title: "Patented Document was uploaded succesfully!"
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
                title: "Failed to upload Patented Document!"
            })
    
        </script>
        
        ';
        }
    }
?>