<?php
function authorSearch($conn, $search) {
    if($search != 'empty_search' || $search != ' '){
        //Select Author Ids that matches the search
        $select_authors = "SELECT author_id as author FROM table_authors WHERE author_name ILIKE '%".rtrim($search)."%'";
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