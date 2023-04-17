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
            <i class='bx bxs-folder icon' ></i>IP assets</a>
        </li>
        <li><a href="../../../views/admin/authors/authors.php" id='author-link'>
            <i class='bx bxs-group icon' ></i>Authors</a>
        </li>
        <li class="divider" data-text="Account">Account</li>
        <li>
            <a href="#">
            <i class='bx bxs-cog icon' ></i>Account Settings<i class='bx bx-chevron-right icon-right' ></i></a>
            <ul class='side-dropdown'>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Security</a></li>
            </ul>
            <a href="#">
            <i class='bx bx-log-out icon rotate'></i>Sign Out</a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- APPBAR -->
<section id='appbar-content'>
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu toggle-sidebar' ></i>
        <form action="#">
            <div class="form-group">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search icon' ></i>
            </div>
        </form>
        <span class="divider"></span>
        <div class="profile">
            <p class="user-name">Juan Dela Cruz</p>
        </div>
    </nav>
    <!-- NAVBAR -->
<!-- APPBAR -->

<!-- Script -->
<script src="../../../js/admin/templates/navbar.js"></script>