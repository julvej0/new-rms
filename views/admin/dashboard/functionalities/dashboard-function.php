<?php
// getting the total number of users account
function getUserCount($userurl) {
    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $userurl);

    // Set the option to return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        echo "Failed to retrieve data from the endpoint.";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Parse the JSON response
    $data = json_decode($response, true);

    // Check if the JSON was parsed successfully
    if ($data === null) {
        echo "Failed to parse JSON response.";
        return false;
    }

    // Get the number of users from the response
    $userCount = count($data['table_user']);

    return $userCount;
}


// getting the total number of authors 
function getAuthorCount($authorurl) {
    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $authorurl);

    // Set the option to return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        echo "Failed to retrieve data from the endpoint.";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Parse the JSON response
    $data = json_decode($response, true);

    // Check if the JSON was parsed successfully
    if ($data === null) {
        echo "Failed to parse JSON response.";
        return false;
    }

    // Get the number of authors from the response
    $authorCount = count($data['table_authors']);

    return $authorCount;
}

// getting the total number of articles in publications
function getArticleCount($publicationurl) {
    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $publicationurl);

    // Set the option to return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        echo "Failed to retrieve data from the endpoint.";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Parse the JSON response
    $data = json_decode($response, true);

    // Check if the JSON was parsed successfully
    if ($data === null) {
        echo "Failed to parse JSON response.";
        return false;
    }

    // Get the number of articles from the response
    $articleCount = count($data['table_publications']);

    return $articleCount;
}


