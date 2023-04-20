<?php 
    include '../../../includes/admin/templates/header.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="dashboard.css">
<!-- CDN -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                            require_once "../../../db/db.php";
                            $query = "SELECT user_id FROM table_user;";
                            $query_run = pg_query($conn, $query);
                            if (!$query_run) {
                                echo "Query failed: " . pg_last_error($conn);
                            } else {
                                $row_count = pg_num_rows($query_run);
                                if ($row_count == 0) {
                                    echo '<h2>0</h2>';
                                } else {
                                    echo '<h2>'.$row_count.'</h2>';
                                }
                            }
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
                            require_once "../../../db/db.php";
                            $query = "SELECT author_id FROM table_authors;";
                            $query_run = pg_query($conn, $query);
                            if (!$query_run) {
                                echo "Query failed: " . pg_last_error($conn);
                            } else {
                                $row_count = pg_num_rows($query_run);
                                if ($row_count == 0) {
                                    echo '<h2>0</h2>';
                                } else {
                                    echo '<h2>'.$row_count.'</h2>';
                                }
                            }
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
                            require_once "../../../db/db.php";
                            $query = "SELECT title_of_work FROM table_ipassets;";
                            $query_run = pg_query($conn, $query);
                            if (!$query_run) {
                                echo "Query failed: " . pg_last_error($conn);
                            } else {
                                $row_count = pg_num_rows($query_run);
                                if ($row_count == 0) {
                                    echo '<h2>0</h2>';
                                } else {
                                    echo '<h2>'.$row_count.'</h2>';
                                }
                            }
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
                        <table>
                            <tr class>
                                <th>Name</th>
                                <th>Published Articles</th>
                            </tr>
                            <tr>
                                <td>Lloyd Anthony Bautista</td>
                                <td>3500</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Most Cited Articles</h3>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Title</th>
                                <th>Citations</th>
                            </tr>
                            <tr>
                                <td>Article ni Lloyd</td>
                                <td>350</td>
                            </tr>
                        </table>
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
                            <h2>250</h2>
                            <p>Users</p>
                        </div>
                        <i class='bx bx-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <h2>250</h2>
                            <p>Contributors</p>
                        </div>
                        <i class='bx bxs-group icon' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <h2>250</h2>
                            <p>Articles</p>
                        </div>
                        <i class='bx bxs-book-open' ></i>
                    </div>
                </div>
                <div class="content-card">
                    <div class="head">
                        <div>
                            <h2>250</h2>
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
                        <table>
                            <tr class>
                                <th>Name</th>
                                <th>Published Articles</th>
                            </tr>
                            <tr>
                                <td>Lloyd Anthony Bautista</td>
                                <td>3500</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Most Cited Articles</h3>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Title</th>
                                <th>Citations</th>
                            </tr>
                            <tr>
                                <td>Article ni Lloyd</td>
                                <td>350</td>
                            </tr>
                        </table>
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