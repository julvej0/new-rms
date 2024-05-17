<?php

function get_data($search, $type, $fund, $year, $page_number)
{
    // Retrieve data from the Publication API
    $encodedJsonResponse = getReq('http://localhost:5000/table_publications');
    $tableData = $encodedJsonResponse->table_publications;

    // Retrieve all the authors registered from the api
    $authorObj = getReq("http://localhost:5000/table_authors");
    $authorObj = !isset($authorObj->error) ? $authorObj->table_authors : [];

    foreach ($tableData as $content) {
        // Retrieve the names for each authors that are registered for this paper
        $authorList = "";
        if (isset($content->authors)) {
            $authors = explode(',', $content->authors);

            foreach ($authors as $aid) {
                foreach ($authorObj as $registeredAuthor) {
                    if ($aid == $registeredAuthor->author_id) {
                        $authorList .= $registeredAuthor->author_name . "<br/>";
                        break;
                    }
                }
            }
        }

        // Add the processed Publication entry to the table rows
        $table_rows[] = array(
            'publication_id' => $content->publication_id,
            'date_published' => !isset($content->date_published) ? "Not Available" : date_format(date_create($content->date_published), "m/d/Y"),
            'quartile' => $content->quartile ?? "Not Available",
            'authors' => $authorList ?? "Not Available",
            'department' => $content->department ?? "Not Available",
            'college' => $content->college ?? "Not Available",
            'campus' => $content->campus ?? "Not Available",
            'title_of_paper' => $content->title_of_paper ?? "Not Available",
            'type_of_publication' => $content->type_of_publication ?? "Not Available",
            'funding_source' => $content->funding_source ?? "Not Available",
            'number_of_citation' => $content->number_of_citation ?? "Not Available",
            'google_scholar_details' => $content->google_scholar_details ?? "Not Available",
            'sdg_no' => $content->sdg_no ?? "Not Available",
            'funding_type' => $content->funding_type ?? "Not Available",
            'nature_of_funding' => $content->nature_of_funding ?? "Not Available",
            'publisher' => $content->publisher ?? "Not Available",
            'abstract' => $content->abstract ?? "Not Available",
            'status' => $content->status ?? "Not Available",
        );
    }

    // Perform a searching operation for all keywords
    $table_rows = keywordsearchAPI($table_rows, $search);
    $table_rows = searchTypeAPI($table_rows, $type, 'type_of_publication');
    $table_rows = searchTypeAPI($table_rows, $fund, "nature_of_funding");
    $table_rows = searchTypeAPI($table_rows, $year, "date_published");

    return $table_rows;
}

function getReq($url)
{
    // Retrieve all the data from the api
    $curlRequest = curl_init($url);
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlRequest);

    $decodedResponse = json_decode($response);
    if (isset($decodedResponse->error)) {

        return null;
    }
    return $decodedResponse;
}

function keywordsearchAPI($tableRows, $search)
{
    if ($search == 'empty_search' || trim($search) == '') {
        return $tableRows;
    }

    // Pop the values that isn't like rowdata column values
    foreach ($tableRows as $index => $rowData) {
        $isMatched = strpos(strtolower($rowData['title_of_paper']), strtolower($search)) !== false
            || strpos(strtolower($rowData['authors']), strtolower($search)) !== false
            || strpos(strtolower($rowData['publication_id']), strtolower($search)) !== false
            || strpos(strtolower($rowData['campus']), strtolower($search)) !== false
            || strpos(strtolower($rowData['college']), strtolower($search)) !== false
            || strpos(strtolower($rowData['department']), strtolower($search)) !== false
            || strpos(strtolower($rowData['quartile']), strtolower($search)) !== false
            || strpos(strtolower($rowData['status']), strtolower($search)) !== false;

        if (!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

// Searches for the type of document
function searchTypeAPI($tableRows, $filter, $tableColumn)
{
    if ($filter == 'empty_type' || $filter == '' || $filter == ' ' || $filter == 'empty_fund' || $filter == 'empty_year')
        return $tableRows;
    return searchAPI($tableRows, $filter, $tableColumn);
}

function searchAPI($tableRows, $filter, $tableColumn)
{
    // Pop the values that isn't like the string value
    foreach ($tableRows as $index => $rowData) {
        if ($tableColumn == "date_published") {
            if (isset($rowData[$tableColumn])) {
                // Compare the year part of the date with the filter match string
                $isMatched = date('Y', strtotime($rowData[$tableColumn])) == $filter;
            }
        } else {
            // Compare the value of the current row's column with the filter match string
            $isMatched = $rowData[$tableColumn] == $filter;
        }

        if(!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

?>