<?php

function get_data($search, $sort_query, $dateStart_query, $dateEnd_query, $campus_query)
{
    $encodedJsonResponse = getReq('http://localhost:5000/table_publications');
    if ($encodedJsonResponse == null) {
        return null;
    }
    $tableData = $encodedJsonResponse->table_publications;

    // retrieve all the authors registered from the api
    $authorObj = getReq("http://localhost:5000/table_authors");
    $authorObj = !isset($authorObj->error) ? $authorObj->table_authors : [];

    // $count = $page_number * 10;
    // retrieve all the values from json response
    foreach ($tableData as $content) {
        // retrieve the names for each authors that are registered for this paper
        $authorList = "";
        if (isset($content->authors)) {
            $authors = explode(',', $content->authors);

            // retrieve the author names from the api response
            foreach ($authors as $aid) {
                foreach ($authorObj as $registeredAuthor) {
                    if ($aid == $registeredAuthor->author_id) {
                        $authorList .= (strlen($authorList) > 0 ? ", " : "") . $registeredAuthor->author_name;
                        break;
                    }
                }
            }
        }

        if ($content->date_published == null) {
            $table_rows[] = array(
                'publication_id' => $content->publication_id,
                'date_published' => "Not Available",
                'quartile' => $content->quartile,
                'authors' => $authorList,
                'department' => $content->department,
                'college' => $content->college,
                'campus' => $content->campus,
                'title_of_paper' => $content->title_of_paper,
                'type_of_publication' => $content->type_of_publication,
                'funding_source' => $content->funding_source ?? "Not Available",
                'number_of_citation' => $content->number_of_citation ?? "Not Available",
                'google_scholar_details' => $content->google_scholar_details,
                'sdg_no' => $content->sdg_no,
                'funding_type' => $content->funding_type ?? "Not Available",
                'nature_of_funding' => $content->nature_of_funding,
                'publisher' => $content->publisher,
                'abstract' => $content->abstract,
            );
        } else {
            $table_rows[] = array(
                'publication_id' => $content->publication_id,
                'date_published' => date_format(date_create($content->date_published), "m/d/Y"),
                'quartile' => $content->quartile,
                'authors' => $authorList,
                'department' => $content->department,
                'college' => $content->college,
                'campus' => $content->campus,
                'title_of_paper' => $content->title_of_paper,
                'type_of_publication' => $content->type_of_publication,
                'funding_source' => $content->funding_source ?? "Not Available",
                'number_of_citation' => $content->number_of_citation ?? "Not Available",
                'google_scholar_details' => $content->google_scholar_details,
                'sdg_no' => $content->sdg_no,
                'funding_type' => $content->funding_type ?? "Not Available",
                'nature_of_funding' => $content->nature_of_funding,
                'publisher' => $content->publisher,
                'abstract' => $content->abstract,
            );
        }
    }

    // perform a searching operation for all keywords
    $table_rows = keywordsearchAPI($table_rows, $search);
    // $table_rows = searchTypeAPI($table_rows, $sort_query, $sort_query);
    // $table_rows = searchTypeAPI($table_rows, $class, "nature_of_funding");
    // $table_rows = searchTypeAPI($table_rows, $year, "date_published");

    return $table_rows;
}

function getReq($url)
{
    // retrieve all the data from the api
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

function keywordsearchAPI($tableRows, $strmatch)
{
    if ($strmatch == 'empty_search' || $strmatch == ' ' || $strmatch == '') {
        return $tableRows;
    }

    // pop the values that isn't like the authorname
    foreach ($tableRows as $index => $rowData) {
        $isMatched = strpos(strtolower($rowData['title_of_paper']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['authors']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['publication_id']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['campus']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['college']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['department']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['quartile']), strtolower($strmatch)) !== false;

        if (!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

// searches for the type of document
function searchTypeAPI($tableRows, $strmatch, $tableColumn)
{
    if ($strmatch == 'empty_sort' || $strmatch == '' || $strmatch == ' ')
        return $tableRows;
    return searchAPI($tableRows, $strmatch, $tableColumn);
}

// removes the authors from the table that doesn' match or isn't like the authorName
function searchAPI($tableRows, $strmatch, $key)
{
    // pop the values that isn't like the authorname
    foreach ($tableRows as $index => $rowData) {
        if ($key == "title") {
            if (isset($rowData[$key])) {
                $isMatched = date('Y', strtotime($rowData[$key])) == $strmatch;
            }
        } else {
            $isMatched = $rowData[$key] == $strmatch;
        }

        if (!$isMatched) {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

?>