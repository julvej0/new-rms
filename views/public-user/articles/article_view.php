<?php
include_once "../../../db/db.php";
require_once "functionalities/config.php";

if (isset($_GET['pubID']) && !empty($_GET['pubID'])) {
    $pubID = $_GET['pubID'];
    $decrypted_ID = encryptor('decrypt', $pubID);
    
    $sql_data = "SELECT * FROM table_publications WHERE publication_id = $1;";
    $params = array($decrypted_ID);
    $sql_result = pg_query_params($conn, $sql_data, $params);

    while ($row = pg_fetch_assoc($sql_result)) {
        echo $row['title_of_paper'];
    }
}

?>
