<?php
require_once "config.php";

function getPublicationData($pubID, $conn) {
    $decrypted_ID = encryptor('decrypt', $pubID);
    
    $sql_data = "SELECT ti.*, ta.author_name FROM table_ipassets ti
                 JOIN table_authors ta ON ta.author_id = ta.author_id
                 WHERE ti.registration_number = $1;";
    $params = array($decrypted_ID);
    $sql_result = pg_query_params($conn, $sql_data, $params);

    return pg_fetch_assoc($sql_result);
}

function displayPublicationData($row, $conn) {
    echo '<div class="article-container">';
    echo '<div class="article-title">';
    echo '<h1>'.$row['title_of_work'].'</h1>';
    echo '</div>';

    echo '<div class="article-date-published">';
    if (!empty($row['date_registered'])) {
        $date = date('F d, Y', strtotime($row['date_registered']));
        echo '<h5>Date Published:  '. $date . '</h5>';
    }
    else {
        echo '<h5>Date Published: Not Yet Set </h5>';
    }
    echo '</div>';

    echo '<div class="author-list-cont">';
    $author_ids = explode(',', $row['authors']);
    $author_names = array();
    foreach ($author_ids as $author_id) {
        $fetch_author_data = pg_query($conn, "SELECT author_name, email FROM table_authors WHERE author_id = '$author_id'");
        $author_data = pg_fetch_assoc($fetch_author_data);
        if ($author_data) {
            $author_names[] = $author_data['author_name'];
            $author_emails[] = $author_data['email'];
        }
    }
    if (count($author_names) > 0) {
        // Join the author names and display them
        echo '<label>Authors:</label>';
        echo '<div class="article-authors">';
        echo '&#8226 ';
        echo implode('<br>&#8226; ', $author_names);
        echo '</div>';
    } else {
        // Display only the label "Authors:"
        echo '<label>Authors:</label>';
    }
    echo '</div>';

    echo '<div class="abstract-cont">';
    echo '<div>';
    echo '<label>Status:</label>';
    if (!empty($row['status'])){
        $abstract = $row['status'];
        echo '<p>' .$abstract. '</p>';
    }
    else{
        echo '<p> Not Yet Set </p>';
    }
    echo '</div>';

    if(isset($_SESSION['user_email'])){
        foreach ($author_emails as $email){
        
            if($email==$_SESSION['user_email']){
                echo '<button onclick="window.open(\'' . $row['hyperlink'] . '\', \'_blank\')" class="download-cert-btn">CERTIFICATION</button>';
            }
    
        }

    }

    

   
    echo '</div>';
    echo '</div>';
}
?>
