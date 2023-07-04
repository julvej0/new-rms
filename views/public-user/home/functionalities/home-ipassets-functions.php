<?php
// getting the number o authors with most contributions in ip assets

function getIpAssetsContributors($ipassetsurl, $authorurl) {
    $responseIpAssets = file_get_contents($ipassetsurl);

    // Parse the JSON response
    $dataIpAssets = json_decode($responseIpAssets, true);

    // Extract the 'authors' column from the data
    $authorsColumn = array_column($dataIpAssets['table_ipassets'], 'authors');

    // Initialize an associative array to count author IDs
    $authorCounts = array();

    // Iterate through each 'authors' value
    foreach ($authorsColumn as $authors) {
        // Split the 'authors' value by ','
        $authorIds = explode(',', $authors);

        // Count the occurrence of each author ID
        foreach ($authorIds as $authorId) {
            $authorId = trim($authorId); // Remove leading/trailing whitespaces
            if (!empty($authorId)) {
                if (isset($authorCounts[$authorId])) {
                    $authorCounts[$authorId]++;
                } else {
                    $authorCounts[$authorId] = 1;
                }
            }
        }
    }

    // Sort the author IDs based on their occurrence in descending order
    arsort($authorCounts);

    // Retrieve the top 9 most used author IDs and their occurrence counts
    $top9Authors = array_slice($authorCounts, 0, 9, true);

    $responseAuthors = file_get_contents($authorurl);

    // Parse the JSON response
    $dataAuthors = json_decode($responseAuthors, true);

    // Extract the 'author_id' and 'author_name' columns from the data
    $authorIdColumn = array_column($dataAuthors['table_authors'], 'author_id');
    $authorNameColumn = array_column($dataAuthors['table_authors'], 'author_name');

    // Create a mapping of author IDs to author names
    $authorMapping = array_combine($authorIdColumn, $authorNameColumn);

    // Create an array to store contributors' information
    $contributors = array();

    // Iterate through the top 9 author IDs
    foreach ($top9Authors as $authorId => $count) {
        // Check if the author ID exists in the mapping
        if (isset($authorMapping[$authorId])) {
            $authorName = $authorMapping[$authorId];
            $contributors[] = array(
                'author_name' => $authorName,
                'total_publications' => $count
            );
        }
    }

    // Sort the contributors array based on the total publications count in descending order
    usort($contributors, function($a, $b) {
        return $b['total_publications'] - $a['total_publications'];
    });

    // Display the top 9 contributors in the desired format
    $count = 0;
    ?>
    <table>
        <tr>
            <th>Authors</th>
            <th>Number of Publications</th>
        </tr>
        <?php foreach ($contributors as $contributor) {
            $count++;
            if ($count > 9) {
                break;
            }
        ?>
            <tr>
                <td><?= $contributor['author_name']; ?></td>
                <td><?= $contributor['total_publications']; ?></td>
            </tr>
        <?php } ?>
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
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $ipassetsurl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        return "cURL Error: " . $error;
    }

    curl_close($curl);

    $data = json_decode($response, true);

    $dateData = array_column($data['table_ipassets'], 'date_registered', 'title_of_work');

    arsort($dateData);

    $recentArticles = array_slice($dateData, 0, 3);

    $output = "<table>";
    $output .= "<tr><th>Title</th><th>Date Published</th></tr>";

    foreach ($recentArticles as $workTitle => $publisheddate) {
        $formattedDate = date('F d, Y', strtotime($publisheddate));
        $output .= "<tr><td>" . $workTitle . "</td><td>" . $formattedDate . "</td></tr>";
    }

    $output .= "</table>";

    echo $output;

}

?>