<title>RMS | AUTHORS</title>
<?php 
    include dirname(__FILE__, 4) . '/helpers/db.php'; //db connection
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="authors.css">
<body>
    <?php
        include dirname(__FILE__, 4) . '/components/navbar/navbar.php'; //navigation bar
        include_once 'functionalities/authors_include/count_authors.php'; //for counting total author
        include_once 'functionalities/authors_include/filter_function.php'; // for filtering

        //check for GET parameters
        $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
        
         
        $gender = isset($_GET['gender']) ? $_GET['gender']: 'empty_gender';
        $role = isset($_GET['role']) ? $_GET['role']: 'empty_role';

        //check if page number exists
        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
       
    ?>
    <div id="loading-screen">
        <div class="loading-img">
            <img src="../../../assets/images/redspartan_logo.png" alt="redSpartan">
        </div>
    </div>
<section id='appbar-and-content'>
    <?php include_once  dirname(__FILE__, 4) . '/components/navbar/admin-navbar.php'; ?> 
    <main>
        <div class="header">
            <h1 class="title">Authors</h1>
            <div class='left'>
                <form action="#">
                    <div class="form-group">
                        <input class='txt-search' type='text' placeholder="Search..." name='search' value='<?php echo isset($_GET['search']) ? $_GET['search']: ''?>' >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn"><?=$role!="empty_role" ? $role: 'Role'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterAuthor($search, 'empty_role', $gender)?>">All</a></li>
                        <li><a href="<?php echo filterAuthor($search, 'Student', $gender)?>">Student</a></li>
                        <li><a href="<?php echo filterAuthor($search, 'Faculty', $gender)?>">Faculty</a></li>
                    </ul>
                </div>
                <div class="filter">
                    <button class="btn"><?=$gender!="empty_gender" ? $gender: 'Gender'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?php echo filterAuthor($search, $role, 'empty_gender')?>">All</a></li>
                        <li><a href="<?php echo filterAuthor($search, $role, 'Male')?>">Male</a></li>
                        <li><a href="<?php echo filterAuthor($search, $role, 'Female')?>">Female</a></li>
                    </ul>
                </div>
                <a href="./new/new-author.php" class="addBtn"><i class='bx bx-user-plus icon'></i></i>New</a>
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
                            include_once 'functionalities/authors_include/display_authors.php'; //diplay table for authors
                           
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                    include_once 'functionalities/authors_include/pagination_authors.php'; // display pagination controls for authors
                ?>
        </section>
    </main>
</section>

<script src="./authors.js"></script>
</body>
<?php
    include_once 'functionalities/authors_include/pop_modal.php';
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>