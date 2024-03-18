<?php
include_once "../../../helpers/db.php";

//check if the session is an author
if (isset ($_SESSION['user_email'])) {
    $author_email = $_SESSION['user_email'];

    include_once dirname(__FILE__, 5) . '/helpers/db.php';
    include_once dirname(__FILE__, 4) . '/helpers/utils/utils-author.php';
    $author_data = getAuthorByEmail($authorurl, $author_email);

    if ($author_data == null) {
        echo "An error occurred.";
        exit;
    }

    $author_user = $author_data;

    if (!$author_user) {
        echo 'Author not found.';
        exit;
    }

    // $author_data = "SELECT * FROM table_authors WHERE email = '$author_session'";
    // $author_data_result = pg_query($conn, $author_data);

    // if (!$author_data_result) {
    // echo "An error occurred: " . pg_last_error($conn);
    // exit;
    // }

    // $author_user = pg_fetch_assoc($author_data_result);

    // if (!$author_user) {
    // echo "Author not found.";
    // exit;
    // }
}

?>