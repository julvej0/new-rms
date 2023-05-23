<?php
require_once "config.php";

function getPublicationData($pubID, $conn) {
    $decrypted_ID = encryptor('decrypt', $pubID);
    
    $sql_data = "SELECT tp.*, ta.author_name FROM table_publications tp
                 JOIN table_authors ta ON ta.author_id = ta.author_id
                 WHERE tp.publication_id = $1;";
    $params = array($decrypted_ID);
    $sql_result = pg_query_params($conn, $sql_data, $params);

    return pg_fetch_assoc($sql_result);
}

function displayPublicationData($row, $conn) {
    echo '<div class="article-container">';
    echo '<div class="article-title">';
    echo "<h1 id='header-title'>".$row['title_of_paper']."</h1>";
    echo '</div>';


    echo '<div class="author-list-cont">';
    $author_ids = explode(',', $row['authors']);
    $author_names = array();
    foreach ($author_ids as $author_id) {
        $fetch_author_data = pg_query($conn, "SELECT author_name FROM table_authors WHERE author_id = '$author_id'");
        $author_data = pg_fetch_assoc($fetch_author_data);
        if ($author_data) {
            $author_names[] = $author_data['author_name'];
        }
    }
    if (count($author_names) > 0) {
        // Join the author names and display them
        echo '<div class="article-authors">';
        echo implode(', ', $author_names);
        echo '</div>';
    } else {
        // Display only the label "Authors:"
        echo '<label>Authors:</label>';
    }
    echo '</div>';

    echo '<div class="article-date-published">';
    if (!empty($row['date_published'])) {
        $date = date('F d, Y', strtotime($row['date_published']));
        echo '<h5>Date Published:  '. $date . '</h5>';
    }
    else {
        echo '<h5>Date Published: Not Yet Set </h5>';
    }
    echo '</div>';
    echo '<div class="content-title">';
    echo '<label class="abstract">Abstract</label>';
    echo '</div>';
    echo '<div class="abstract-cont">';
    echo '<div>';
    if (!empty($row['abstract'])){
        $abstract = $row['abstract'];
        echo '<p>' .$abstract. '</p>';
    }
    else{
        echo '<p> Not Yet Set </p>';
    }

    echo '</div>';
    echo '<button onclick="window.open(\'' . $row['google_scholar_details'] . '\', \'_blank\')" class="download-cert-btn">GOOGLE SCHOLAR DETAILS</button>';
    echo '</div>';
    echo '</div>';
}


?>
