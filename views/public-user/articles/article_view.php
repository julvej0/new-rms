<?php
include_once "../../../db/db.php";
$sql_data = "SELECT * FROM table_publications";
$sql_result = pg_query($conn, $sql_data);

while ($row = pg_fetch_assoc($sql_result)) {
    $pub_ID = $row['publication_id'];

if (isset($_GET[$pub_ID])) {
    echo $pub_ID;

}
}
?>