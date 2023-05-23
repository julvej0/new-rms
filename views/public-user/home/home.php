<title>RMS | Home</title>
<?php 
    include '../../../includes/admin/templates/header.php';
    include '../../../db/db.php';
    include_once './functionalities/home-publication-functions.php';
    include_once './functionalities/home-ipassets-functions.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./home.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
                    <select name="dropdown" id="dropdown">
                        <option value="publications">Publications</option>
                        <option value="ip-assets">IP assets</option>
                    </select>
                </div>
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
                <div class="card" id="card">
                    <div class="card-content">
                        <h3>Top Contributors</h3>
                        <div class="table">
                            <?php 
                            // Call the `getPublicationsContributors` function to retrieve publications contributors using the database connection object $conn
                            echo getPublicationsContributors($conn);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card " id="card">
                    <div class="card-content">
                        <h3>Most Cited </h3>
                        <div class="table">
                            <?php
                            // Call the `getMostViewedPapers` function to retrieve the most viewed papers using the database connection object $conn
                            echo getMostViewedPapers($conn);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card " id="card">
                    <div class="card-content">
                        <h3>Recently Added </h3>
                        <div class="table">
                            <?php
                            // Call the `getRecentPublications` function to retrieve the most recent publications using the database connection object $conn and a limit of 5
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
                             // Call the `getIpAssetsContributors` function to retrieve the contributors of intellectual property (IP) assets using the database connection object $conn
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
                            //Call `getTopCampus` function to retrieve the top campus with most ip assets
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
                            // Call the `getRecentIpAssets` function to retrieve the most recent intellectual property (IP) assets using the database connection object $conn and a limit of 5
                            getRecentIpAssets($conn, 3)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-more-btn">
                <a href="../ipa/ipa.php">See More<i class='bx bx-right-arrow-alt icon'></i></a>
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
<script src="./home.js"></script>
<?php 
    include '../../../includes/admin/templates/footer.php';
?>