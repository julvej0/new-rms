<?php
function get_data($ipassetsurl, $authorurl, $search, $type, $class, $year)
{
    $search_query = $search != 'empty_search' ? $search : '';
    $no_of_records_per_page = 10;

    $encodedJsonResponse = getReq($ipassetsurl);
    if (isset($encodedJsonResponse->error)) {

        return null;
    }
    $tableData = $encodedJsonResponse->table_ipassets;

    // retrieve all the authors registered from the api
    $authorObj = getReq($authorurl);
    if (!isset($authorObj->error)) {
        $authorObj = $authorObj->table_authors;
    } else {
        $authorObj = [];
    }
    // retrieve all the values from json response
    foreach ($tableData as $index => $content) {
        // retrieve the names for each authors that are registered for this paper
        // if (($count - 10) < $index && $index < $count) {
        $authorList = "";
        if (isset($content->authors)) {
            $authors = explode(',', $content->authors);

            // retrieve the author names from the api response
            foreach ($authors as $aid) {
                foreach ($authorObj as $registeredAuthor) {
                    if ($aid == $registeredAuthor->author_id) {
                        $authorList .= $registeredAuthor->author_name . "<br/>";
                        break;
                    }
                }
            }
        }

        if ($content->status == "not-registered") {
            $table_rows[] = array(
                'registration_number' => $content->registration_number,
                'title_of_work' => $content->title_of_work ?? "Not Available",
                'type_of_document' => $content->type_of_document ?? "Not Available",
                'class_of_work' => $content->class_of_work ?? "Not Available",
                'date_of_creation' => date_format(date_create($content->date_of_creation), "m/d/Y") ?? "Not Available",
                'date_registered' => "Not Available",
                'campus' => $content->campus ?? "Not Available",
                'college' => $content->college ?? "Not Available",
                'program' => $content->program ?? "Not Available",
                'authors' => $authorList ?? "Not Available",
                'hyperlink' => 'Not Available',
                'status' => $content->status ?? "Not Available",
                'certificate' => 'Not Available',
            );
        } else {
            $table_rows[] = array(
                'registration_number' => $content->registration_number,
                'title_of_work' => $content->title_of_work ?? "Not Available",
                'type_of_document' => $content->type_of_document ?? "Not Available",
                'class_of_work' => $content->class_of_work ?? "Not Available",
                'date_of_creation' => date_format(date_create($content->date_of_creation), "m/d/Y") ?? "Not Available",
                'date_registered' => date_format(date_create($content->date_registered), "m/d/Y") ?? "Not Available",
                'campus' => $content->campus ?? "Not Available",
                'college' => $content->college ?? "Not Available",
                'program' => $content->program ?? "Not Available",
                'authors' => $authorList ?? "Not Available",
                'hyperlink' => 'Not Available',
                'status' => $content->status ?? "Not Available",
                'certificate' => 'Not Available',
            );
        }
        // }
    }

    // perform a searching operation for all keywords
    $table_rows = keywordsearchAPI($table_rows, $search);
    // $table_rows = searchTypeAPI($table_rows, $type, 'type_of_document');
    // $table_rows = searchTypeAPI($table_rows, $class, "class_of_work");
    // $table_rows = searchTypeAPI($table_rows, $year, "date_registered");
    return $table_rows;

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
function getReq($url)
{
    // retrieve all the data from the api
    $curlRequest = curl_init($url);
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curlRequest);

    return json_decode($response);
}
?>