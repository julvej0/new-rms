<script>
  function checkLoginCreds(encrypted_ID) {

    var request = new XMLHttpRequest();

    request.open("GET", "  ../check-login-creds.php", true);
    request.onreadystatechange = function () {
      if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
        var response = request.responseText;

        if (response == "true") {
          window.location = './article_view.php?pubID=' + encrypted_ID;
        } else {
          window.location = '../../../views/login/login.php?login=required';
        }
      }
    };

    request.send();
  }

</script>

<?php
include dirname(__FILE__, 5) . '/helpers/db.php';
require_once "config.php";
include_once "articles-get-info.php";

//number of records per page
$no_of_records_per_page = 10;

//offset
$offset = ($page_number - 1) * $no_of_records_per_page;

$search = $search_query != 'empty_search' ? $search_query : '';

$searchQuery = get_data($search, $sort_query, $dateStart_query, $dateEnd_query, $campus_query);
if ($searchQuery != null && count($searchQuery) > 0) {
  ?>
  <table class='table'>
    <thead>
      <tr id='css-header-container'>
        <th class='css-header'> Title </th>
        <th class='css-header'> Date Published </th>
        <th class='css-header'> Campus </th>
        <th class='css-header'> Authors </th>
      </tr>
    </thead>

    <?php
    $previous_row = null;
    $searchQuery = array_slice($searchQuery, $offset, $no_of_records_per_page);
    foreach ($searchQuery as $row) {
      if ($previous_row && $row['publication_id'] === $previous_row['publication_id']) {
        // Skip this row since it belongs to the same publication as the previous row
        continue;
      }

      // Get all the authors for the publication
      $author_names = $row['authors'];
      $campuses = $campus_query == '' ? implode(", ", $campus_query) : $campus_query;
      $encrypted_ID = encryptor('encrypt', $row['publication_id']);
      ?>
      <!-- <button onclick="checkLoginCreds()">check</button> -->
      <tbody>
        <tr class='css-tr' onclick='<?= $encrypted_ID != null ? 'checkLoginCreds("' . $encrypted_ID . '")' : '' ?>'>
          <td class='css-td'>
            <?= $row['title_of_paper'] != null ? $row['title_of_paper'] : "N/A" ?>
          </td>
          <td class='css-td'>
            <?= $row['date_published'] != null ? $row['date_published'] : "N/A" ?>
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

  <script>
    Swal.fire({
      icon: 'warning',
      title: 'No results found',
      text: 'Your search query did not match any records.',
      confirmButtonText: 'OK'
    }).then(() => {
      // Clear the search query and reload the page
      // window.location.href = 'articles.php';
    });


  </script>
  <?php
}

?>