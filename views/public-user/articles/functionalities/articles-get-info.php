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

        if (!isset($content->date_published)) {
            $table_rows[] = array(
                'publication_id' => $content->publication_id,
                'date_published' => "Not Available",
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
            );
        } else {
            $table_rows[] = array(
                'publication_id' => $content->publication_id,
                'date_published' => date_format(date_create($content->date_published), "m/d/Y") ?? "Not Available",
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
        if ($rowData['date_published'] === "Not Available") {
            unset($tableRows[$index]);
            continue;
        }
        $date = date_format(date_create($rowData['date_published']), "Y");
        if ($end < $date) {
            unset($tableRows[$index]);
        }
        if ($start != "empty_dStart" && $start > $date) {
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
    return strcmp($a['title_of_paper'], $b['title_of_paper']);
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
            $dateA = $a['date_published'];
            $dateB = $b['date_published'];
            // Handle null dates by moving them to the end
            if ($dateA === "Not Available" && $dateB === "Not Available") {
                return 0;
            } elseif ($dateA === "Not Available") {
                return 1; // Move $a to the end
            } elseif ($dateB === "Not Available") {
                return -1; // Move $b to the end
            }

            // Convert dates to compare
            $dateA = strtotime(convertDate($dateA));
            $dateB = strtotime(convertDate($dateB));
            return strtotime($dateA) - strtotime($dateB);
        });

    }
    if ($sort == "campus")
        usort($tableRows, "compareCampus");
    return $tableRows;
}
?>