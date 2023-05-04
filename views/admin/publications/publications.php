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
?>
    <main>
        <div class="header">
            <h1 class="title">Publications</h1>
            <div class='left'>
                <!-- <div class="btn-container">
                    <button class="select-columns-btn" onclick="rotateButton()" id="button-icon">+</button>   
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
                </div> -->
                <form action='' method='get'>
                    <div class="form-group">
                        <input type='text' placeholder="Search" name='search' value='<?php $search_query?>' placeholder="Search..." >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn">Type<i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="#">Original</a></li>
                        <li><a href="#">Review</a></li>
                        <li><a href="#">Proceedings</a></li>
                        <li><a href="#">Communication</a></li>
                        <li><a href="#">International</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn">Fund<i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="#">Funded</a></li>
                        <li><a href="#">Non-funded</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn">Year<i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="#">2015</a></li>
                        <li><a href="#">2016</a></li>
                        <li><a href="#">2017</a></li>
                        <li><a href="#">2018</a></li>
                        <li><a href="#">2019</a></li>
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

            <div class="table-footer">
                <?php
                    include_once 'functionalities/publications_include/publication_count.php';
                ?>

                <p><?=countPublications($conn, $additionalQuery)?></p>

                <div class="pagination">
                    <?php
                        include_once 'functionalities/publications_include/pagination.php';
                    ?>
                </div>

            </div>
        </section>
    </main>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="publications.js"></script>
<script>
           // Floating action rotate
           let isRotated = false;
            const checkboxContainer = document.getElementById("checkbox-container");

            function rotateButton() {
                const buttonIcon = document.getElementById("button-icon");
                if (isRotated) {
                    buttonIcon.style.transform = "rotate(0deg)";
                    checkboxContainer.style.opacity = 0;
                    setTimeout(() => {
                        checkboxContainer.style.display = "none";
                    }, 300); // wait for transition to complete before hiding container
                    isRotated = false;
                } else {
                    buttonIcon.style.transform = "rotate(135deg)";
                    checkboxContainer.style.display = "block";
                    setTimeout(() => {
                        checkboxContainer.style.opacity = 1;
                    }, 0); // wait for display to update before starting transition
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