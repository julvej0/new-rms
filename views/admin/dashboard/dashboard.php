<title>RMS | DASHBOARD</title>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="dashboard.css">
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="../../../js/apexchartsV3.28.2.min.js"></script>
<!-- CDN -->

<?php
    include dirname(__FILE__, 4) . "/components/header/header.php";
    require_once  dirname(__FILE__, 4) . "/helpers/db.php";
    include './functionalities/dashboard-function.php'; 
    include dirname(__FILE__, 4) . '/components/navbar/navbar.php';
?>



<?php
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>