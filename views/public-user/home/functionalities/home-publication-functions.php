<?php
// getting the number o authors with most contributions in publications
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
//getting the number of recently added publications
function getRecentPublications($publicationurl) {
    // Step 1: Send GET request and receive the response
    $response = file_get_contents($publicationurl);

    // Step 2: Decode the JSON response into an array of publications
    $publications = json_decode($response, true);

    // Step 3: Sort the array by 'date_published' in descending order
    usort($publications, function($a, $b) {
        return strtotime($b['date_published']) - strtotime($a['date_published']);
    });

    // Step 4: Extract the top 4 most recent publications and their titles
    $top4Publications = array_slice($publications, 0, 4);

    // Output the top 4 publications and their titles in a table format
    echo "<table>";
    echo "<tr><th>Title</th><th>Date Published</th></tr>";    

    foreach ($top4Publications as $publication) {
        if (!empty($publication['date_published']) && strtotime($publication['date_published']) !== false) {
            $date = date('F d, Y', strtotime($publication['date_published']));
        } else {
            $date = "N/A";
        }
        echo "<tr><td>".$publication['title_of_paper']."</td><td>".$date."</td></tr>";
    }

    echo "</table>";
}

// function getRecentPublications($conn, $limit) {
//     $query = "SELECT title_of_paper, date_published
//     FROM table_publications
//     WHERE date_published IS NOT NULL
//     ORDER BY date_published DESC
//     LIMIT $1";
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
//                     if(!empty($row['date_published']) && strtotime($row['date_published']) !== false) {
//                         $date = date('F d, Y', strtotime($row['date_published']));
//                     } else {
//                         $date = "N/A";
//                     }
//                     echo "<tr><td>".$row['title_of_paper']."</td><td>".$date."</td></tr>";
//                 }
//                 echo "</table>";
//             }
//         }
//     }
// }
?>