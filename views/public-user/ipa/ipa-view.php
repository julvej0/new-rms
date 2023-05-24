<link rel="stylesheet" href="../../../views/public-user/ipa/ipa-view.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../includes/public-user/templates/user-navbar.php'; 
    include '../../../db/db.php';
    include_once "functionalities/articles-functions.php";
?>

<body>
    <section id="main-content">
        <div class="page-title">
            <h3 class="animate__animated animate__fadeIn">IP ASSETS</h3>
        </div>
        <div class="content-container animate__animated animate__fadeIn">
            <?php
                if (isset($_GET['ipID']) && !empty($_GET['ipID'])) {
                    $row = getPublicationData($_GET['ipID'], $conn);
                    if ($row) {
                        displayPublicationData($row, $conn);
                    }
                }
            ?>
        </div>
    </section>   
</body>
