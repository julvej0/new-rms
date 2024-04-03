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
                'class_of_work' => $content->class_of_work ?? "Not Available",
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
                'class_of_work' => $content->class_of_work ?? "Not Available",
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
    $table_rows = sortTypeAPI($table_rows, $sort_query);
    $table_rows = searchTypeAPI($table_rows, $campus_query);
    $table_rows = dateTypeAPI($table_rows, $dateStart_query, $dateEnd_query);

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

function dateTypeAPI($tableRows, $start, $end)
{
    if ($start == 'empty_dStart' && $end == 'empty_dEnd')
        return $tableRows;
    if ($start == '' && $end == "") {
        return $tableRows;
    }
    foreach ($tableRows as $index => $rowData) {
        $date = date_format(date_create($rowData['date_registered']), "Y");
        if ($end < $date) {
            unset($tableRows[$index]);
        }
        if ($start != "empty_dStart" && $start > $date) {
            print_r($start);
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
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
function searchTypeAPI($tableRows, $strmatch)
{
    if ($strmatch == '' || $strmatch == 'empty_campus' || $strmatch == ' ')
        return $tableRows;
    return searchAPI($tableRows, $strmatch);
}

// removes the authors from the table that doesn' match or isn't like the authorName
function searchAPI($tableRows, $strmatch)
{
    $campusData = implode(", ", $strmatch);
    // pop the values that isn't like the authorname
    foreach ($tableRows as $index => $rowData) {
        if (strpos($campusData, $rowData['campus']) == "") {
            unset($tableRows[$index]);
        }
    }
    return $tableRows;
}

function sortTypeAPI($tableRows, $sort)
{
    if ($sort == 'empty_sort' || $sort == '' || $sort == ' ')
        return $tableRows;
    return sortAPI($tableRows, $sort);
}

// removes the authors from the table that doesn' match or isn't like the authorName
function compareTitles($a, $b)
{
    return strcmp($a['title_of_work'], $b['title_of_work']);
}

function convertDate($date)
{
    return DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d');
}

function compareCampus($a, $b)
{
    return strcmp($a['campus'], $b['campus']);
}
function sortAPI($tableRows, $sort)
{
    if ($sort == "title")
        usort($tableRows, "compareTitles");
    if ($sort == "date") {
        usort($tableRows, function ($a, $b) {
            return strtotime(convertDate($a['date_of_creation'])) - strtotime(convertDate($b['date_of_creation']));
        });
    }
    if ($sort == "campus")
        usort($tableRows, "compareCampus");
    return $tableRows;
}
?>