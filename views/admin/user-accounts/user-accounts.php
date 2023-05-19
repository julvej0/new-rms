<title>RMS | AUTHORS</title>
<?php 
    #hello
    include_once '../../../db/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="user-accounts.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<body>
    <?php
        include_once '../../../includes/admin/templates/navbar.php';
        include_once 'functionalities/userAccounts_include/userAccounts_count.php';
        include_once 'functionalities/userAccounts_include/userAccounts_filter.php';

        $search = isset($_GET['search']) ? $_GET['search']: 'empty_search';
        $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';

        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
       
    ?>
    
    <main>
        <div class="header">
            <h1 class="title">User Accounts</h1>
            <div class='left'>
                <form action="">
                    <div class="form-group">
                        <input class='txt-search' type='text' placeholder="Search..." name='search' value='<?php $search_query?>' >
                        <i class='bx bx-search icon' ></i>
                    </div>
                </form>
                <div class="filter">
                    <button class="btn"><?=$type!="empty_type" ? $type: 'Type'  ?><i class='bx bx-chevron-down icon'></i></button>
                    <ul class="filter-link">
                        <li><a href="<?=filterUserAccounts($search, 'empty_type')?>">All</a></li>
                        <li><a href="<?=filterUserAccounts($search, "Regular")?>">Regular</a></li>
                        <li><a href="<?=filterUserAccounts($search, "Author")?>">Author</a></li>
                        <li><a href="<?=filterUserAccounts($search, "Admin")?>">Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table id="author_table">
                    <thead>
                        <tr>
                            <th>SR-Code</th>
                            <th>Profile Image</th>
                            <th>Full Name</th>
                            <th>Account Type</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once 'functionalities/userAccounts_include/userAccounts_display.php';
                           
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                    include_once 'functionalities/userAccounts_include/pagination_authors.php';
                ?>
        </section>
    </main>
</section>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<script src="./user-accounts.js"></script>
</body>
<?php
    include '../../../includes/admin/templates/footer.php';
?>