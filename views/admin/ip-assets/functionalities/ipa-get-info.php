<?php
function get_data($ipassetsurl, $authorurl, $search, $type, $class, $year)
{
    // Retrieve data from the IP assets API
    $encodedJsonResponse = getReq($ipassetsurl);
    if (isset($encodedJsonResponse->error)) {
        return null;
    }
    $tableData = $encodedJsonResponse->table_ipassets;

    // Retrieve all the authors registered from the api
    $authorObj = getReq($authorurl);
    if (!isset($authorObj->error)) { //if there is no error
        $authorObj = $authorObj->table_authors;
    } else {
        $authorObj = [];
    }
    $authorcolumn = array_column($authorObj, "author_name", "author_id");
    
    // Process each IP asset entry
    foreach ($tableData as $index => $content) {
        // Get author names for the current IP asset
        $authorList = "";
        if (isset($content->authors)) {
            $authors = explode(',', $content->authors);

            foreach ($authors as $aid) {
                if(isset($authorcolumn[$aid])) {
                    $authorList .= $authorcolumn[$aid] . "<br/>";
                }
            }
        }

        // Add the processed IP asset entry to the table rows
        $rowData = [
            'registration_number' => $content->registration_number,
            'title_of_work' => $content->title_of_work ?? "Not Available",
            'type_of_document' => $content->type_of_document ?? "Not Available",
            'class_of_work' => $content->class_of_work ?? "Not Available",
            'date_of_creation' => date_format(date_create($content->date_of_creation), "m/d/Y") ?? "Not Available",
            'date_registered' => $content->status == "not-registered" ? "Not Available" : date_format(date_create($content->date_registered), "m/d/Y") ?? "Not Available",
            'campus' => $content->campus ?? "Not Available",
            'college' => $content->college ?? "Not available",
            'program' => $content->program ?? "Not Available",
            'authors' => $authorList ?? "Not Available",
            'hyperlink' => $content->hyperlink ?? '',
            'status' => $content->status ?? "Not Available",
            'certificate' => $content->certificate ?? '',
        ];

        $table_rows[] = $rowData;
    }

    // Perform a searching operation for all keywords
    $table_rows = keywordsearchAPI($table_rows, $search);
    $table_rows = searchTypeAPI($table_rows, $type, 'type_of_document');
    $table_rows = searchTypeAPI($table_rows, $class, "class_of_work");
    $table_rows = searchTypeAPI($table_rows, $year, "date_registered");
    return $table_rows;
}

// Keyword searching operation for all the string matches in the table
function keywordsearchAPI($tableRows, $search)
{
    if ($search == 'empty_search' || trim($search) == '') {
        return $tableRows;
    }

    foreach ($tableRows as $index => $rowData) {
        $isMatched = strpos(strtolower($rowData['title_of_work']), strtolower($search)) !== false
            || strpos(strtolower($rowData['authors']), strtolower($search)) !== false
            || strpos(strtolower($rowData['registration_number']), strtolower($search)) !== false
            || strpos(strtolower($rowData['campus']), strtolower($search)) !== false
            || strpos(strtolower($rowData['college']), strtolower($search)) !== false
            || strpos(strtolower($rowData['status']), strtolower($search)) !== false;

        
        // If there's no match, remove the current row from the table
        if (!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

// Searches for the type of document
function searchTypeAPI($tableRows, $filter, $tableColumn)
{
    if ($filter == 'empty_type' || trim($filter) == '' || $filter == 'empty_class' || $filter == 'empty_year'){
        return $tableRows;
    }
    return searchAPI($tableRows, $filter, $tableColumn);
}

// Removes out rows that don't match the specified key and value.
function searchAPI($tableRows, $filter, $tableColumn)
{
    foreach ($tableRows as $index => $rowData) {
        if ($tableColumn == "date_registered") {
            if (isset($rowData[$tableColumn])) {
                // Compare the year part of the date with the filter match string
                $isMatched = date('Y', strtotime($rowData[$tableColumn])) == $filter;
            }
        } else {
            // Compare the value of the current row's column with the filter match string
            $isMatched = $rowData[$tableColumn] == $filter;
        }

        // If there's no match, remove the current row from the table
        if (!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

// Sends a GET request to the specified URL and decodes the JSON response
function getReq($url)
{
    // Retrieve all the data from the api
    $curlRequest = curl_init($url);
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlRequest);
    curl_close($curlRequest);
    return json_decode($response);
}

?>
