<?php
function get_data($conn, $additionalQuery) {
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $no_of_records_per_page = 10;
    

    //Search Query
    $sqlSearchQuery = "SELECT * FROM table_ipassets WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, campus, college, program, authors) ILIKE '%$search_query%'".$additionalQuery." ORDER BY date_registered DESC;";
    $result = pg_query($conn, $sqlSearchQuery);
    $resultCheck = pg_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = pg_fetch_assoc($result)) {

            $authorIds = explode(',', $row['authors']);
            $authorNames = array();

            foreach ($authorIds as $id) {
                $authorResult = pg_query($conn, "SELECT author_name FROM table_authors WHERE author_id = '$id' ");
                $authorRow = pg_fetch_assoc($authorResult);
                if ($authorRow) {
                    $authorNames[] = $authorRow['author_name'];
                }
            }
            $authorNamesString = implode(', ', $authorNames);

            $table_rows[] = array(
                'registration_number' => $row['registration_number'],
                'title_of_work' => $row['title_of_work'],
                'type_of_document' => $row['type_of_document'],
                'class_of_work' => $row['class_of_work'],
                'date_of_creation' => $row['date_of_creation'],
                'date_registered' => $row['date_registered'],
                'campus' => $row['campus'],
                'college' => $row['college'],
                'program' => $row['program'],
                'authors' => $authorNamesString,
                'hyperlink' => $row['hyperlink'],
            );
        }
        return $table_rows;
    } else {
        return null;
    }
}

function authorSearch($conn) {
    $additionalQuery = "";
    if(isset($_GET['search'])){
        $search_query = $_GET['search'];
        //Select Author Ids that matches the search
        $select_authors = "SELECT author_id as author FROM table_authors WHERE author_name ILIKE '%$search_query%'";
        $result = pg_query($conn, $select_authors);

        if(pg_num_rows($result) > 0){
            while ($row = pg_fetch_assoc($result)) {
                $author_id[] = $row['author'];    
            }//Additional query for search
            foreach ($author_id as $a_id){
                $additionalQuery .= " OR authors ILIKE '%$a_id%' ";
            }

        }

        
        return $additionalQuery;
    }else{
        return null;
    }
    

}
?>
