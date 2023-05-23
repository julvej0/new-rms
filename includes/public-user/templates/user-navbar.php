
<?php
session_start();
?>



<!-- css -->
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="../../../css/public-user/user-navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>

<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="sweetalert2.min.css">

<body>
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
                            <li><a href="../../../views/public-user/home/home.php" id='home-link'>HOME</a></li>
                            <li><a href="../../../views/public-user/ipa/ipa.php" id='ipa-link'>PATENT DOCUMENTS</a></li>
                            <li><a href="../../../views/public-user/articles/articles.php" id='pb-link'>PUBLICATIONS</a></li>
                            <li><a href="../../../views/public-user/about/about.php" id='abt-link'>ABOUT</a></li>
                            <a class="signin-btn" href="<?=isset($_SESSION['user_email']) ? '../../../views/admin/account/functionalities/logout.php?logout=1' :  '../../../views/admin/account/login.php'?>" onclick="<?=isset($_SESSION['user_email']) ? 'return showLogoutAlert()' : ''?>">
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
                                    <a style='margin-right: 30px;' href="../../../views/public-user/profile/user-profile.php">
                                        <i class="fas fa-user"></i> PROFILE
                                    </a>
                                    <?php if ($isAuthor): ?>
                                        <a style='margin-right: 30px;' href="../../../views/public-user/author-info/author-profile.php">
                                            <i class="fas fa-info-circle"></i> AUTHOR INFORMATION
                                        </a>
                                    <?php endif; ?>
                                    <a href="../../../views/public-user/profile/user-security.php">
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
<script src="../../../js/public-user/user-navbar.js"></script>
<script src="../../../js/public-user/profile-dropdown.js"></script>
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
                window.location.href = '../../../views/admin/account/functionalities/logout.php?logout=1';
            }
        });

        return false; // Prevent the default behavior of the anchor tag
    }
</script>
<!-- CONTENT -->



