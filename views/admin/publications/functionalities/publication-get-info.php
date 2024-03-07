<?php
function get_data($conn, $additionalQuery, $search, $type, $fund, $year, $page_number) {
    $search_query = $search != "empty_search" ? $search  : '';
   
    $no_of_records_per_page = 10;

    //offset
    $offset = ($page_number-1) * $no_of_records_per_page;

    //Search Query
    $sqlSearchQuery = "SELECT * 
                        FROM (
                            SELECT * 
                            FROM table_publications 
                            WHERE CONCAT(publication_id, date_published, quartile, authors, department, college, campus, title_of_paper, type_of_publication, funding_source, number_of_citation, google_scholar_details, sdg_no, funding_type, nature_of_funding, publisher) ILIKE '%".rtrim($search_query)."%' ";
    
    
    if ($additionalQuery !== "empty_search") {
        $sqlSearchQuery .= $additionalQuery;
    }

    $sqlSearchQuery .= " )AS searched_pub WHERE 1=1 ";

    if ($type !== 'empty_type') {
        $sqlSearchQuery .= " AND searched_pub.type_of_publication = '$type' ";
    }
    if ($fund !== 'empty_fund') {
        $sqlSearchQuery .= " AND searched_pub.nature_of_funding = '$fund' ";
    }
    if ($year !== 'empty_year') {
        $sqlSearchQuery .= " AND EXTRACT(YEAR FROM searched_pub.date_published::date) = '$year' ";
    }

    
    $sqlSearchQuery .= "ORDER BY publication_id DESC OFFSET $offset LIMIT $no_of_records_per_page";
   
    $result = pg_query($conn, $sqlSearchQuery);
    $resultCheck = pg_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = pg_fetch_assoc($result)) {
        // Split the author IDs into an array
            $authorIds = explode(',', $row['authors']);
            $authorNames = array(); // Initialize an empty array to store author names

            foreach ($authorIds as $id) {
                $authorResult = pg_query($conn, "SELECT author_name FROM table_authors WHERE author_id = '$id' ");
                $authorRow = pg_fetch_assoc($authorResult);
                if ($authorRow) {
                    $authorNames[] = $authorRow['author_name']; // Add author name to the array
                }
            }
            $authorNamesString = implode(', ', $authorNames); // Convert the array of author names into a string separated by commas

            $table_rows[] = array( // Add new rows of data to the $table_rows array
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
            // Each element of the array corresponds to a specific column in the table
            // The values are assigned from the corresponding values in the $row array
            // The 'authors' field is assigned the concatenated string of author names, $authorNamesString
        }
        return $table_rows;
    } else {
        return null;
    }
}

function authorSearch($authorurl, $search) {
    if ($search != 'empty_search' || $search != ' ') {
        $authors = @file_get_contents($authorurl);
        
        if ($authors !== false) {
            $authors = json_decode($authors, true);
            $authorIDs = array_column($authors['table_authors'], 'author_id');
            
            if (!empty($authorIDs)) {
                $additionalQuery = "OR ( ";
                foreach ($authorIDs as $index => $authorID) {
                    if ($index == 0) {
                        $additionalQuery .= " authors ILIKE '%$authorID%' ";
                    } else {
                        $additionalQuery .= " OR authors ILIKE '%$authorID%' ";
                    }
                }
                $additionalQuery .= " ) ";
                return $additionalQuery;
            }
        }else{
            return "";
        }
    } else {
        return "empty_search";
    }
    return '';
}



// function authorSearch($conn, $search) {
//     if($search != 'empty_search' || $search != ' '){
//         //Select Author Ids that matches the search
//         $select_authors = "SELECT author_id as author FROM table_authors WHERE author_name ILIKE '%".rtrim($search)."%'";
//         $result = pg_query($conn, $select_authors);

//         if(pg_num_rows($result) > 0){
//             $additionalQuery = "OR ( ";
//             while ($row = pg_fetch_assoc($result)) {
//                 $author_id[] = $row['author'];    
//             }//Additional query for search
//             foreach ($author_id as $a_id){
//                 if ( $a_id == $author_id[0]){
//                     $additionalQuery .= " authors ILIKE '%$a_id%' ";
//                 }
//                 else{
//                     $additionalQuery .= " OR authors ILIKE '%$a_id%' ";
//                 }
                
//             }

//             $additionalQuery .= " ) ";
//             return $additionalQuery;
//         }

        
        
//     }else{
//         return "empty_search";
//     }
    

// }

?>

