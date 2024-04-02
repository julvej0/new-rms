<?php
require_once "config.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-author.php";

function getPublicationData($pubID, $publicationurl, $authorurl)
{
    $decrypted_ID = encryptor('decrypt', $pubID);
    $data = getPublicationById($publicationurl, $decrypted_ID);
    $authors = getAuthors($authorurl);
    $authorList = "";
    if ($data['authors']) {
        $authorData = explode(",", $data['authors']);
        foreach ($authorData as $index => $rowData) {
            foreach ($authors as $index => $author) {
                if ($rowData == $author['author_id']) {
                    $authorList .= (strlen($authorList) > 1 ? ", " : "") . $author['author_name'];
                    break;
                }
            }
        }
    }
    $data[0]['authors'] = $authorList;
    return $data;
}

function displayPublicationData($row, $authorurl)
{
    echo '<div class="article-container">';
    echo '<div class="article-title">';
    echo "<h1 id='header-title'>" . $row['title_of_paper'] . "</h1>";
    echo '</div>';


    echo '<div class="author-list-cont">';
    $author_ids = explode(',', $row['authors']);
    $author_names = array();
    foreach ($author_ids as $author_id) {
        $author_data = getAuthorById($authorurl, $author_id);
        if ($author_data != null) {
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
        echo '<h5>Date Published:  ' . $date . '</h5>';
    } else {
        echo '<h5>Date Published: Not Yet Set </h5>';
    }
    echo '</div>';
    echo '<div class="content-title">';
    echo '<label class="abstract">Abstract</label>';
    echo '</div>';
    echo '<div class="abstract-cont">';
    echo '<div>';
    if (!empty($row['abstract'])) {
        $abstract = $row['abstract'];
        echo '<p>' . $abstract . '</p>';
    } else {
        echo '<p> Not Yet Set </p>';
    }

    echo '</div>';
    echo '<button onclick="window.open(\'' . $row['google_scholar_details'] . '\', \'_blank\')" class="download-cert-btn">GOOGLE SCHOLAR DETAILS</button>';
    echo '</div>';
    echo '</div>';
}


?>