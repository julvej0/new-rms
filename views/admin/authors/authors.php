<title>RMS | AUTHORS</title>
<?php 
    #hello
    include_once '../../../db/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="authors.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
    <?php
        include_once '../../../includes/admin/templates/navbar.php';
        include_once 'functionalities/php/count_authors.php';

        //for filtering
       if (isset($_GET['gender'])){

       }
    ?>
    
    <main>
        <div class="header">
            <h1 class="title">Authors</h1>

            
            <div class='left'>
                <!-- <div class="btn-container">
                    <button class="select-filter-btn" onclick="rotateButton()" id="button-icon">+</button>   
                    <div class="rdb-container" id="rdb-container">
                        Gender:<br>
                        <a href="<?php //isset($_GET['gender']).'gender=male'?>">Male</a><br>
                        <a href="<?php //echo $currentUrl.'gender=female'?>">Female</a><br>
                
                        Role:<br>
                        <input type="radio" name="fil-role" id="fil-faculty" checked>
                        <label class="rbd-button" for="fil-faculty">Faculty</label><br>
                        <input type="radio" name="fil-role" id="fil-student" checked>
                        <label class="rbd-button" for="fil-student">Faculty</label><br>             
                    </div>
                </div> -->
                <form action="#">
                    <div class="form-group">
                        <input class='txt-search' type='text' placeholder="Search..." name='search' value='<?php $search_query?>' >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <a href="./new-author.php" class="addBtn"><i class='bx bxs-file-plus icon' ></i>New Author</a>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Author Name</th>
                            <th>Type</th>
                            <th>Gender</th>
                            <th>Affiliations</th>
                            <th class="stickey-col-header" style="background-color: var(--grey); width: 10px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once 'functionalities/php/display_authors.php';
                           
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                    include_once 'functionalities/php/pagination_authors.php';
                ?>
        </section>
    </main>
</section>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<script src="./authors.js"></script>
</body>
<?php
    include_once 'functionalities/php/delete_success.php';
    include '../../../includes/admin/templates/footer.php';
?>