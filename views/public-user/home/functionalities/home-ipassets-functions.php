<?php
// getting the number o authors with most contributions in ip assets
function getIpAssetsContributors($conn) {
    $sqlAuthors = "SELECT * FROM table_authors ORDER BY author_id ASC";
    $resultAuthors = pg_prepare($conn, "getAuthorsIpAssets", $sqlAuthors);
    $resultAuthors = pg_execute($conn, "getAuthorsIpAssets", array());

    if(pg_num_rows($resultAuthors) > 0){
        $contributors = array();
        while ($row = pg_fetch_assoc($resultAuthors)) {

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

   
            $total_count = $count2;
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

        // Display top 9 contributors
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
            if ($count > 9) {
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
    <?php
}
//getting the number of most ip assets by campuses
function getTopCampus($conn, $limit) {
    $query = "SELECT campus, COUNT(*) as dataset FROM table_ipassets WHERE campus IS NOT NULL GROUP BY campus ORDER BY dataset DESC LIMIT $1";
    $params = array($limit);

    $query_run = pg_prepare($conn, "top_campus_query", $query);
    if(!$query_run) {
        echo "Prepared statement creation failed: " . pg_last_error($conn);
    } else {
        $result = pg_execute($conn, "top_campus_query", $params);
        if(!$result) {
            echo "Query execution failed: " . pg_last_error($conn);
        } else {
            $rows = pg_fetch_all($result);
            if(!$rows) {
                echo "<p>No data found</p>";
            } else {
                echo "<table>";
                echo "<tr><th>Campus</th><th>Number of IP Assets</th></tr>";    
                foreach($rows as $row) {
                    echo "<tr><td>".$row['campus']."</td><td>".$row['dataset']."</td></tr>";
                }
                echo "</table>";
            }
        }
    }
}
// getting the recently added articles
function getRecentIpAssets($ipassetsurl) {
    $data = file_get_contents($ipassetsurl);
    $assets = json_decode($data, true);

    // Sort the assets based on the 'date_registered' column in descending order
    usort($assets, function ($a, $b) {
        return strtotime($b['date_registered']) - strtotime($a['date_registered']);
    });

    $recent_assets = array_slice($assets, 0, 4); // Get the top 4 records

    // Print the details of the top 4 assets in a table format
    echo "<table>";
    echo "<tr><th>Title</th><th>Date Registered</th></tr>";

    foreach ($recent_assets as $asset) {
        $date = date('F d, Y', strtotime($asset['date_registered']));
        echo "<tr><td>" . $asset['title_of_work'] . "</td><td>" . $date . "</td></tr>";
    }

    echo "</table>";
}

?>