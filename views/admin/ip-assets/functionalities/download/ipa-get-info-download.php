<?php
function get_data($ipassetsurl, $authorurl, $additionalQuery, $search, $type, $class, $year)
{
    $search_query = $search != 'empty_search' ? $search : '';
    $no_of_records_per_page = 10;

    include_once dirname(__FILE__, 5) . '/helpers/utils/utils-ipasset.php';
    include_once dirname(__FILE__, 5) . '/helpers/utils/utils-author.php';
    $response = getIpassets($ipassetsurl);
    if ($response != false) {
        foreach ($response as $key => $row) {
            $authorIds = explode(',', $row['authors']);
            $authorNames = array();

            foreach ($authorIds as $authorId) {
                $authorResult = getAuthorById($authorurl, $authorId);
                if ($authorResult != false) {
                    foreach ($authorResult as $key => $author) {
                        $authorNames[] = $author;
                    }
                }
            }

            $authorNamesString = implode(', ', $authorNames);

            $table_rows[] = array(
                'registration_number' => $row['registration_number'],
                'title_of_work' => $row['title_of_work'],
                'type_of_document' => $row['type_of_document'],
                'class_of_work' => $row['class_of_work'],
                'date_of_creation' => $row['date_of_creation'],
                'date_registered' => $row['date_registered'],
                'campus' => isset($row['campus']) ? $row['campus'] : null,
                'college' => isset($row['college']) ? $row['college'] : null,
                'program' => isset($row['program']) ? $row['program'] : null,
                'authors' => $authorNamesString,
                'hyperlink' => $row['hyperlink'],
                'status' => $row['status']
            );
        }
        $table_rows = keywordsearchAPI($table_rows, $search);

        return $table_rows;
    } else {
        return null;
    }

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

function authorSearch($conn, $search_query)
{
    $additionalQuery = "";
    if (isset($_GET['search'])) {
        //Select Author Ids that matches the search
        $select_authors = "SELECT author_id as author FROM table_authors WHERE author_name ILIKE '%$search_query%'";
        $result = pg_query($conn, $select_authors);

        if (pg_num_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                $author_id[] = $row['author'];
            }//Additional query for search
            foreach ($author_id as $a_id) {
                $additionalQuery .= " OR authors ILIKE '%$a_id%' ";
            }

        }


        return $additionalQuery;
    } else {
        return null;
    }


}
?>