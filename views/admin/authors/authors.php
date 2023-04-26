<title>RMS | AUTHORS</title>
<?php 
    include_once '../../../db/db.php';
?>
    <link rel="stylesheet" href="../../../css/index.css">
    <link rel="stylesheet" href="authors.css">
<body>
    <?php
        include_once '../../../includes/admin/templates/navbar.php';
        include_once 'functionalities/php/count_authors.php';
    ?>

    <main>
        <div class="header">
            <h1 class="title">Authors</h1>
            <div class="left">
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
                            <th class="stickey-col-header" style="background-color: var(--grey);">Actions</th>
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
    include '../../../includes/admin/templates/footer.php';
?>