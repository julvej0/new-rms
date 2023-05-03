<?php
include_once '../../../../db/db.php';

    if(isset($_POST['id'])){

    $pubId = $_POST['id'];

    $pubDelete = pg_query($conn, "DELETE FROM table_publications WHERE publication_id = '$pubId'");
    };
?>