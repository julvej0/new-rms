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

        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;

    ?>

    <main>
        <div class="header">
            <h1 class="title">IP-assets</h1>
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

<script>
           // Floating action rotate
           let isRotated = false;
            const checkboxContainer = document.getElementById("checkbox-container");

            function rotateButton() {
                const buttonIcon = document.getElementById("button-icon");
                if (isRotated) {
                    buttonIcon.style.transform = "rotate(0deg)";
                    checkboxContainer.style.transition = "margin-top 0.3s ease-out, opacity 0.4s ease-in-out";
                    checkboxContainer.style.opacity = 0;
                    setTimeout(() => {
                        checkboxContainer.style.marginTop = "0rem";
                    
                    setTimeout(() => {
                        checkboxContainer.style.display = "none";
                    }, 100); // wait for opacity transition to complete before hiding container
                    }, 150); // wait for margin-top transition to complete before setting opacity to 0
                    isRotated = false;
                } else {
                    buttonIcon.style.transform = "rotate(135deg)";
                    checkboxContainer.style.transition = "margin-top 0.3s ease-in-out, opacity 0.4s ease-in-out";
                    checkboxContainer.style.display = "block";
                    setTimeout(() => {
                    checkboxContainer.style.opacity = 1;
                    checkboxContainer.style.marginTop = "0.5rem";
                    }, 10); // wait for margin-top transition to complete before setting opacity to 1
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