<title>RMS | AUTHORS</title>
<?php 
    #hello
    include_once '../../../db/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="authors.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<body>
    <?php
        include_once '../../../includes/admin/templates/navbar.php';
        include_once 'functionalities/authors_include/count_authors.php';
        include_once 'functionalities/authors_include/filter_function.php';

        $search = isset($_GET['search']) ? $_GET['search']: 'empty_search';
        $gender = isset($_GET['gender']) ? $_GET['gender']: 'empty_gender';
        $role = isset($_GET['role']) ? $_GET['role']: 'empty_role';
       
    ?>
    
    <main>
        <div class="header">
            <h1 class="title">Authors</h1>
            <div class='left'>
                <form action="#">
                    <div class="form-group">
                        <input class='txt-search' type='text' placeholder="Search..." name='search' value='<?php $search_query?>' >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn">Role<i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterAuthor($search, 'Student', $gender)?>">Student</a></li>
                        <li><a href="<?php echo filterAuthor($search, 'Faculty', $gender)?>">Faculty</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn">Gender<i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterAuthor($search, $role, 'Male')?>">Male</a></li>
                        <li><a href="<?php echo filterAuthor($search, $role, 'Female')?>">Female</a></li>
                    </ul>
                </div>
                <a href="./new-author.php" class="addBtn"><i class='bx bx-user-plus icon'></i></i>New</a>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table id="author_table">
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
                            include_once 'functionalities/authors_include/display_authors.php';
                           
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                    include_once 'functionalities/authors_include/pagination_authors.php';
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
    include_once 'functionalities/authors_include/pop_modal.php';
    include '../../../includes/admin/templates/footer.php';
?>