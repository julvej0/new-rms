<title>RMS | DASHBOARD</title>
<?php
    include '../../../includes/admin/templates/header.php';
    require_once "../../../db/db.php";
    include './functionalities/dashboard-function.php'; 
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="dashboard.css">
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.2/dist/apexcharts.min.js"></script>

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
                        <?php
                        $pub_per_year = getPublicationsPerYear($conn);
                        $publications_data = $pub_per_year['data'];
                        $publications_year = $pub_per_year['labels'];
                        ?>
                        <div id="pb-bar-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Publications Status Report</h3>
                    </div>
                    <div class="chart">
                        <?php
                        $pb_status = getPublicationsStatus($conn);
                        $status_data = $pb_status['data'];
                        $status_labels = $pb_status['labels'];
                        ?>
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
                        <?php
                            $ipassets_per_year = getIPAssetsPerYear($conn);
                            $ipyear_data = $ipassets_per_year['data'];
                            $ipyear_labels = $ipassets_per_year['labels'];                           
                        ?>
                        <div id="ipa-bar-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>IP-assets Report (campus)</h3>
                    </div>
                    <div class="chart">    
                        <?php                     
                            $data = getIpAssetsCampus($conn);
                            $campus_data = $data["data"];
                            $campus_labels = $data["labels"];
                        ?>                    
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
    <script src="dashboard.js"></script>
    <script>
        var campus_data = <?php echo $campus_data; ?>;
        var campus_labels = <?php echo $campus_labels; ?>;
        var campus_options = {
            chart: {
                type: 'donut'
            },
            series: campus_data,
            labels: campus_labels,
            responsive: [{
                breakpoint: 500,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
       
        var campus_chart = new ApexCharts(document.querySelector("#ipa-pie-chart"), campus_options);
        campus_chart.render();
    </script>
    <script>
        var status_data = <?php echo $status_data; ?>;
        var status_labels = <?php echo $status_labels; ?>;
        var status_options = {
            chart: {
                type: 'donut'
            },
            series: status_data,
            labels: status_labels,
            responsive: [{
                breakpoint: 500,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
       
        var status_chart = new ApexCharts(document.querySelector("#pb-pie-chart"), status_options);
        status_chart.render();
    </script>
    <script>
        var year_data = <?php echo $ipyear_data;?>;
        var year_labels = <?php echo $ipyear_labels;?>;
        var year_options = {
            chart: {
                type: 'bar'
            },
            series: [{
                data: year_data
            }],
            xaxis: {
                categories: year_labels
            },
            title: {
            text: 'IP Assets Per Year',
            align: 'center',
            margin: 10,
            offsetY: 20,
            style: {
                fontSize:  '20px',
                fontWeight:  'bold',
                fontFamily:  undefined,
                color:  '#263238'
                },
            },
            responsive: [{
                breakpoint: 500,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var year_chart = new ApexCharts(document.querySelector("#ipa-bar-chart"), year_options);
        year_chart.render();
    </script>
    <script>
        var pub_data = <?php echo $publications_data;?>;
        var pub_labels = <?php echo $publications_year;?>;
        var pub_options = {
            chart: {
                type: 'line'
            },
            series: [{
                data: pub_data
            }],
            xaxis: {
                categories: pub_labels
            },
            title: {
            text: 'Publications Per Year',
            align: 'center',
            margin: 10,
            offsetY: 20,
            style: {
                fontSize:  '20px',
                fontWeight:  'bold',
                fontFamily:  undefined,
                color:  '#263238'
                },
            },
            responsive: [{
                breakpoint: 500,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pub_chart = new ApexCharts(document.querySelector("#pb-bar-chart"), pub_options);
        pub_chart.render();
    </script>

</body>

<?php
    include '../../../includes/admin/templates/footer.php';
?>