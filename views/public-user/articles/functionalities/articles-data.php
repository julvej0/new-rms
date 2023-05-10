<?php
include_once "../../../db/db.php";
require_once "config.php";

// Select or Retrieve Data from Database
$sql_data = "SELECT * FROM table_publications";
$sql_result = pg_query($conn, $sql_data);

if ($sql_result) {
  ?>
  <table id='css-table'>
  <tr id='css-header-container'>
  <th class='css-header'> Title </th>
  <th class='css-header'> Date Published </th>
  <th class='css-header'> Campus </th>
  <th class='css-header'> Author </th>
  </tr>
  <?php

  while ($row = pg_fetch_assoc($sql_result)) {
    // Get the author IDs from the publication row
    $author_ids = explode(',', $row['authors']);


    //other way around instead of using IN(operator) on selecting multiple values in a column.
    $conditions = [];
    foreach ($author_ids as $author_id) {
      $conditions[] = "author_id = '$author_id'";
    }

    $where_clause = implode(' OR ', $conditions);

    //check if the author ID from table_authors is simlar to authors column in table_publication
    $sql_author_data = "SELECT author_name FROM table_authors WHERE $where_clause";
    $sql_author_result = pg_query($conn, $sql_author_data);


    if ($sql_author_result) {
      $author_names = array();
      while ($author_row = pg_fetch_assoc($sql_author_result)) {
        $author_names[] = $author_row['author_name'];
      }
      $author_implode = implode(', ', $author_names);
    } else {
      $author_implode = ""; // Set an empty string if no author names found
    }
    $encrypted_ID = encryptor('encrypt',$row['publication_id']);
    ?>
    <tr class='css-tr' onclick="window.location='./article_view.php?pubID=<?=$encrypted_ID?>'">
      <td class='css-td'><?=$row['title_of_paper']?></td>
      <td class='css-td'><?=$row['date_published']?></td>
      <td class='css-td'><?=$row['campus']?></td>
      <td class='css-td'><?=$author_implode?></td>
    </tr>
    <tr id='spacer-row'></tr> <!-- Add a spacer row after each data row -->
  <?php
  }
  ?>

  </table>
  <?php
}
?>
