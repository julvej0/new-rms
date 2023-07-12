<title>RMS | ACCOUNTS</title>
<?php 
    include dirname(__FILE__, 4) . '/helpers/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="logs.css">
<body>
    <?php
        include dirname(__FILE__, 4) . '/components/navbar/navbar.php'; 
        include_once 'functionalities/logs_include/logs_count.php';
        include_once 'functionalities/logs_include/logs_filter.php';

        $search = (isset($_GET['search']) && strpos($_GET['search'], "'") === false )? $_GET['search']: 'empty_search';
        $type = isset($_GET['type']) ? $_GET['type']: 'empty_type';

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
            <h1 class="title">Admin Logs</h1>
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
                        <li><a href="<?=filterlogs($search, 'empty_type')?>">All</a></li>
                        <li><a href="<?=filterlogs($search, "post")?>">Post</a></li>
                        <li><a href="<?=filterlogs($search, "update")?>">Update</a></li>
                        <li><a href="<?=filterlogs($search, "delete")?>">Delete</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <section>
            <div class="table-container">
                <table id="author_table">
                    <thead>
                        <tr>
                            <th>Date and Time</th>
                            <th>SR-Code</th>
                            <th>Full Name</th>
                            <th>Activity</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once 'functionalities/logs_include/logs_display.php';
                           
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                    include_once 'functionalities/logs_include/logs_pagination.php';
                ?>
        </section>
    </main>
</section>

<script src="./logs.js"></script>
</body>
<?php
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>