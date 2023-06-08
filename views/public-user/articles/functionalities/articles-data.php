<script>
  function checkLoginCreds(encrypted_ID){

    var request = new XMLHttpRequest();

    request.open("GET","  ../check-login-creds.php", true);
    request.onreadystatechange = function(){
      if (request.readyState === XMLHttpRequest.DONE && request.status===200) {
        var response = request.responseText;

        console.log(response);
        if(response == "true"){
          window.location='./article_view.php?pubID='+ encrypted_ID;
        }else{
          window.location = '../../../views/login/login.php?login=required';
        }
      }
    };

    request.send();   
  }
          
</script>

<?php
include dirname(__FILE__, 5) . '/helpers/db.php';
include_once "articles-search-author.php";
require_once "config.php";


//number of records per page
$no_of_records_per_page = 10;

//offset
$offset = ($page_number-1) * $no_of_records_per_page;

$search = $search_query != 'empty_search' ? $search_query : '';

//Search Query
$sqlSearchQuery = "SELECT * 
                    FROM (
                        SELECT * 
                        FROM table_publications 
                        WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%".trim($search)."%' ";



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
  $sqlSearchQuery .= " AND EXTRACT(YEAR FROM searched_pub.date_published) BETWEEN $dateStart_query AND $dateEnd_query";
}

if ($sort_query !== 'empty_sort') {
  if ($sort_query === 'title') {
    $sort_order = 'ASC'; // Sort by title 
    $sort_column = 'title_of_paper';
  } elseif ($sort_query === 'campus') {
    $sort_order = 'ASC'; // Sort by campus in ascending order
    $sort_column = 'campus';
  } else {
    
    $sort_column = 'date_published';
    $sort_order = 'DESC'; // Sort by date in descending order (default)
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
          <th class='css-header'> Date Published </th>
          <th class='css-header'> Campus </th>
          <th class='css-header'> Authors </th>
        </tr>
      </thead>
      
    <?php

    $previous_row = null;
    while ($row = pg_fetch_assoc($sql_result)) {
      if ($previous_row && $row['publication_id'] === $previous_row['publication_id']) {
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

      $encrypted_ID = encryptor('encrypt', $row['publication_id']);
      ?>
       <!-- <button onclick="checkLoginCreds()">check</button> -->
      <tbody>

          <tr class='css-tr' onclick='<?=$encrypted_ID != null ? 'checkLoginCreds("'.$encrypted_ID.'")' : '' ?>'>
          <td class='css-td'><?=$row['title_of_paper'] != null ? $row['title_of_paper'] : "N/A" ?></td>
          <td class='css-td'><?=$row['date_published']  != null ? $row['date_published'] : "N/A" ?></td>
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
        window.location.href = 'articles.php';
      });


    </script>
    <?php
  }

?>

      
      