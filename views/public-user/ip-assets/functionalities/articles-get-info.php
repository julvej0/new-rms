<?php

function get_data($search, $sort_query, $dateStart_query, $dateEnd_query, $campus_query)
{
    $encodedJsonResponse = getReq('http://localhost:5000/table_ipassets');
    if ($encodedJsonResponse == null) {
        return null;
    }
    $tableData = $encodedJsonResponse->table_ipassets;

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

        if ($content->status == "not-registered") {
            $table_rows[] = array(
                'registration_number' => $content->registration_number,
                'title_of_work' => $content->title_of_work,
                'type_of_document' => $content->type_of_document,
                'class_of_work' => $content->class_of_work,
                'date_of_creation' => date_format(date_create($content->date_of_creation), "m/d/Y"),
                'date_registered' => "Not Available",
                'campus' => $content->campus ?? "Not Available",
                'college' => $content->college ?? "Not Available",
                'program' => $content->program ?? "Not Available",
                'authors' => $authorList == "" ? "Not Available" : $authorList,
                'hyperlink' => 'Not Available',
                'status' => $content->status,
                'certificate' => 'Not Available',
            );
        } else {
            $table_rows[] = array(
                'registration_number' => $content->registration_number,
                'title_of_work' => $content->title_of_work,
                'type_of_document' => $content->type_of_document,
                'class_of_work' => $content->class_of_work,
                'date_of_creation' => date_format(date_create($content->date_of_creation), "m/d/Y"),
                'date_registered' => date_format(date_create($content->date_registered), "m/d/Y"),
                'campus' => $content->campus ?? "Not Available",
                'college' => $content->college ?? "Not Available",
                'program' => $content->program ?? "Not Available",
                'authors' => $authorList == "" ? "Not Available" : $authorList,
                'hyperlink' => 'Not Available',
                'status' => $content->status,
                'certificate' => 'Not Available',
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
        $isMatched = strpos(strtolower($rowData['title_of_work']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['authors']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['registration_number']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['campus']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['college']), strtolower($strmatch)) !== false
            || strpos(strtolower($rowData['status']), strtolower($strmatch)) !== false;

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