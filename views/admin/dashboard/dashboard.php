<?php 
    include '../../../includes/admin/templates/header.php';
    require_once "../../../db/db.php";
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
                            $query = "SELECT title_of_paper FROM table_publications;";
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
                    <?php
                            $sql = "SELECT * FROM table_authors ORDER BY author_id ASC";
                            $result = pg_query($conn, $sql);

                            if(pg_num_rows($result) > 0){
                                $contributors = array();
                                while ($row = pg_fetch_assoc($result)) {
                                    $count1=0;
                                    $getAuthors = "SELECT authors FROM table_publications";
                                    $getAuthorsResult = pg_query($conn, $getAuthors);

                                    if(pg_num_rows($getAuthorsResult) > 0){
                                        while ($row2 = pg_fetch_assoc($getAuthorsResult)) {
                                            $authorIds = explode(',', $row2['authors']);
                                            foreach ($authorIds as $id) {
                                                if ($id === $row['author_id'] ){
                                                    $count1=$count1+1;
                                                }
                                            }
                                        }
                                    }

                                    $count2=0;
                                    $getAuthors = "SELECT authors FROM table_ipassets";
                                    $getAuthorsResult = pg_query($conn, $getAuthors);

                                    if(pg_num_rows($getAuthorsResult) > 0){
                                        while ($row2 = pg_fetch_assoc($getAuthorsResult)) {
                                            $authorIds = explode(',', $row2['authors']);
                                            foreach ($authorIds as $id) {
                                                if ($id === $row['author_id'] ){
                                                    $count2=$count2+1;
                                                }
                                            }
                                        }
                                    }

                                    $total_count = $count1 + $count2;
                                    if ($total_count > 0) {
                                        $contributors[] = array(
                                            'author_name' => $row['author_name'],
                                            'total_publications' => $total_count
                                        );
                                    }
                                }

                                // Sort contributors by number of publications in descending order
                                usort($contributors, function($a, $b) {
                                    return $b['total_publications'] - $a['total_publications'];
                                });

                                // Display top 5 contributors
                                $count = 0;
                                ?>
                                <table>
                                <tr>
                                    <th>Authors</th>
                                    <th>Number of Publications</th>
                                </tr>
                                <?php
                                foreach ($contributors as $contributor) {
                                    $count++;
                                    if ($count > 7) {
                                        break;
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$contributor['author_name'];?></td>
                                        <td><?=$contributor['total_publications'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </table>
                    </div>
                </div>
                <div class="main-content-data">
                    <div class="head">
                        <h3>Most Cited Articles</h3>
                    </div>
                    <div>
                        <?php
                            $sql = "SELECT title_of_paper, number_of_citation FROM table_publications WHERE number_of_citation IS NOT NULL ORDER BY number_of_citation DESC LIMIT 3;";
                            $result = pg_query($conn, $sql);

                            echo "<table>";
                            echo "<tr><th>Title of Paper</th><th>Number of Citations</th></tr>";
                            while ($row = pg_fetch_assoc($result)) {
                            echo "<tr><td>".$row['title_of_paper']."</td><td>".$row['number_of_citation']."</td></tr>";
                            }
                            echo "</table>";

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
                        <h3>Recently Added Articles</h3>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Title</th>
                                <th>Date added</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
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