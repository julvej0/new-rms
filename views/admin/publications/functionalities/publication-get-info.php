<?php
function get_data($conn, $additionalQuery) {
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $no_of_records_per_page = 10;
    
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else{
        $pageno=1;
    }

    //offset
    $offset = ($pageno-1) * $no_of_records_per_page;

    $result = pg_query($conn, "SELECT * FROM table_publications WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher)
    ILIKE '%$search_query%'".$additionalQuery." ORDER BY publication_id DESC OFFSET $offset LIMIT $no_of_records_per_page;");
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
                'publication_id' => $row['publication_id'],
                'date_published' => $row['date_published'],
                'quartile' => $row['quartile'],
                'department' => $row['department'],
                'title_of_paper' => $row['title_of_paper'],
                'type_of_publication' => $row['type_of_publication'],
                'funding_source' => $row['funding_source'],
                'number_of_citation' => $row['number_of_citation'],
                'google_scholar_details' => $row['google_scholar_details'],
                'sdg_no' => $row['sdg_no'],
                'authors' => $authorNamesString,
                'funding_type' => $row['funding_type'],
                'nature_of_funding' => $row['nature_of_funding'],
                'publisher' => $row['publisher'],
                'campus' => $row['campus'],
                'college' => $row['college'],
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
