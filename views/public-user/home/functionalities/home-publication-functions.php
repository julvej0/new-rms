<?php
function getPublicationsContributors($conn) {
    $sqlAuthors = "SELECT * FROM table_authors ORDER BY author_id ASC";
    $resultAuthors = pg_prepare($conn, "getAuthorsPublications", $sqlAuthors);
    $resultAuthors = pg_execute($conn, "getAuthorsPublications", array());

    $sqlPublications = "SELECT authors FROM table_publications";
    $resultPublications = pg_prepare($conn, "getPublications", $sqlPublications);

    if(pg_num_rows($resultAuthors) > 0){
        $contributors = array();
        while ($row = pg_fetch_assoc($resultAuthors)) {
            $count1=0;
            $resultPublications = pg_execute($conn, "getPublications", array());

            if(pg_num_rows($resultPublications) > 0){
                while ($row2 = pg_fetch_assoc($resultPublications)) {
                    $authorIds = explode(',', $row2['authors']);
                    foreach ($authorIds as $id) {
                        if ($id === $row['author_id'] ){
                            $count1=$count1+1;
                        }
                    }
                }
            }
    
            $total_count = $count1;
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
                <td><?=htmlspecialchars($contributor['author_name']);?></td>
                <td><?=htmlspecialchars($contributor['total_publications']);?></td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
    <?php

}

function getMostViewedPapers($conn, $reuse_stmt = false) {
    $sql = "SELECT title_of_paper, number_of_citation FROM table_publications WHERE number_of_citation IS NOT NULL ORDER BY number_of_citation DESC LIMIT 4;";
    if (!$reuse_stmt) {
        $stmt = pg_prepare($conn, "get_most_viewed_papers", $sql);
    }
    $result = pg_execute($conn, "get_most_viewed_papers", array());

    $output = "<table>";
    $output .= "<tr><th>Title of Paper</th><th>Number of Citations</th></tr>";
    while ($row = pg_fetch_assoc($result)) {
        $output .= "<tr><td>".$row['title_of_paper']."</td><td>".$row['number_of_citation']."</td></tr>";
    }
    $output .= "</table>";

    return $output;
}

function getRecentPublications($conn, $limit) {
    $query = "SELECT title_of_paper, date_published FROM table_publications ORDER BY date_published DESC LIMIT $1";
    $params = array($limit);

    $query_run = pg_prepare($conn, "recent_assets_query", $query);
    if(!$query_run) {
        echo "Prepared statement creation failed: " . pg_last_error($conn);
    } else {
        $result = pg_execute($conn, "recent_assets_query", $params);
        if(!$result) {
            echo "Query execution failed: " . pg_last_error($conn);
        } else {
            $rows = pg_fetch_all($result);
            if(!$rows) {
                echo "<p>No data found</p>";
            } else {
                echo "<table>";
                echo "<tr><th>Title</th><th>Date Registered </th></tr>";    
                foreach($rows as $row) {
                    $date = date('F d, Y', strtotime($row['date_published']));
                    echo "<tr><td>".$row['title_of_paper']."</td><td>".$date."</td></tr>";
                }
                echo "</table>";
            }
        }
    }
}
?>