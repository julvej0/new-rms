<title>RMS | DASHBOARD</title>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="dashboard.css">
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="../../../js/apexchartsV3.28.2.min.js"></script>
<!-- CDN -->

<?php
    include dirname(__FILE__, 4) . "/components/header/header.php";
    require_once  dirname(__FILE__, 4) . "/helpers/db.php";
    include './functionalities/dashboard-function.php'; 
    include dirname(__FILE__, 4) . '/components/navbar/navbar.php';
?>

<body>
    <main>
        <div class="header">
            <h1 class="title">Dashboard</h1>
            <div class="routes">
                <a href="#" class="nav-button" data-target="#pb-page"><span>Publications</span></a>
                <a href="#" class="nav-button" data-target="#ipa-page"><span>IP assets</span></a>
            </div>
        </div>
        <section id="pb-page" class="sub-page">
            <div class="content-data">
                <div class="content-card">
                    <div class="head">
                        <div>
                            <?php
                                // Retrieve the user count using the `getUserCount` function and store it in the variable $user_count
                                $user_count = getUserCount($conn);
                                
                                // Output the user count within an <h2> HTML element
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
                                // Retrieve the author count using the `getAuthorCount` function and store it in the variable $author_count
                                $author_count = getAuthorCount($conn);

                                // Output the author count within an <h2> HTML element
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
                                // Retrieve the article count using the `getArticleCount` function and store it in the variable $article_count
                                $article_count = getArticleCount($conn);

                                // Output the article count within an <h2> HTML element
                                echo '<h2>'.$article_count.'</h2>';
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
                            // Retrieve publications data per year using the `getPublicationsPerYear` function and store it in the variable $pub_per_year
                            $pub_per_year = getPublicationsPerYear($conn);

                            // Extract the publications data from the $pub_per_year array and assign it to the variable $publications_data
                            $publications_data = $pub_per_year['data'];

                            // Extract the year labels from the $pub_per_year array and assign them to the variable $publications_year
                            $publications_year = $pub_per_year['labels'];
                        ?>
                        <div id="pb-bar-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Type of Publications Report</h3>
                    </div>
                    <div class="chart">
                        <?php
                            // Retrieve publication types and their data using the `getPublicationType` function and store it in the variable $pb_status
                            $pb_status = getPublicationType($conn);

                            // Extract the publication data from the $pb_status array and assign it to the variable $status_data
                            $status_data = $pb_status['data'];

                            // Extract the publication type labels from the $pb_status array and assign them to the variable $status_labels
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
                        // Call the `getPublicationsContributors` function to retrieve publications contributors using the database connection object $conn
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
                        // Call the `getMostViewedPapers` function to retrieve the most viewed papers using the database connection object $conn
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
                                // Retrieve the user count using the `getUserCount` function with an optional parameter and store it in the variable $user_count
                                $user_count = getUserCount($conn, true);

                                // Output the user count within an <h2> HTML element
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
                                // Retrieve the author count using the `getAuthorCount` function with an optional parameter and store it in the variable $author_count
                                $author_count = getAuthorCount($conn, true);

                                // Output the author count within an <h2> HTML element
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
                                // Retrieve the published IP assets using the `getPublishedIPAssets` function and store it in the variable $published_ipassets
                                $published_ipassets = getPublishedIPAssets($conn);

                                // Output the published IP assets within an <h2> HTML element
                                echo '<h2>'.$published_ipassets.'</h2>';
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
                        <h3>IP Assets Report</h3>
                    </div>
                    <div class="chart">
                        <?php
                            // Retrieve IP assets per year using the `getIPAssetsPerYear` function and store it in the variable $ipassets_per_year
                            $ipassets_per_year = getIPAssetsPerYear($conn);

                            // Extract the IP assets data from the $ipassets_per_year array and assign it to the variable $ipyear_data
                            $ipyear_data = $ipassets_per_year['data'];

                            // Extract the year labels from the $ipassets_per_year array and assign them to the variable $ipyear_labels
                            $ipyear_labels = $ipassets_per_year['labels'];
                        ?>
                        <div id="ipa-bar-chart">
                        </div>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>IP Assets Report (campus)</h3>
                    </div>
                    <div class="chart">    
                        <?php
                            // Retrieve IP assets by campus using the `getIpAssetsCampus` function and store it in the variable $data
                            $data = getIpAssetsCampus($conn);

                            // Extract the IP assets data from the $data array and assign it to the variable $campus_data
                            $campus_data = $data["data"];

                            // Extract the campus labels from the $data array and assign them to the variable $campus_labels
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
                        // Call the `getIpAssetsContributors` function to retrieve the contributors of intellectual property (IP) assets using the database connection object $conn
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
                        // Call the `getRecentIpAssets` function to retrieve the most recent intellectual property (IP) assets using the database connection object $conn and a limit of 5
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
        // Assign the campus data obtained from PHP to a JavaScript variable
        var campus_data = <?php echo $campus_data; ?>;
        
        // Assign the campus labels obtained from PHP to a JavaScript variable
        var campus_labels = <?php echo $campus_labels; ?>;
        
        // Configure the options for the donut chart
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
    
        // Create a new ApexCharts instance with the chart container element and options
        var campus_chart = new ApexCharts(document.querySelector("#ipa-pie-chart"), campus_options);
        
        // Render the chart
        campus_chart.render();
    </script>
    <script>
        // Assign the status data obtained from PHP to a JavaScript variable
        var status_data = <?php echo $status_data; ?>;
        
        // Assign the status labels obtained from PHP to a JavaScript variable
        var status_labels = <?php echo $status_labels; ?>;
        
        // Configure the options for the donut chart
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
    
        // Create a new ApexCharts instance with the chart container element and options
        var status_chart = new ApexCharts(document.querySelector("#pb-pie-chart"), status_options);
        
        // Render the chart
        status_chart.render();
    </script>
    <script>
        // Assign the year data obtained from PHP to a JavaScript variable
        var year_data = <?php echo $ipyear_data; ?>;
        
        // Assign the year labels obtained from PHP to a JavaScript variable
        var year_labels = <?php echo $ipyear_labels; ?>;
        
        // Configure the options for the line chart
        var year_options = {
            chart: {
                type: 'line',
                height: 350, // set the height of the chart
                foreColor: '#263238', // set the text color of the chart
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
                    fontSize: '20px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            colors: ['#03C988'], // set the chart color
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
        
        // Create a new ApexCharts instance with the chart container element and options
        var year_chart = new ApexCharts(document.querySelector("#ipa-bar-chart"), year_options);
        
        // Render the chart
        year_chart.render();
    </script>
    <script>
        // Assign the publication data obtained from PHP to a JavaScript variable
        var pub_data = <?php echo $publications_data; ?>;
        
        // Assign the publication labels obtained from PHP to a JavaScript variable
        var pub_labels = <?php echo $publications_year; ?>;
        
        // Configure the options for the line chart
        var pub_options = {
            chart: {
                type: 'line',
                height: 350, // set the height of the chart
                foreColor: '#263238', // set the text color of the chart
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
                    fontSize: '20px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            colors: ['#03C988'], // set the chart color
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

        // Create a new ApexCharts instance with the chart container element and options
        var pub_chart = new ApexCharts(document.querySelector("#pb-bar-chart"), pub_options);
        
        // Render the chart
        pub_chart.render();
    </script>
</body>

<?php
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>