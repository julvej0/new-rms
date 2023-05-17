<?php
include_once '../../../../../db/db.php';
if (isset($_POST['updatePB'])) {
    $date_published = $_POST["date_published"];
    $date_published = isset($_POST['date_published']) ? $_POST['date_published'] : null;
    if (!$date_published) {
        $date_published = null;
    }else{
        $date_published = $_POST["date_published"];
    }

    $if_funded = isset($_POST['funding_type']) ? $_POST['funding_type'] : null;
    if (!$if_funded) {
        $if_funded = "";
    }else{
        $if_funded = $_POST["funding_type"];
    }

    $authors = isset($_POST['author_name']) ? $_POST['author_name'] : null;
    if (!$authors) {
        $authors = "";
        $authors_string = ""; // join the array values with a comma delimiter
    }else{
        $author_name = $_POST["author_name"];

        $select_query = "SELECT author_id FROM table_authors WHERE author_name = $1 ";
        $select_stmt = pg_prepare($conn, "select_author_details", $select_query);
        
        $author_ids = array(); // Define the array outside the loop
        
        foreach ($author_name as $name) {
            $auth_name = pg_escape_string($conn, $name);
            $sql = "INSERT INTO table_authors (author_name)
                    SELECT '$name'
                    WHERE NOT EXISTS (SELECT 1 FROM table_authors WHERE author_name = '$name')";
            pg_query($conn, $sql);
        
            $select_result = pg_execute($conn, "select_author_details", array($name));
        
            while ($row = pg_fetch_assoc($select_result)) {
                $author_ids[] = $row['author_id'];
            }
        }
        
        $authors_string = implode(",", $author_ids);
    }

    $quartile = $_POST["pb-quartile"];
    $pubID = $_POST['pubID'];
    $department = $_POST["research_area"]; 
    $college = $_POST["college"];
    $campus = $_POST["campus"];
    $title = $_POST["title_of_paper"];
    $type = $_POST["type_of_publication"];
    $url = $_POST["google_scholar_details"];
    $sdg = $_POST["sdg_no"];
    $funding_nature = $_POST["nature_of_funding"];
    $publisher = $_POST["publisher"];
    $abstract = $_POST["abstract"];

    $sdg_string = implode(", ", $sdg);

    if ($if_funded == "internal") {
        $if_external = "BatState-U Research Fund";
      } else {
        $if_external = isset($_POST['funding_source']) ? $_POST['funding_source'] : null;
        if (!$if_external) {
            $if_external = "";
        }else{
            $if_external = $_POST["funding_source"];
        }
      }


    // Create SQL UPDATE statement
    $update_query = "UPDATE table_publications SET title_of_paper=$1, type_of_publication=$2, publisher=$3, department=$4, college=$5, quartile=$6, campus=$7, sdg_no=$8, date_published=$9, google_scholar_details=$10, authors=$11, nature_of_funding=$12, funding_type=$13, funding_source=$14, abstract=$15 WHERE publication_id=$16";

    // Prepare the SQL statement
    $update_stmt = pg_prepare($conn, "update_pb_details", $update_query);

    // Execute the prepared statement with the input values
    $update_result = pg_execute($conn, "update_pb_details", array($title, $type, $publisher, $department, $college, $quartile, $campus, $sdg_string, $date_published, $url, $authors_string, $funding_nature, $if_funded, $if_external, $abstract, $pubID));

    if (!$update_result) {
        die("Error in SQL query: " . pg_last_error());
    }

    // Check if the update was successful
    if (pg_affected_rows($update_result) > 0) {
        header("Location: ../../publications.php?update=applied");
    } else {
        header("Location: ../../publications.php?update=!update");
    }
} else {
    header("Location: ../../publications.php");
}

?>