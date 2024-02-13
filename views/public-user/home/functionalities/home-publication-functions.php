<?php
// getting the number o authors with most contributions in publications

function getPublicationsContributors($authorurl, $publicationurl) {
    // $context = stream_context_create(array(
    //     'http' => array('ignore_errors' => true),
    // ));
    
    // $responsePublications = file_get_contents($publicationurl, false, $context);
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


//getting the most cited articles in publications

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



// getting the number of recently added publications

function getRecentPublications($publicationurl) {
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

    $dateData = array_column($data['table_publications'], 'date_published', 'title_of_paper');

    arsort($dateData);

    $recentPublications = array_slice($dateData, 0, 3);

    $output = "<table>";
    $output .= "<tr><th>Title</th><th>Date Published</th></tr>";

    foreach ($recentPublications as $paperTitle => $publisheddate) {
        $formattedDate = date('F d, Y', strtotime($publisheddate));
        $output .= "<tr><td>" . $paperTitle . "</td><td>" . $formattedDate . "</td></tr>";
    }

    $output .= "</table>";

    echo $output;

}

?>