
<?php
session_start();
?>

<!-- css -->
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="../../../css/public-user/user-navbar.css">


<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<section>
    <div class="navbar-container">
        <div class="left">
            <div class="left-md-container">
                <div class="left-sm-container">
                    <div class="left-content">
                        <div class="logo">
                            <img src="../../../assets/images/batStateUNeu-logo.png" alt="">
                        </div>
                        <div class="header-title">
                            <h4>BatStateU</h4>
                            <p>The National Engineering University</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="right-md-container">
                <div class="right-sm-container">
                    <div class="right-content">
                        <ul class="nav-links">
                            <li><a href="../../../views/public-user/home/home.php">HOME</a></li>
                            <li><a href="#">PUBLICATIONS</a></li>
                            <li><a href="../../../views/public-user/articles/articles.php">ARTICLES</a></li>
                            <li><a href="#">ABOUT</a></li>
                        </ul>
                        <a class="signin-btn" href="<?=isset($_SESSION['user_email']) ? '../../../views/admin/account/functionalities/logout.php' :  '../../../views/admin/account/login.php'?>"><?=isset($_SESSION['user_email']) ? 'LOGOUT' : 'LOGIN'?></a>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTENT -->
<main id="main-content">



