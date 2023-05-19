<?php
function get_data($conn, $additionalQuery, $search ) {
    $search_query = $search != "empty_search" ? $search : '';

    //Search Query
    $sqlSearchQuery = "SELECT * 
                        FROM (
                            SELECT * 
                            FROM table_publications 
                            WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%$search_query%' ";
    
    
    if ($additionalQuery !== "empty_search") {
        $sqlSearchQuery .= $additionalQuery;
    }

    $sqlSearchQuery .= " )AS searched_pub WHERE 1=1 ";

    
    $sqlSearchQuery .= "ORDER BY publication_id DESC";
   
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

function authorSearch($conn, $search) {
    if($search != 'empty_search'){
        //Select Author Ids that matches the search
        $select_authors = "SELECT author_id as author FROM table_authors WHERE author_name ILIKE '%$search%'";
        $result = pg_query($conn, $select_authors);

        if(pg_num_rows($result) > 0){
            $additionalQuery = "OR ( ";
            while ($row = pg_fetch_assoc($result)) {
                $author_id[] = $row['author'];    
            }//Additional query for search
            foreach ($author_id as $a_id){
                if ( $a_id == $author_id[0]){
                    $additionalQuery .= " authors ILIKE '%$a_id%' ";
                }
                else{
                    $additionalQuery .= " OR authors ILIKE '%$a_id%' ";
                }
                
            }

            $additionalQuery .= " ) ";
            return $additionalQuery;
        }

        
        
    }else{
        return "empty_search";
    }
    

}
?>
