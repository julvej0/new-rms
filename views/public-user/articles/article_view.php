<?php
include_once "../../../db/db.php";
require_once "functionalities/config.php";

if (isset($_GET['pubID']) && !empty($_GET['pubID'])) {
    $pubID = $_GET['pubID'];
    $decrypted_ID = encryptor('decrypt',$pubID);

    $sql_data = "SELECT * FROM table_publications WHERE publication_id = $1;";
    $stmt = pg_prepare($conn, "get_publication_by_id", $sql_data);
    $result = pg_execute($conn, "get_publication_by_id", array($decrypted_ID));

    while ($row = pg_fetch_assoc($result)) {
        echo $row['title_of_paper'];
    }
}
?>
