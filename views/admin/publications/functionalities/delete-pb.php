<?php
    include_once "dbcon.php";

    $pubId = $_GET['publication_id'];

    $pubDelete = pg_query($conn, "DELETE FROM table_publications WHERE publication_id = '$pubId'");

    header("Location: ../try-publications.php");
?>