<?php
include_once "../../../db/db.php";
require_once "config.php";
?>
<!-- Add this JavaScript code before the table rendering -->
<script>
// Check if local storage is supported by the browser
if (typeof(Storage) !== "undefined") {
  // Check if the data is already stored in local storage
  var localStorageKey = "articleData";
  var cachedData = localStorage.getItem(localStorageKey);

  if (cachedData) {
    // Parse the cached data
    var articles = JSON.parse(cachedData);
    renderTable(articles); // Call the renderTable function with the cached data
  } else {
    // Fetch data from the server
    fetch("fetch_data.php")
      .then(response => response.json())
      .then(data => {
        // Store the data in local storage
        localStorage.setItem(localStorageKey, JSON.stringify(data));
        renderTable(data); // Call the renderTable function with the fetched data
      })
      .catch(error => {
        console.error("Error fetching data:", error);
      });
  }
} else {
  // Local storage is not supported
  console.log("Local storage is not supported by the browser");
}

// Function to render the table
function renderTable(data) {
  if (data && data.length > 0) {
    var table = document.getElementById("css-table");
    var tbody = table.getElementsByTagName("tbody")[0];
    
    // Clear the table body
    while (tbody.firstChild) {
      tbody.removeChild(tbody.firstChild);
    }
    
    // Loop through the data and create table rows
    for (var i = 0; i < data.length; i++) {
      var row = data[i];
      
      // Create table cells for each column
      var titleCell = document.createElement("td");
      titleCell.className = "css-td";
      titleCell.textContent = row.title_of_paper;
      
      var dateCell = document.createElement("td");
      dateCell.className = "css-td";
      dateCell.textContent = row.date_published;
      
      var campusCell = document.createElement("td");
      campusCell.className = "css-td";
      campusCell.textContent = row.campus;
      
      var authorsCell = document.createElement("td");
      authorsCell.className = "css-td";
      authorsCell.textContent = row.author_names.join(", ");
      
      // Create a table row and append the cells
      var tableRow = document.createElement("tr");
      tableRow.className = "css-tr";
      tableRow.onclick = function() {
        var encryptedID = encryptor("encrypt", row.publication_id);
        window.location = "./article_view.php?pubID=" + encryptedID;
      };
      
      tableRow.appendChild(titleCell);
      tableRow.appendChild(dateCell);
      tableRow.appendChild(campusCell);
      tableRow.appendChild(authorsCell);
      
      // Append the row to the table body
      tbody.appendChild(tableRow);
    }
  } else {
    // No results found
    var noResultsText = document.createElement("p");
    noResultsText.textContent = "Your search query did not match any records.";
    document.body.appendChild(noResultsText);
  }
}
</script>
<?php

if (isset($_GET['search-table'])) {
  // Sanitize the search query to prevent SQL injection
  $search_query = pg_escape_string($conn, $_GET['search-table']);

  // Select or Retrieve Data from Database with the search query
  $sql_data = "SELECT table_publications.*, table_authors.author_name
             FROM table_publications
             LEFT JOIN table_authors ON table_publications.authors LIKE '%' || table_authors.author_id || '%'
             WHERE (table_authors.author_name ILIKE '%$search_query%'
             OR table_publications.title_of_paper ILIKE '%$search_query%'
             OR table_publications.campus ILIKE '%$search_query%')";

  // Check if the search query is a valid year
  if (is_numeric($search_query)) {
      $sql_data .= " OR EXTRACT(YEAR FROM table_publications.date_published) = '$search_query'";
  }
} else {

  $sort_by = $_GET['sort'] ?? 'title'; // Get the sorting parameter, defaulting to 'title'

  // Select or Retrieve all Data from Database if no search query is set
  $sql_data = "SELECT table_publications.*, table_authors.author_name
               FROM table_publications
               LEFT JOIN table_authors ON table_publications.authors LIKE '%' || table_authors.author_id || '%' WHERE 1=1";
               

  // Date filtration based on the input values
  if (isset($_GET['date-start']) && isset($_GET['date-end'])) {
      $date_start = $_GET['date-start'];
      $date_end = $_GET['date-end'];

      // Check if both inputs are valid years
      if (is_numeric($date_start) && is_numeric($date_end)) {
          $sql_data .= " AND EXTRACT(YEAR FROM table_publications.date_published) BETWEEN $date_start AND $date_end";
      }
  }

  // Campus filtration based on the checked checkboxes
  if (isset($_GET['select-campus'])) {
    $campus = $_GET['select-campus'];

    if (in_array('All Campus', $campus)) {
        // If 'All Campus' is selected, no need to apply further filtering
    } else {
        $campus_conditions = array();

        foreach ($campus as $selected_campus) {
            $selected_campus = pg_escape_string($conn, $selected_campus);
            $campus_conditions[] = "table_publications.campus ILIKE '%$selected_campus%'";
        }

        $campus_query = implode(' OR ', $campus_conditions);
        $sql_data .= " AND ($campus_query)";

      }
  }


  // Set the sort order based on the sorting parameter
  if ($sort_by === 'date') {
    $sort_order = 'DESC'; // Sort by date in descending order
    $sort_column = 'date_published';
  } elseif ($sort_by === 'campus') {
    $sort_order = 'ASC'; // Sort by campus in ascending order
    $sort_column = 'campus';
  } else {
    $sort_order = 'ASC'; // Sort by title (default)
    $sort_column = 'title_of_paper';
  }

  $sql_data .= " ORDER BY $sort_column $sort_order";
 
}

$sql_result = pg_query($conn, $sql_data);


  if ($sql_result && pg_num_rows($sql_result) > 0)  {
    ?>
    <table id='css-table'>
    <tr id='css-header-container'>
    <th class='css-header'> Title </th>
    <th class='css-header'> Date Published </th>
    <th class='css-header'> Campus </th>
    <th class='css-header'> Authors </th>
    </tr>
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
      <tr class='css-tr' onclick="window.location='./article_view.php?pubID=<?=$encrypted_ID?>'">
        <td class='css-td'><?=$row['title_of_paper']?></td>
        <td class='css-td'><?=$row['date_published']?></td>
        <td class='css-td'><?=$row['campus']?></td>
        <td class='css-td'><?=$author_implode?></td>
      </tr>

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
