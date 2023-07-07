<title>RMS | ACCOUNTS</title>
<?php 
    include dirname(__FILE__, 4) . '/helpers/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="user-accounts.css">
<body>
    <?php
        include dirname(__FILE__, 4) . '/components/navbar/navbar.php'; 
        include_once 'functionalities/userAccounts_include/userAccounts_count.php';
        include_once 'functionalities/userAccounts_include/userAccounts_filter.php';

        $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
        $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';

        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
       
    ?>
 <section id='appbar-and-content'>
    <?php include_once  dirname(__FILE__, 4) . '/components/navbar/admin-navbar.php'; ?>    
    <main>
        <div class="header">
            <h1 class="title">User Accounts</h1>
            <div class='left'>
                <form action="">
                    <div class="form-group">
                        <input class='txt-search' type='text' placeholder="Search..." name='search' value='<?php echo isset($_GET['search']) ? $_GET['search']: ''?>' >
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
                    include_once 'functionalities/userAccounts_include/userAccounts_pagination.php';
                ?>
        </section>
    </main>
</section>

<script src="./user-accounts.js"></script>
</body>
<?php
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>