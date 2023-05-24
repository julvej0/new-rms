<?php
include_once "../../../views/admin/account-management/functionalities/user-session.php";

?>
<!-- STYLES -->
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="../../../css/admin/templates/navbar.css">
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
    <ul class="side-menu">
        <li><a href="../../../views/admin/dashboard/dashboard.php" id='dashboard-link'>
            <i class='bx bxs-dashboard icon'></i>Dashboard</a>
        </li>
        <li class="divider" data-text="Main">Main</li>
        <li><a href="../../../views/admin/publications/publications.php" id='publication-link'>
            <i class='bx bxs-book-open icon' ></i>Publications</a>
        </li>
        <li>
            <a href="../../../views/admin/ip-assets/ip-assets.php" id='ip-assets-link'>
            <i class='bx bxs-folder icon' ></i>IP Assets</a>
        </li>
        <li><a href="../../../views/admin/authors/authors.php" id='author-link'>
            <i class='bx bxs-group icon' ></i>Authors</a>
        </li>
        <li><a href="../../../views/admin/user-accounts/user-accounts.php" id='user-accounts-link'>
            <i class='bx bxs-user icon'></i></i>User Accounts</a>
        </li>
        <li class="divider" data-text="Account">Account</li>
        <li id="account-settings">
            <a href="#" id="account-link">
                <i class='bx bxs-cog icon' ></i>Account Settings<i class='bx bx-chevron-right icon-right' ></i>
            </a>
            <ul class='side-dropdown'>
                <li><a href="../../../views/admin/account-management/user-profile.php" id="user-link">Profile</a></li>
                <li><a href="../../../views/admin/account-management/user-security.php" id="security-link">Change Password</a></li>
            </ul>
            <a class="logout" onclick = 'return showLogoutAlert()'>
                <i class='bx bx-log-out icon rotate' name='logout' ></i>Sign Out
            </a>
        </li>

    </ul>
</section>
<!-- SIDEBAR -->

<!-- APPBAR -->
<section id='appbar-content'>
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu toggle-sidebar' ></i>
        <span class="divider"></span>
        <div class="profile">
        <p class="user-name" style="font-weight: bold; 'text-transform: uppercase; ?>"><?=$_SESSION['user_name']?></p>
        <small>Admin</small>
        </div>
    </nav>
    <!-- NAVBAR -->
<!-- APPBAR -->
 
<!-- Script -->
<script src="../../../js/admin/templates/navbar.js"></script>

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