<?php
include_once "../../../db/db.php";

//check if the session is an author
if (isset($_SESSION['user_email'])) {
    $author_session = $_SESSION['user_email'];

    $author_data = "SELECT * FROM table_authors WHERE email = '$author_session'";
    $author_data_result = pg_query($conn, $author_data);

    if (!$author_data_result) {
        echo "An error occurred: " . pg_last_error($conn);
        exit;
    }

    $author_user = pg_fetch_assoc($author_data_result);

    if (!$author_user) {
        echo "Author not found.";
        exit;
    }
}

?>
