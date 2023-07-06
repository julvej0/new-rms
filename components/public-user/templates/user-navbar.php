<?php
session_start();
?>

<!-- css -->
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href= "components/public-user/css/user-navbar.css">

<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="sweetalert2.min.css">
<!-- TODO: learn how to make link href target absolute paths without actually hardcoding the url -->
<body>
<section>    
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <div class="navbar-container">
        <div class="left">
            <div class="left-md-container">
                <div class="left-sm-container">
                    <div class="left-content">
                        <div class="logo">
                            <img src="assets/images/batStateUNeu-logo.png" alt="">
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
                            <?php if( isset($_SESSION['account_type']) ): ?>
                                <?php if ($_SESSION['account_type'] == "Admin"): ?>
                                    <li><a href="views/admin/home/home.php" id='home-link' onclick="showLoadingScreen()">HOME</a></li>
                                    <li><a href="views/admin/ip-assets/ip-assets.php" id='ip-assets-link' onclick="showLoadingScreen()">IP ASSETS</a></li>
                                    <li><a href="views/admin/articles/articles.php" id='pb-link' onclick="showLoadingScreen()">PUBLICATIONS</a></li>
                                    <li><a href="views/admin/about/about.php" id='abt-link' onclick="showLoadingScreen()">ABOUT</a></li>
                                <?php else: ?>
                                    <li><a href="views/public-user/home/home.php" id='home-link' onclick="showLoadingScreen()">HOME</a></li>
                                    <li><a href="views/public-user/ip-assets/ip-assets.php" id='ip-assets-link' onclick="showLoadingScreen()">IP ASSETS</a></li>
                                    <li><a href="views/public-user/articles/articles.php" id='pb-link'onclick="showLoadingScreen()">PUBLICATIONS</a></li>
                                    <li><a href="views/public-user/about/about.php" id='abt-link' onclick="showLoadingScreen()">ABOUT</a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li><a href="views/public-user/home/home.php" id='home-link' onclick="showLoadingScreen()">HOME</a></li>
                                <li><a href="views/public-user/ip-assets/ip-assets.php" id='ip-assets-link' onclick="showLoadingScreen()">IP ASSETS</a></li>
                                <li><a href="views/public-user/articles/articles.php" id='pb-link' onclick="showLoadingScreen()">PUBLICATIONS</a></li>
                                <li><a href="views/public-user/about/about.php" id='abt-link' onclick="showLoadingScreen()">ABOUT</a></li>
                            <?php endif; ?>
                            
                            <a class="signin-btn" href="<?=isset($_SESSION['user_email']) ? 'views/logout/logout.php?logout=1' :  'views/login/login.php'?>" onclick="<?=isset($_SESSION['user_email']) ? 'return showLogoutAlert()' : ''?>">
                                <?=isset($_SESSION['user_email']) ? 'LOGOUT' : 'LOGIN'?>
                            </a>
                        </ul>
                        <?php
                            $sessionActive = isset($_SESSION['user_email']);
                            $accountType = isset($_SESSION['account_type']) ? $_SESSION['account_type'] : '';

                            // Check if the user is an author
                            $isAuthor = $accountType == 'Author';
                        ?>

                        <div class="dropdown-container <?= $sessionActive ? 'show' : '' ?>" >
                            <?php if ($sessionActive): ?>
                                <i class="fas fa-cog" onclick="toggleDropdown()"></i>
                                <div class="dropdown" id="dropdown">
                                    <a style='margin-right: 30px;' href="views/public-user/profile/user-profile.php">
                                        <i class="fas fa-user"></i> PROFILE
                                    </a>
                                    <?php if ($isAuthor): ?>
                                        <a style='margin-right: 30px;' href="views/public-user/author-info/author-profile.php">
                                            <i class="fas fa-info-circle"></i> AUTHOR INFORMATION
                                        </a>
                                    <?php endif; ?>
                                    <a href="views/public-user/profile/change-password.php">
                                        <i class="fas fa-lock"></i> CHANGE PASSWORD
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SCRIPT -->
<script src="components/public-user/js/user-navbar.js"></script>
<script src="components/public-user/js/profile-dropdown.js"></script>
<script>
    function showLogoutAlert() {
        Swal.fire({
            icon: 'question',
            title: 'Logout Confirmation',
            text: 'Are you sure you want to logout?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the logout page
                window.location.href = 'views/logout/logout.php?logout=1';
            }
        });

        return false; // Prevent the default behavior of the anchor tag
    }
    
    function showLoadingScreen() {
        document.getElementById('loadingOverlay').style.visibility = 'visible';
    }

</script>
<!-- CONTENT -->
