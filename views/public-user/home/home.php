<title>RMS | Home</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
    include_once './functionalities/home-publication-functions.php';
    include_once './functionalities/home-ipassets-functions.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./home.css">
<?php 
    include '../../../includes/public-user/templates/user-navbar.php'; 
?>

<body>
    
<div class="home-content">
    <section id="hero-img">
        <div class="rms-title">
            <h1>Research Management Services</h1>
        </div>
        <div class="search">
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Search">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
        </div>
    </section>
    <div class="main-container">
        <div class="content">
            <div class="title">
                <h3>Publications</h3>
            </div>
            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <h3>Top Contributors</h3>
                        <div class="table">
                            <?php 
                            echo getPublicationsContributors($conn);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Most Cited </h3>
                        <div class="table">
                            <?php
                            echo getMostViewedPapers($conn);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Recently Added </h3>
                        <div class="table">
                            <?php
                            getRecentPublications($conn, 3)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-more-btn">
                <a href="../articles/articles.php">See More<i class='bx bx-right-arrow-alt icon'></i></a>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h3>IP ASSETS</h3>
            </div>
            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <h3>Top Contributors</h3>
                        <div class="table">
                            <?php
                            getIpAssetsContributors($conn)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Top Campus with IP Assets</h3>
                        <div class="table">
                            <?php
                            getTopCampus($conn, 11)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Recently Added</h3>
                        <div class="table">
                            <?php
                            getRecentIpAssets($conn, 3)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-more-btn">
                <a href="#">See More<i class='bx bx-right-arrow-alt icon'></i></a>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h3>ABOUT</h3>
            </div>
            <div class="card-container">
                <div class="card abt-card">
                     <div class="abt-img">
                        <img src="../../../assets/images/vipcorals.webp" alt="">
                     </div>
                     <div class="abt-text">
                        <div class="title">
                            <h1>Why do we use it?</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                        </div>
                        <div class="see-more-btn">
                            <a href="#">Read More<i class='bx bx-right-arrow-alt icon'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../../includes/public-user/templates/user-footer.php"; ?>
</body>
<?php 
    include '../../../includes/admin/templates/footer.php';
?>