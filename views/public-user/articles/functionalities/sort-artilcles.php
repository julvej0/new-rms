<?php
include_once "../../../db/db.php";


//retrieve all the data in table_publications

$sql_data = "SELECT * FROM table_publications";
$sql_result = pg_execute($conn, $sql_data);




?>