<?php
include_once '../../../../../db/db.php';
if (isset($_POST['submitPB'])) {
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
    $sdg = $_POST["sdg_no"];
    $sdg_no = isset($_POST['sdg_no']) ? $_POST['sdg_no'] : null;
    if (!$sdg_no) {
        $sdg_no = null;
    }else{
        $sdg_no = $_POST["sdg_no"];
        $sdg_string = implode(", ", $sdg);
    }
    $quartile_sem = $_POST["quartile"];
    $quartile_year = $_POST["quartile_year"];
    $department = $_POST["research_area"]; 
    $college = $_POST["college"];
    $campus = $_POST["campus"];
    $title = $_POST["title_of_paper"];
    $type = $_POST["type_of_publication"];
    $url = $_POST["google_scholar_details"];
    $funding_nature = $_POST["nature_of_funding"];
    $publisher = $_POST["publisher"]; 
    $abstract = $_POST["abstract"];

    $authors_name = isset($_POST['author_name']) ? $_POST['author_name'] : null;
    if (!$authors_name) {
        $authors_name = "";
        $authors_string = "";
    } else {
        $select_query = "SELECT author_id FROM table_authors WHERE author_name = $1";
        $select_stmt = pg_prepare($conn, "select_author_details", $select_query);

        $author_ids = array(); // Define the array outside the loop

        foreach ($authors_name as $name) { // Change variable name from $author_name to $authors_name
            $auth_name = pg_escape_string($conn, $name);

            if (!empty($auth_name)) { // Check if the name is not empty
                $sql = "INSERT INTO table_authors (author_name)
                        SELECT '$auth_name'
                        WHERE NOT EXISTS (SELECT 1 FROM table_authors WHERE author_name = '$auth_name')";
                pg_query($conn, $sql);

                $select_result = pg_execute($conn, "select_author_details", array($auth_name));

                while ($row = pg_fetch_assoc($select_result)) {
                    $author_ids[] = $row['author_id'];
                }
            }
        }

        $authors_string = implode(",", $author_ids); // join the array values with a comma delimiter
    }
    
    $quartileJoin = array();
    foreach ($quartile_sem as $index => $value) {
        $quartileJoin[] = $value . '_' . $quartile_year[$index];
    }
    $quartile = implode(", ", $quartileJoin);

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
    

    $insert_query = "INSERT INTO table_publications (date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher, abstract) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15)";
    $insert_stmt = pg_prepare($conn, "insert_publication_details", $insert_query);
    $insert_result = pg_execute($conn, "insert_publication_details", array($date_published, $quartile, $authors_string, $department, $college, $campus, $title, $type, $if_external, $url, $sdg_string, $if_funded, $funding_nature, $publisher, $abstract));
    
    if ($insert_result) {
        echo "Insert successful.";
        header("Location: ../../publications.php");
    } else {
        echo "Insert failed.";
    }
} else {
    header("Location: ../../publications.php");
}   
?>