<?php
// Replace 'your_host', 'your_user', 'your_password', and 'your_database' with the appropriate values for your database connection
incl

// Check if the connection was successful
if (!$connection) {
  die('Connection failed: ' . pg_last_error());
}

// Select all the rows from the 'table_publications' table
$sql = "SELECT * FROM table_publications";
$result = pg_query($connection, $sql);

// Check if the query was successful
if (!$result) {
  die('Query failed: ' . pg_last_error());
}

// Loop through the rows and display the data in an HTML table
echo '<table>';
echo '<tr><th>Title</th><th>Column2</th><th>Column3</th><th>Column4</th></tr>';

while ($row = pg_fetch_assoc($result)) {
  echo '<tr>';
  echo '<td>' . $row['title_of_paper'] . '</td>';
  echo '<td>' . $row['column2'] . '</td>';
  echo '<td>' . $row['column3'] . '</td>';
  echo '<td>' . $row['column4'] . '</td>';
  echo '</tr>';
}

echo '</table>';

// Close the connection
pg_close($connection);
?>
