<?php
include_once "../../../includes/public-user/templates/user-navbar.php";
include_once '../../../includes/admin/templates/header.php';
include_once "functionalities/user-session.php";
?>
<link rel="stylesheet" href="../../../css/index.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="author-profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id='whole-page'>


<!-- profile page -->
    <div id="author-page">
        <?php
            include_once "functionalities/author-data.php";
        ?>
        
    </div>
</div>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='show-hide-password.js'></script>
<script src='edit-info.js'></script>

