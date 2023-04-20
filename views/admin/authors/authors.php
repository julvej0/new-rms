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
            <button class="addBtn">New Article</button>
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
                            <th>Actions</th>
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
</body>
<?php
    include '../../../includes/admin/templates/footer.php';
?>