
<?php
session_start();
?>

<!-- css -->
<link rel="stylesheet" href="//localhost/new-rms-webdev/css/index.css">
<link rel="stylesheet" href= "//localhost/new-rms-webdev/components/public-user/css/user-navbar.css">

<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="sweetalert2.min.css">
<!-- TODO: learn how to make link href target absolute paths without actually hardcoding the url -->
<body>
<section>
    <div class="navbar-container">
        <div class="left">
            <div class="left-md-container">
                <div class="left-sm-container">
                    <div class="left-content">
                        <div class="logo">
                            <img src="//localhost/new-rms-webdev/assets/images/batStateUNeu-logo.png" alt="">
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
                            <?php if ($_SESSION['account_type'] == "Admin"): ?>
                                <li><a href="//localhost/new-rms-webdev/views/admin/home/home.php" id='home-link'>HOME</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/admin/ip-assets/ip-assets.php" id='ipa-link'>IP ASSETS</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/admin/articles/articles.php" id='pb-link'>PUBLICATIONS</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/admin/about/about.php" id='abt-link'>ABOUT</a></li>
                            <?php else: ?>
                                <li><a href="//localhost/new-rms-webdev/views/public-user/home/home.php" id='home-link'>HOME</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/public-user/ipa/ipa.php" id='ipa-link'>IP ASSETS</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/public-user/articles/articles.php" id='pb-link'>PUBLICATIONS</a></li>
                                <li><a href="//localhost/new-rms-webdev/views/public-user/about/about.php" id='abt-link'>ABOUT</a></li>
                            <?php endif; ?>
                            
                            <a class="signin-btn" href="<?=isset($_SESSION['user_email']) ? '//localhost/new-rms-webdev/views/logout/logout.php?logout=1' :  '//localhost/new-rms-webdev/views/login/login.php'?>" onclick="<?=isset($_SESSION['user_email']) ? 'return showLogoutAlert()' : ''?>">
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
                                    <a style='margin-right: 30px;' href="//localhost/new-rms-webdev/views/public-user/profile/user-profile.php">
                                        <i class="fas fa-user"></i> PROFILE
                                    </a>
                                    <?php if ($isAuthor): ?>
                                        <a style='margin-right: 30px;' href="//localhost/new-rms-webdev/views/public-user/author-info/author-profile.php">
                                            <i class="fas fa-info-circle"></i> AUTHOR INFORMATION
                                        </a>
                                    <?php endif; ?>
                                    <a href="//localhost/new-rms-webdev/views/public-user/profile/user-security.php">
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
<script src="//localhost/new-rms-webdev/components/public-user/js/user-navbar.js"></script>
<script src="//localhost/new-rms-webdev/components/public-user/js/profile-dropdown.js"></script>
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
                window.location.href = '//localhost/new-rms-webdev/views/logout/logout.php?logout=1';
            }
        });

        return false; // Prevent the default behavior of the anchor tag
    }
</script>
<!-- CONTENT -->



