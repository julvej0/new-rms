<?php
include_once dirname(__FILE__, 3) . "/views/admin/account-management/functionalities/user-session.php";
//TODO: rename this to something like admin-nav or admin-sidebar
?>
<!-- STYLES -->
<link rel="stylesheet" href="./../../../css/index.css">
<link rel="stylesheet" href="./../../../components/navbar/navbar.css">
<!-- STYLES -->
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<!-- CDN -->
<!-- SIDEBAR -->
<section id="sidebar">
    <div class="logo">
        <div class="logo-wrapper">
            <img src="../../../assets/images/batStateUNeu-logo.png" alt="">
        </div>
        <h4 class="logo-title">Research Management Services</h4>
    </div>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <ul class="side-menu">
        <li>
            <a href="../../../views/admin/dashboard/dashboard.php" id='dashboard-link' onclick="showLoadingScreen()">
                <i class='bx bxs-dashboard icon'></i>Dashboard</a>
        </li>
        <li class="divider" data-text="Main">Main</li>
        <li>
            <a href="../../../views/admin/publications/publications.php" id='publication-link'
                onclick="showLoadingScreen()">
                <i class='bx bxs-book-open icon'></i>Publications</a>
        </li>
        <li>
            <a href="../../../views/admin/ip-assets/ip-assets.php" id='ip-assets-link' onclick="showLoadingScreen()">
                <i class='bx bxs-folder icon'></i>IP Assets</a>
        </li>
        <li>
            <a href="../../../views/admin/authors/authors.php" id='author-link' onclick="showLoadingScreen()">
                <i class='bx bxs-group icon'></i>Authors</a>
        </li>
        <li>
            <a href="../../../views/admin/user-accounts/user-accounts.php" id='user-accounts-link' onclick="showLoadingScreen()">
                <i class='bx bxs-user icon'></i></i>User Accounts</a>
        </li>
        <li class="divider" data-text="Account">Account</li>
        <li>
            <a href="../../../views/admin/logs/logs.php" id='logs-link' onclick="showLoadingScreen()">
                <i class='bx bxs-log-in icon'></i>Logs</a>
        </li>
        <li id="account-settings">
            <a href="#" id="account-link">
                <i class='bx bxs-cog icon'></i>Account Settings<i class='bx bx-chevron-right icon-right'></i>
            </a>
            <ul class='side-dropdown'>
                <li>
                    <a href="../../../views/admin/account-management/user-profile.php" id="user-link"
                        onclick="showLoadingScreen()">Profile</a>
                </li>
                <li>
                    <a href="../../../views/admin/account-management/change-password.php" id="security-link"
                        onclick="showLoadingScreen()">Change Password</a>
                </li>
            </ul>
            <a class="logout" onclick='return showLogoutAlert()'>
                <i class='bx bx-log-out icon rotate' name='logout'></i>
                Sign Out
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->
<!-- TODO: see if it's possible to track the state of the collapse of the sidebar(localStorage?) -->
<!-- Script -->
<script src="../../../components/navbar/navbar.js"></script>

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
                window.location.href = '../../../views/logout/logout.php?logout=1';
            }
        });

        return false; // Prevent the default behavior of the anchor tag
    }
</script>