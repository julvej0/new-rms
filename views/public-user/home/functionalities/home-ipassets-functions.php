<?php
// getting the number o authors with most contributions in ip assets

function getIpAssetsContributors($ipassetsurl, $authorurl) {
    $responseIpAssets = file_get_contents($ipassetsurl);

    $dataIpAssets = json_decode($responseIpAssets, true);

    $authorsColumn = array_column($dataIpAssets['table_ipassets'], 'authors');

    $authorCounts = array();

    foreach ($authorsColumn as $authors) {
        $authorNames = explode(', ', $authors);

        foreach ($authorNames as $authorName) {
            $authorName = trim($authorName); // Remove leading/trailing whitespaces
            if (!empty($authorName)) {
                if (isset($authorCounts[$authorName])) {
                    $authorCounts[$authorName]++;
                } else {
                    $authorCounts[$authorName] = 1;
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

    $authorMapping = array_combine($authorNameColumn, $authorIdColumn);

    $contributors = array();

    foreach ($top9Authors as $authorId => $count) {
        if (isset($authorMapping[$authorId])) {
            $contributors[] = array(
                'author_name' => $authorId,
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

//getting the number of most ip assets by campuses


function getTopCampus($ipassetsurl) {
    $datacampus = file_get_contents($ipassetsurl);
    $dataIpAssets = json_decode($datacampus, true);
    $campusColumn = array_column($dataIpAssets['table_ipassets'], 'campus');

    $campusCounts = array();

    foreach ($campusColumn as $campus){
        if (!empty($campus)) {
            if (isset($campusCounts[$campus])) {
                $campusCounts[$campus]++;
            } else {
                $campusCounts[$campus] = 1;
            }
        }
    }

    $topCampuses = array_slice($campusCounts, 0, 9, true);

    $campuses = array();

    foreach ($topCampuses as $campusName => $count) {
        if (isset($campusName)) {
            $campuses[] = array(
                'campus_name' => $campusName,
                'total_ipassets' => $count
            );
        }
    }

    usort($campuses, function($a, $b) {
        return $b['total_ipassets'] - $a['total_ipassets'];
    });

    $PBcount = 0;
    foreach ($campusColumn as $campus) {
        if ($campus === 'Pablo Borbon') {
            $PBcount++;
        }
    }
    $Alcount = 0;
    foreach ($campusColumn as $campus) {
        if ($campus === 'Alangilan') {
            $Alcount++;
        }
    }
    $Nacount = 0;
    foreach ($campusColumn as $campus) {
        if ($campus === 'Nasugbu') {
            $Nacount++;
        }
    }
    // Alangilan
    // Nasugbu
    // Pablo Borbon
    // Lemery
    // Lipa
    // Lobo
    // Balayan
    // Mabini
    // Malbar
    // Padre Garcia
    // Rosario
    // San Juan

    // echo "<table>";
    // echo "<tr><th>Campus</th><th>Number of IP Assets</th></tr>";
    // echo "<tr><td>Pablo Borbon</td><td>".$PBcount."</td></tr>";
    // echo "<tr><td>Alangilan</td><td>".$Alcount."</td></tr>";
    // echo "<tr><td>Nasugbu</td><td>".$Nacount."</td></tr>";
    // echo "</table>";
    $count = 0;
    ?> 
    <table>
        <tr>
            <th>Campus</th>
            <th>Number of IP Assets</th>
        </tr>
        <?php foreach ($campuses as $campus) {
            $count++;
            if ($count > 9) {
                break;
            }
        ?>
            <tr>
                <td><?= $campus['campus_name']; ?></td>
                <td><?= $campus['total_ipassets']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
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