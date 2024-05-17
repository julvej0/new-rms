<?php
function getDistinctYear($url)
{
    $response = @file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $userData = json_decode($response, true)['table_publications'];

    $distinctYears = [];

    foreach ($userData as $asset) {
        $year = isset($asset['date_published']) ? date('Y', strtotime($asset['date_published'])) : null;
        if (!in_array($year, $distinctYears) && $year != null) {
            $distinctYears[] = $year;
        }
    }

    rsort($distinctYears);

    return $distinctYears;
}

function getDistinctType($url)
{
    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }

    $userData = json_decode($response, true)['table_publications'];

    $distinctTypes = [];

    foreach ($userData as $publication) {
        $type = isset($publication["type_of_publication"]) ? $publication["type_of_publication"] : null;
        if (!in_array($type, $distinctTypes) && $type != null) {
            $distinctTypes[] = $type;
        }
    }
    rsort($distinctTypes);
    return $distinctTypes;

}



?>