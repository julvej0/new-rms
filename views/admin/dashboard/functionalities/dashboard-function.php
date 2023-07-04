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


// getting the number of authors with most contributions in publications

function getPublicationsContributors($authorurl, $publicationurl) {

    $responsePublications = file_get_contents($publicationurl);

    $dataPublications = json_decode($responsePublications, true);

    $authorsColumn = array_column($dataPublications['table_publications'], 'authors');

    $authorCounts = array();

    foreach ($authorsColumn as $authors) {
        $authorIds = explode(',', $authors);

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

    arsort($authorCounts);

    $top9Authors = array_slice($authorCounts, 0, 9, true);

    $responseAuthors = file_get_contents($authorurl);

    $dataAuthors = json_decode($responseAuthors, true);

    $authorIdColumn = array_column($dataAuthors['table_authors'], 'author_id');
    $authorNameColumn = array_column($dataAuthors['table_authors'], 'author_name');

    $authorMapping = array_combine($authorIdColumn, $authorNameColumn);

    $contributors = array();

    foreach ($top9Authors as $authorId => $count) {
        if (isset($authorMapping[$authorId])) {
            $authorName = $authorMapping[$authorId];
            $contributors[] = array(
                'author_name' => $authorName,
                'total_publications' => $count
            );
        }
    }

    usort($contributors, function($a, $b) {
        return $b['total_publications'] - $a['total_publications'];
    });

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

// getting the number of authors with most contributions in ip assets


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

// getting the most cited articles in publications

function getMostViewedPapers($publicationurl) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $publicationurl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        return "cURL Error: " . $error;
    }

    curl_close($curl);
    
    $data = json_decode($response, true);

    $citationData = array_column($data['table_publications'], 'number_of_citation', 'title_of_paper');

    arsort($citationData); // Sort the citations in descending order

    $topCitations = array_slice($citationData, 0, 4, true); // Preserve the keys in the resulting array

    $output = "<table>";
    $output .= "<tr><th>Title of Paper</th><th>Number of Citations</th></tr>";

    foreach ($topCitations as $title => $citation) {
        $output .= "<tr><td>" . $title . "</td><td>" . $citation . "</td></tr>";
    }

    $output .= "</table>";

    echo $output;
}

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