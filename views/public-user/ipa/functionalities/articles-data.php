<?php
include_once "../../../db/db.php";
include_once "articles-search-author.php";
require_once "config.php";




//number of records per page
$no_of_records_per_page = 10;

//offset
$offset = ($page_number-1) * $no_of_records_per_page;

$search = isset($_GET['search-table']) ? $_GET['search-table'] : '';

//Search Query
$sqlSearchQuery = "SELECT * 
                    FROM (
                        SELECT * 
                        FROM table_ipassets 
                        WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, status, certificate) ILIKE '%".rtrim($search)."%' ";


if (authorSearch($conn, $search_query) !== "empty_search" ) {
    $sqlSearchQuery .= authorSearch($conn, $search_query);
}

$sqlSearchQuery .= " )AS searched_pub WHERE 1=1 ";

if ($campus_query !== 'empty_campus') {

  $sqlSearchQuery.= "AND (";
  if(is_array($campus_query)){
    foreach ($campus_query as $campus){
      if ( $campus == $campus_query[0]){
        $sqlSearchQuery .= "  searched_pub.campus = '$campus' ";
      }
      else{
          $sqlSearchQuery .= " OR  searched_pub.campus = '$campus' ";
      }
      
    }

  }
  else{
    $sqlSearchQuery .= "  searched_pub.campus = '$campus_query' ";
  }
  
  $sqlSearchQuery .= ") ";
}
if ($dateStart_query !== 'empty_dStart' && $dateEnd_query !== 'empty_dEnd' ) {
  $sqlSearchQuery .= " AND EXTRACT(YEAR FROM searched_pub.date_registered) BETWEEN $dateStart_query AND $dateEnd_query";
}

if ($sort_query !== 'empty_sort') {
  if ($sort_query === 'date') {
    $sort_order = 'DESC'; // Sort by date in descending order
    $sort_column = 'date_registered';
  } elseif ($sort_query === 'campus') {
    $sort_order = 'ASC'; // Sort by campus in ascending order
    $sort_column = 'campus';
  } else {
    $sort_order = 'ASC'; // Sort by title (default)
    $sort_column = 'title_of_work';
  }
  $sqlSearchQuery .= " ORDER BY $sort_column $sort_order ";
}



$sqlSearchQuery .= " OFFSET $offset LIMIT $no_of_records_per_page";

$sql_result = pg_query($conn, $sqlSearchQuery);


  if ($sql_result && pg_num_rows($sql_result) > 0)  {
    ?>
    <table class='table'>
      <thead>
        <tr id='css-header-container'>
          <th class='css-header'> Title </th>
          <th class='css-header'> Date Registered </th>
          <th class='css-header'> Campus </th>
          <th class='css-header'> Authors </th>
        </tr>
      </thead>
    <?php

    $previous_row = null;
    while ($row = pg_fetch_assoc($sql_result)) {
      if ($previous_row && $row['registration_number'] === $previous_row['registration_number']) {
        // Skip this row since it belongs to the same publication as the previous row
        continue;
      }

      // Get all the authors for the publication
      $author_ids = explode(",", $row['authors']);
      $author_names = array();

      foreach ($author_ids as $author_id) {
        $author_id = trim($author_id);
        $sql_author_data = "SELECT author_name FROM table_authors WHERE author_id ILIKE '{$author_id}'";
        $sql_author_result = pg_query($conn, $sql_author_data);

        if ($sql_author_result && pg_num_rows($sql_author_result) > 0) {
          $author_row = pg_fetch_assoc($sql_author_result);
          $author_names[] = $author_row['author_name'];
        }
      }

      $author_implode = implode(', ', $author_names);

      $encrypted_ID = encryptor('encrypt', $row['registration_number']);
      ?>
      <tbody>
        <tr class='css-tr' onclick="window.location='ipa-view.php?ipID=<?=$encrypted_ID?>'">
          <td class='css-td'><?=$row['title_of_work'] != null ? $row['title_of_work'] : "N/A" ?></td>
          <td class='css-td'><?=$row['date_registered']  != null ? $row['date_registered'] : "N/A" ?></td>
          <td class='css-td'><?=$row['campus']  != null ? $row['campus'] : "N/A" ?></td>
          <td class='css-td'><?=$author_implode?></td>
        </tr>
      </tbody>
      <?php
      $previous_row = $row;
    }
    ?>
    </table>
    <?php
  }
  else {
    // No results found

    ?>
    <script>
      Swal.fire({
        icon: 'warning',
        title: 'No results found',
        text: 'Your search query did not match any records.',
        confirmButtonText: 'OK'
      }).then(() => {
        // Clear the search query and reload the page
        window.location.href = 'ipa.php';
      });
    </script>
    <?php
  }

?>
