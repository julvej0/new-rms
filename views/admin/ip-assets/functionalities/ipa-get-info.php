<?php
function get_data($conn, $additionalQuery, $search, $type, $class, $year, $page_number) {
    return api_get_data($additionalQuery, $search, $type, $class, $year, $page_number);
}

// retrieves the data from the api route
function api_get_data($additionalQuery, $search, $type, $class, $year, $page_number) {
    $encodedJsonResponse = getReq('http://localhost:5000/table_ipassets');
    $tableData = $encodedJsonResponse->table_ipassets;

    // TODO: API call for authors name retrieval
    // retrieve all the values from json response
    foreach($tableData as $content) {
        // retrieve the names for each authors that are registered for this paper
        $authors = explode(',', $content->authors);
        $authorList = "";

        // retrieve the autornames from the api
        foreach($authors as $aid) {
            $authorObj = getReq("http://localhost:5000/table_authors/$aid");
            if (!$authorObj || !property_exists($authorObj, "table_authors")) {
                $authorList .= "Unknown Author<br/>";
                continue;
            }

            $authorList .= $authorObj->table_authors->author_name . "<br/>";
        }

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
            'authors' => $authorList,
            'hyperlink' => 'Not Available',
            'status' => $content->status,
            'certificate' => 'Not Available',
        );
    }

    // perform a searching operation for all keywords
    $table_rows = keywordsearchAPI($table_rows, $search);
    $table_rows = searchTypeAPI($table_rows, $type);

    return $table_rows;
}

// keyword searching operation for all the string matches in the table
function keywordsearchAPI($tableRows, $strmatch) {
    if ($strmatch == 'empty_search' || $strmatch == ' ' || $strmatch == '') return $tableRows;

    // pop the values that isn't like the authorname
    foreach($tableRows as $index => $rowData) {
        $isMatched = strpos(strtolower($rowData['title_of_work']), strtolower($strmatch))
        || strpos(strtolower($rowData['authors']), strtolower($strmatch))
        || strpos(strtolower($rowData['registration_number']), strtolower($strmatch))
        || strpos(strtolower($rowData['campus']), strtolower($strmatch))
        || strpos(strtolower($rowData['college']), strtolower($strmatch))
        || strpos(strtolower($rowData['status']), strtolower($strmatch));

        if (!$isMatched) unset($tableRows[$index]);
    }

    return $tableRows;
}

// searches for the type of document
function searchTypeAPI($tableRows, $strmatch) {
    if ($strmatch == 'empty_type') return $tableRows;
    return searchAPI($tableRows, $strmatch, 'type_of_document');
}

// removes the authors from the table that doesn' match or isn't like the authorName
function searchAPI($tableRows, $strmatch, $key) {
    if ($strmatch == '' || $strmatch == ' ') return $tableRows;

    // pop the values that isn't like the authorname
    foreach($tableRows as $index => $rowData) {
        $isMatched = strpos($rowData[$key], $strmatch);
        if (!$isMatched) unset($tableRows[$index]);
    }

    return $tableRows;
}

// for making a curl get request
function getReq($url) {
    // retrieve all the data from the api
    $curlRequest = curl_init($url);
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlRequest);
    return json_decode($response);
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

?>
