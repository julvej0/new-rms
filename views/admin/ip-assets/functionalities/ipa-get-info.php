<?php
function get_data($conn, $additionalQuery, $search, $type, $class, $year, $page_number) {
    return api_get_data($additionalQuery, $search, $type, $class, $year, $page_number);

    // $search_query = $search != "empty_search" ? $search : '';
    // $no_of_records_per_page = 10;
    // //offset
    // $offset = ($page_number-1) * $no_of_records_per_page;
    // //Search Query
    // $sqlSearchQuery = "SELECT * FROM (
    //                         SELECT * 
    //                         FROM table_ipassets 
    //                         WHERE CONCAT(registration_number, title_of_work, type_of_document, class_of_work, date_of_creation, date_registered, campus, college, program, authors, status, certificate) ILIKE '%".rtrim($search_query)."%' ";
    
    // if ($additionalQuery !== "empty_search") {
    //     $sqlSearchQuery .= $additionalQuery;
    // }

    // $sqlSearchQuery .= " )AS searched_ipa WHERE 1=1 ";

    // if ($type !== 'empty_type') {
    //     $sqlSearchQuery .= " AND searched_ipa.type_of_document = '$type' ";
    // }
    // if ($class !== 'empty_class') {
    //     $sqlSearchQuery .= " AND searched_ipa.class_of_work = '$class' ";
    // }
    // if ($year !== 'empty_year') {
    //     $sqlSearchQuery .= " AND EXTRACT(YEAR FROM searched_ipa.date_registered) = '$year' ";
    // }
    
    // $sqlSearchQuery .= "ORDER BY registration_number DESC OFFSET $offset LIMIT $no_of_records_per_page";
   
    // $result = pg_query($conn, $sqlSearchQuery);
    // $resultCheck = pg_num_rows($result);

    // if ($resultCheck > 0) {
    //     while ($row = pg_fetch_assoc($result)) {
    //     // Split the author IDs into an array
    //         $authorIds = explode(',', $row['authors']);
    //         $authorNames = array(); // Initialize an empty array to store author names

    //         foreach ($authorIds as $id) {
    //             $authorResult = pg_query($conn, "SELECT author_name FROM table_authors WHERE author_id = '$id' ");
    //             $authorRow = pg_fetch_assoc($authorResult);
    //             if ($authorRow) {
    //                 $authorNames[] = $authorRow['author_name']; // Add author name to the array
    //             }
    //         }
    //         $authorNamesString = implode(', ', $authorNames); // Convert the array of author names into a string separated by commas
    //         $table_rows[] = array( // Add new rows of data to the $table_rows array
    //             'registration_number' => $row['registration_number'],
    //             'title_of_work' => $row['title_of_work'],
    //             'type_of_document' => $row['type_of_document'],
    //             'class_of_work' => $row['class_of_work'],
    //             'date_of_creation' => $row['date_of_creation'],
    //             'date_registered' => $row['date_registered'],
    //             'campus' => $row['campus'],
    //             'college' => $row['college'],
    //             'program' => $row['program'],
    //             'authors' => $authorNamesString,
    //             'hyperlink' => $row['hyperlink'],
    //             'status' => $row['status'],
    //             'certificate' => $row['certificate'],
    //         );
    //         // Each element of the array corresponds to a specific column in the table
    //         // The values are assigned from the corresponding values in the $row array
    //         // The 'authors' field is assigned the concatenated string of author names, $authorNamesString
    //     }

    //     return $table_rows;
    // } else {
    //     return null;
    // }
}

function api_get_data($additionalQuery, $search, $type, $class, $year, $page_number) {
    // retrieve all the data from the api
    $curlRequest = curl_init('http://localhost:5000/table_ipassets');
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlRequest);
    $encodedJsonResponse = json_decode($response);
    $tableData = $encodedJsonResponse->table_ipassets;

    // TODO: API call for authors name retrieval
    // TODO: Searching functions

    // retrieve all the values from json response
    foreach($tableData as $content) {
        // for now: author ids are to be pushed
        $authors = explode(',', $content->authors);
        $authors = implode('<br/>', $authors);

        $table_rows[] = array(
            'registration_number' => $content->registration_number,
            'title_of_work' => $content->title_of_work,
            'type_of_document' => $content->type_of_document,
            'class_of_work' => $content->class_of_work,
            'date_of_creation' => $content->date_of_creation,
            'date_registered' => $content->date_registered,
            'campus' => 'Not Available',
            'college' => 'Not Available',
            'program' => 'Not Available',
            'authors' => $authors,
            'hyperlink' => 'Not Available',
            'status' => $content->status,
            'certificate' => 'Not Available',
        );
    }

    return $table_rows;
}

function authorSearch($authorurl, $search) {
    if ($search != 'empty_search' || $search != ' ') {
        $authors = file_get_contents($authorurl);
        
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