// tobe updated
// getting the number of authors with most contributions in publications
function getPublicationsContributors($authorurl, $publicationurl) {
    
    $responsePublications = file_get_contents($publicationurl);

    // Parse the JSON response
    $dataPublications = json_decode($responsePublications, true);

    // Extract the 'authors' column from the data
    $authorsColumn = array_column($dataPublications, 'authors');

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

    // Make GET request to the 'http://localhost:5000/table_authors' endpoint
    $responseAuthors = file_get_contents($authorurl);

    // Parse the JSON response
    $dataAuthors = json_decode($responseAuthors, true);

    // Extract the 'author_id' and 'author_name' columns from the data
    $authorIdColumn = array_column($dataAuthors, 'author_id');
    $authorNameColumn = array_column($dataAuthors, 'author_name');

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

/*
function getPublicationsContributors($conn) {
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
*/

// getting the number of authors with most contributions in ip assets
function getIpAssetsContributors($ipassetsurl, $authorurl) {
    $responseIpAssets = file_get_contents($ipassetsurl);

    // Parse the JSON response
    $dataIpAssets = json_decode($responseIpAssets, true);

    // Extract the 'authors' column from the data
    $authorsColumn = array_column($dataIpAssets, 'authors');

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
    $authorIdColumn = array_column($dataAuthors, 'author_id');
    $authorNameColumn = array_column($dataAuthors, 'author_name');

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

/*
function getIpAssetsContributors($conn) {
    $sql = "SELECT * FROM table_authors ORDER BY author_id ASC";
    $result = pg_query($conn, $sql);

    if(pg_num_rows($result) > 0){
        $contributors = array();
        while ($row = pg_fetch_assoc($result)) {

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
*/

// getting the most cited articles in publications

function getMostViewedPapers($publicationurl) {
    // Step 1: Send GET request to the API endpoint
    $response = file_get_contents($publicationurl);

    // Step 2: Parse JSON response and extract 'number_of_citation' and 'title_of_paper' values
    $data = json_decode($response, true);
    $citations = array_column($data, 'number_of_citation');
    $titles = array_column($data, 'title_of_paper');

    // Step 3: Sort the 'number_of_citation' values in descending order while maintaining the corresponding 'title_of_paper' values
    array_multisort($citations, SORT_DESC, $titles);

    // Step 4: Generate the HTML table with 'title_of_paper' and 'number_of_citation'
    $output = "<table>";
    $output .= "<tr><th>Title of Paper</th><th>Number of Citations</th></tr>";

    $topFour = array_slice($titles, 0, 4);
    foreach ($topFour as $index => $title) {
        $citation = $citations[$index];
        $output .= "<tr><td>".$title."</td><td>".$citation."</td></tr>";
    }

    $output .= "</table>";

    echo $output;
}

// function getMostViewedPapers($conn, $reuse_stmt = false) {
//     $sql = "SELECT title_of_paper, number_of_citation FROM table_publications WHERE number_of_citation IS NOT NULL ORDER BY number_of_citation DESC LIMIT 4;";
//     if (!$reuse_stmt) {
//         $stmt = pg_prepare($conn, "get_most_viewed_papers", $sql);
//     }
//     $result = pg_execute($conn, "get_most_viewed_papers", array());

//     $output = "<table>";
//     $output .= "<tr><th>Title of Paper</th><th>Number of Citations</th></tr>";
//     while ($row = pg_fetch_assoc($result)) {
//         $output .= "<tr><td>".$row['title_of_paper']."</td><td>".$row['number_of_citation']."</td></tr>";
//     }
//     $output .= "</table>";

//     return $output;
// }

// getting the number of published articles
function getPublishedIPAssets($ipassetsurl) {
    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $ipassetsurl);

    // Set the option to return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        echo "Failed to retrieve data from the endpoint.";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Parse the JSON response
    $data = json_decode($response, true);

    // Check if the JSON was parsed successfully
    if ($data === null) {
        echo "Failed to parse JSON response.";
        return false;
    }

    // Get the number of published IP assets from the response
    $publishedIPAssetCount = count($data['table_ipassets']);

    return $publishedIPAssetCount;
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

// function getRecentIpAssets($conn, $limit) {
//     $query = "SELECT title_of_work, date_registered FROM table_ipassets WHERE date_registered IS NOT NULL ORDER BY date_registered DESC LIMIT $1";
//     $params = array($limit);

//     $query_run = pg_prepare($conn, "recent_assets_query", $query);
//     if(!$query_run) {
//         echo "Prepared statement creation failed: " . pg_last_error($conn);
//     } else {
//         $result = pg_execute($conn, "recent_assets_query", $params);
//         if(!$result) {
//             echo "Query execution failed: " . pg_last_error($conn);
//         } else {
//             $rows = pg_fetch_all($result);
//             if(!$rows) {
//                 echo "<p>No data found</p>";
//             } else {
//                 echo "<table>";
//                 echo "<tr><th>Title</th><th>Date Registered </th></tr>";    
//                 foreach($rows as $row) {
//                     $date = date('F d, Y', strtotime($row['date_registered']));
//                     echo "<tr><td>".$row['title_of_work']."</td><td>".$date."</td></tr>";
//                 }
//                 echo "</table>";
//             }
//         }
//     }
// }
// getting the ip assets per campus
function getIpAssetsCampus($conn) {
    $query = "SELECT campus, COUNT(*) as dataset FROM table_ipassets WHERE campus IS NOT NULL GROUP BY campus";
    $result = pg_query($conn, $query);

    $data = array();
    $labels = array();
    while ($row = pg_fetch_assoc($result)) {
        $labels[] = $row["campus"];
        $data[] = intval($row["dataset"]);
    }

    return array(
        "data" => json_encode($data),
        "labels" => json_encode($labels)
    );
}
// getting the type of publication in table publication
function getPublicationType($conn){
    $query = "SELECT type_of_publication, COUNT(*) as dataset FROM table_publications WHERE type_of_publication is NOT NULL GROUP BY type_of_publication";
    $result = pg_query($conn, $query);

    $data = array();
    $labels = array();
    while ($row = pg_fetch_assoc($result)) {
        $labels[] = $row["type_of_publication"];
        $data[] = intval($row["dataset"]);
    }

    return array(
        "data" => json_encode($data),
        "labels" => json_encode($labels)
    );

}
// getting the number ip assets per year
function getIPAssetsPerYear($conn) {
    $query = "SELECT EXTRACT(YEAR FROM date_registered) AS year, COUNT(*) AS count
    FROM table_ipassets
    WHERE date_registered IS NOT NULL
    GROUP BY EXTRACT(YEAR FROM date_registered)
    ORDER BY EXTRACT(YEAR FROM date_registered) ASC;
    ";
    $result = pg_query($conn, $query);

    $year = array();
    $year_data = array();

    if (pg_num_rows($result) > 0) {
        while($data = pg_fetch_array($result)){
            $year[] = $data['year'];
            $year_data[] = intval($data['count']);
        }
    }

    $ipyear_data = json_encode($year_data);
    $ipyear_labels = json_encode($year);

    return array(
        'data' => $ipyear_data,
        'labels' => $ipyear_labels
    );
}
// getting the number of publicatons per year 
function getPublicationsPerYear($conn) {
    $query = "SELECT EXTRACT(YEAR FROM date_published) AS year, COUNT(*) AS count
    FROM table_publications
    WHERE date_published IS NOT NULL
    GROUP BY EXTRACT(YEAR FROM date_published)
    ORDER BY EXTRACT(YEAR FROM date_published) ASC;
    ";
    $result = pg_query($conn, $query);

    $year = array();
    $year_data = array();

    if (pg_num_rows($result) > 0) {
        while($data = pg_fetch_array($result)){
            $year[] = $data['year'];
            $year_data[] = intval($data['count']);
        }
    }

    $publications_year = json_encode($year);
    $publications_data = json_encode($year_data);

    return array(
        'data' => $publications_data,
        'labels' => $publications_year
    );
}
?>