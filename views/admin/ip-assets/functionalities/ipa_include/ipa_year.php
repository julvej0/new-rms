<?php


function getDistinctYear($url)
{
    $response = @file_get_contents($url);
    if ($response === false) {
        return null;
    }

    $userData = json_decode($response, true)['table_ipassets'];

    $distinctYears = [];

    foreach ($userData as $asset) {
        $year = isset($asset['date_registered']) ? date('Y', strtotime($asset['date_registered'])) : null;
        if (!in_array($year, $distinctYears) && $year != null) {
            $distinctYears[] = $year;
        }
    }

    rsort($distinctYears);

    return $distinctYears;
}
?>