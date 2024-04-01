<script>
  function checkLoginCreds(encrypted_ID) {

    var request = new XMLHttpRequest();

    request.open("GET", "  ../check-login-creds.php", true);
    request.onreadystatechange = function () {
      if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
        var response = request.responseText;

        console.log(response);
        if (response == "true") {
          window.location = './ip-assets-view.php?ipID=' + encrypted_ID;
        } else {
          window.location = '../../../views/login/login.php?login=required';
        }
      }
    };
    request.send();
  }

</script>
<?php
include_once dirname(__FILE__, 5) . "/helpers/db.php";
include_once "articles-search-author.php";
require_once "config.php";
include_once "articles-get-info.php";

//number of records per page
$no_of_records_per_page = 10;

//offset
$offset = ($page_number - 1) * $no_of_records_per_page;

$search = $search_query != 'empty_search' ? $search_query : '';

//Search Query
// $sqlSearchQuery = "SELECT * 
//                     FROM (
//                         SELECT * 
//                         FROM table_ipassets 
//                         WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, status, certificate) ILIKE '%".rtrim($search)."%' ";


// if (authorSearch($conn, $search_query) !== "empty_search" ) {
//     $sqlSearchQuery .= authorSearch($conn, $search_query);
// }

// $sqlSearchQuery .= " )AS searched_pub WHERE 1=1 ";

// if ($campus_query !== 'empty_campus') {

//   $sqlSearchQuery.= "AND (";
//   if(is_array($campus_query)){
//     foreach ($campus_query as $campus){
//       if ( $campus == $campus_query[0]){
//         $sqlSearchQuery .= "  searched_pub.campus = '$campus' ";
//       }
//       else{
//           $sqlSearchQuery .= " OR  searched_pub.campus = '$campus' ";
//       }

//     }


//   }
//   else{
//     $sqlSearchQuery .= "  searched_pub.campus = '$campus_query' ";
//   }

//   $sqlSearchQuery .= ") ";
// }
// if ($dateStart_query !== 'empty_dStart' && $dateEnd_query !== 'empty_dEnd' ) {
//   $sqlSearchQuery .= " AND EXTRACT(YEAR FROM searched_pub.date_registered) BETWEEN $dateStart_query AND $dateEnd_query";
// }

// if ($sort_query !== 'empty_sort') {
//   if ($sort_query === 'title') {
//     $sort_order = 'ASC'; // Sort by title 
//     $sort_column = 'title_of_work';

//   } elseif ($sort_query === 'campus') {
//     $sort_order = 'ASC'; // Sort by campus in ascending order
//     $sort_column = 'campus';
//   } else {
//     $sort_order = 'DESC'; // Sort by date in descending order (default)
//     $sort_column = 'date_registered';

//   }
//   $sqlSearchQuery .= " ORDER BY $sort_column $sort_order ";
// }



// $sqlSearchQuery .= " OFFSET $offset LIMIT $no_of_records_per_page";

// $sql_result = pg_query($conn, $sqlSearchQuery);


$searchQuery = get_data($search, $sort_query, $dateStart_query, $dateEnd_query, $campus_query);
if ($searchQuery != null && count($searchQuery) > 0) {
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
    foreach ($searchQuery as $row) {
      if ($previous_row && $row['registration_number'] === $previous_row['registration_number']) {
        // Skip this row since it belongs to the same publication as the previous row
        continue;
      }

      // Get all the authors for the publication
      $author_names = $row['authors'];
      $encrypted_ID = encryptor('encrypt', $row['registration_number']);
      ?>
      <tbody>
        <tr class='css-tr' onclick='<?= $encrypted_ID != null ? 'checkLoginCreds("' . $encrypted_ID . '")' : '' ?>'>
          <td class='css-td'>
            <?= $row['title_of_work'] != null ? $row['title_of_work'] : "N/A" ?>
          </td>
          <td class='css-td'>
            <?= $row['date_registered'] != null ? $row['date_registered'] : "N/A" ?>
          </td>
          <td class='css-td'>
            <?= $row['campus'] != null ? $row['campus'] : "N/A" ?>
          </td>
          <td class='css-td'>
            <?= $author_names ?>
          </td>
        </tr>
      </tbody>

      <?php
      $previous_row = $row;
    }
    ?>
  </table>
  <?php
} else {
  // No results found
  ?>
  <p style="text-align: center;">No Records Found!</p>
  </table>
  <script>
    Swal.fire({
      icon: 'warning',
      title: 'No results found',
      text: 'Your search query did not match any records.',
      confirmButtonText: 'OK'
    }).then(() => {
      // Clear the search query and reload the page
      // window.location.href = 'ip-assets.php';
    });
  </script>
  <?php
}

?>