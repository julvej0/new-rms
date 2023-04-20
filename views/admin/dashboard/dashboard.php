<?php 
    include '../../../includes/admin/templates/header.php';
    require_once "../../../db/db.php";
    include_once './functionalities/dashboard-function.php'; 
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="dashboard.css">
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- CDN -->

<body>
    <?php
            include '../../../includes/admin/templates/navbar.php';
    ?>
    
    <main>
        <div class="header">
            <h1 class="title">Dashboard</h1>
            <div class="routes">
                <a href="#" class="nav-button" data-target="#pb-page"><span>Publications</span></a>
                <a href="#" class="nav-button" data-target="#ipa-page"><span>IP-assets</span></a>
            </div>
        </div>
        <section id="pb-page" class="sub-page">
            <div class="content-data">
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php                 
                            $user_count = getUserCount($conn);
                            echo '<h2>'.$user_count.'</h2>';
                            ?>
                            <p>Users</p>
                        </div>
                        <i class='bx bx-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php  
                            $author_count = getAuthorCount($conn);
                            echo '<h2>'.$author_count.'</h2>';
                            ?>
                            <p>Contributors</p>
                        </div>
                        <i class='bx bxs-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php 
                            $article_count = getArticleCount($conn);
                            echo '<h2>' .$article_count. '</h2>'
                            ?>
                            <p>Articles</p>
                        </div>
                        <i class='bx bxs-book-open' ></i>
                    </div>
                </div>
            </div>
            <div class="data">
                <div class="main-content-data">
                    <div class="head">
                        <h3>Publications Report</h3>
                    </div>
                    <div class="chart">
                        
                        <div id="pb-bar-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Publications Status Report</h3>
                    </div>
                    <div class="chart">
                        <div id="pb-pie-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Top Contributors</h3>
                    </div>
                    <div>
                        <?php 
                        echo getPublicationsContributors($conn);
                        ?>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Most Cited Articles</h3>
                    </div>
                    <div>
                        <?php
                        echo getMostViewedPapers($conn);
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- IP-assets -->
        <section id="ipa-page" class="sub-page">
            <div class="content-data">
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php                
                            include_once './functionalities/dashboard-function.php';   
                            $user_count = getUserCount($conn, true);
                            echo '<h2>'.$user_count.'</h2>';
                            ?>
                            <p>Users</p>
                        </div>
                        <i class='bx bx-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php
                            include_once './functionalities/dashboard-function.php';   
                            $author_count = getAuthorCount($conn, true);
                            echo '<h2>'.$author_count.'</h2>';
                            ?>
                            <p>Contributors</p>
                        </div>
                        <i class='bx bxs-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php
                            $published_ipassets = getPublishedIPAssets($conn);
                            echo '<h2>'.$published_ipassets.'</h2>'
                            ?>
                            <p>Articles</p>
                        </div>
                        <i class='bx bxs-book-open' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php
                            $processing_ipassets = getProcessingIpAssets($conn);
                            echo '<h2>'.$processing_ipassets.'</h2>'
                            ?>
                            <p>Unregistered Articles</p>
                        </div>
                        <i class='bx bx-book-alt' ></i>
                    </div>
                </div>
            </div>
            <div class="data">
                <div class="main-content-data">
                    <div class="head">
                        <h3>IP-assets Report</h3>
                    </div>
                    <div class="chart">
                        <div id="ipa-bar-chart">

                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>IP-assets Report (campus)</h3>
                    </div>
                    <div class="chart">
                        <div id="ipa-pie-chart">

                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Top Contributors</h3>
                    </div>
                    <div>
                        <?php 
                        echo getIpAssetsContributors($conn);
                        ?>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Recently Added Articles</h3>
                    </div>
                    <div>
                        <?php
                        getRecentIpAssets($conn, 5);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Section closing tag from navbar -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="dashboard.js"></script>
</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>