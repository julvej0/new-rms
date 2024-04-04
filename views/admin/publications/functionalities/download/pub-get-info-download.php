<?php
function get_data($publicationurl, $authorurl, $search)
{
    $search_query = $search == 'empty_search' ? '' : $search;

    $encodedJsonResponse = getReq($publicationurl);
    if ($encodedJsonResponse == null) {
        return null;
    }
    $tableData = $encodedJsonResponse->table_publications;

    // retrieve all the authors registered from the api
    $authorObj = getReq($authorurl);
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

        $table_rows[] = array(
            'publication_id' => $content->publication_id,
            'date_published' => isset($content->date_published) ? date_format(date_create($content->date_published), "m/d/Y") : "Not Available",
            'quartile' => $content->quartile ?? "Not Available",
            'department' => $content->department ?? "Not Available",
            'title_of_paper' => $content->title_of_paper ?? "Not Available",
            'type_of_publication' => $content->type_of_publication ?? "Not Available",
            'funding_source' => $content->funding_source ?? "Not Available",
            'number_of_citation' => $content->number_of_citation ?? "Not Available",
            'google_scholar_details' => $content->google_scholar_details ?? "Not Available",
            'sdg_no' => $content->sdg_no ?? "Not Available",
            'authors' => $authorList ?? "Not Available",
            'funding_type' => $content->funding_type ?? "Not Available",
            'nature_of_funding' => $content->nature_of_funding ?? "Not Available",
            'publisher' => $content->publisher ?? "Not Available",
            'campus' => $content->campus ?? "Not Available",
            'college' => $content->college ?? "Not Available",
        );
    }

    $table_rows = keywordsearchAPI($table_rows, $search);

    return $table_rows;
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

?>