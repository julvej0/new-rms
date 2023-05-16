<?php

//retrieve all data from table_publications
$sql_data = "SELECT * FROM table_publications";
$sql_result = pg_execute($conn, $sql_data);

?>