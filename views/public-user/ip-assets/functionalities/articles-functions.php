<?php
require_once "config.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-author.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-ipasset.php";

function getIpassetsData($pubID, $ipassetsurl, $authorurl)
{
    $decrypted_ID = encryptor('decrypt', $pubID);
    $data = getIpAssetById($ipassetsurl, $decrypted_ID);
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

function displayIpassetsData($row, $authorurl)
{
    echo '<div class="article-container">';
    echo '<div class="article-title">';
    echo '<h1>' . $row['title_of_work'] . '</h1>';
    echo '</div>';

    echo '<div class="article-date-published">';
    if (!empty($row['date_registered'])) {
        $date = date('F d, Y', strtotime($row['date_registered']));
        echo '<h5>Date Registered:  ' . $date . '</h5>';
    } else {
        echo '<h5>Date Published: Not Yet Set </h5>';
    }
    echo '</div>';

    echo '<div class="author-list-cont">';
    $author_ids = explode(',', $row['authors']);
    $author_names = array();
    $author_emails = array();
    foreach ($author_ids as $author_id) {

        $author_data = getAuthorById($authorurl, $author_id);
        if ($author_data != null) {
            $author_names[] = $author_data['author_name'] ?? "Not Avaiable";
            $author_emails[] = $author_data['email'] ?? "Not Availble";
        }
    }
    if (count($author_names) > 0) {
        // Join the author names and display them
        echo '<div class="article-authors">Authors: ';
        echo implode(', ', $author_names);
        echo '</div>';
    } else {
        // Display only the label "Authors:"
        echo '<div class="article-authors">No authors found.</div>';
    }
    echo '</div>';
    echo '<div class="content-title">';
    echo '<label class="abstract">Campus: ';
    echo  $row['campus'] ?? "Not Available";
    echo '</label>';
    echo '</div>';
    echo '<div class="abstract-cont">';
    echo '<div>';
    echo '<label>Status: '; 
    if (!empty($row['status'])) {
        $abstract = $row['status'];
        echo $abstract ;
    } else {
        echo 'Not Yet Set';
    }
    echo '</label>';
    echo '</div>';
    echo '<button onclick="window.open(\'' . $row['hyperlink'] . '\', \'_blank\')" class="download-cert-btn">CERTIFICATION</button>';
    echo '</div>';
    echo '</div>';
}
?>