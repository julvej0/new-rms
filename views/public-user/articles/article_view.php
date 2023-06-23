<link rel="stylesheet" href="../../../views/public-user/articles/article-view.css">
<link rel="stylesheet" href="../../../css/animatev4.1.1.min.css"/>
<?php 
    include dirname(__FILE__, 4) . '/components/header/header.php';
    include dirname(__FILE__, 4) . '/components/public-user/templates/user-navbar.php';
    include dirname(__FILE__, 4) . '/helpers/db.php';
    include_once "functionalities/articles-functions.php";
?>

<body>
    <section id="main-content">
        <div class="page-title">
            <h3 class="animate__animated animate__fadeIn">PUBLICATIONS</h3>
        </div>
        <div class="content-container animate__animated animate__fadeIn">
            <?php
                if (isset($_GET['pubID']) && !empty($_GET['pubID'])) {
                    $row = getPublicationData($_GET['pubID'], $conn);
                    if ($row) {
                        displayPublicationData($row, $conn);
                    }
                }
            ?>
        </div>
    </section>   
</body>
