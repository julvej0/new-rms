<?php
include_once dirname(__FILE__, 5) . "/helpers/db.php";
require_once "config.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-publication.php";
include_once dirname(__FILE__, 4) . "/helpers/utils/utils-ipasset.php";

function display_publications($publicationurl, $id)
{
    $pubData = getPublications($publicationurl);
    $authorsPub = [];
    foreach ($pubData as $index => $rowData) {
        $authors = $rowData['authors'];
        if (strpos($authors, $id) !== false) {
            array_push($authorsPub, $rowData);
        }
    }
    ?>
    <table class='css-table'>
        <tr id='css-header-container'>
            <th class='css-header'> Publications </th>
        </tr>
        <?php
        if (count($authorsPub) > 0) {
            foreach ($authorsPub as $index => $row) {
                $encrypted_ID = encryptor('encrypt', $row['publication_id']);
                ?>
                <tr class='css-tr' data-clickable='true'
                    onclick="window.location='../articles/article_view.php?pubID=<?= $encrypted_ID ?>'">
                    <td class='css-td'>
                        <?= $row['title_of_paper'] ? $row['title_of_paper'] : 'Not Yet Set'; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    <?php } else {
            ?>
        <tr class='css-tr' data-clickable='false'>
            <td class='css-td'>No Records Found</td>
        </tr>
        <?php
        }
}

function display_ipassets($ipassetsurl, $id)
{
    $ipassetsData = getIpassets($ipassetsurl);
    $authorsIP = [];
    foreach ($ipassetsData as $index => $rowData) {
        $authors = $rowData['authors'];
        if (strpos($authors, $id) !== false) {
            array_push($authorsIP, $rowData);
        }
    }
    ?>
    <table class='css-table'>
        <tr id='css-header-container'>
            <th class='css-header'> Patented Documents </th>
        </tr>
        <?php

        if (count($authorsIP) > 0) {

            foreach ($authorsIP as $index => $row) {
                $encrypted_ID = encryptor('encrypt', $row['registration_number']);
                ?>
                <tr class='css-tr' data-clickable='true'
                    onclick="window.location='../ip-assets/ip-assets-view.php?ipID=<?= $encrypted_ID ?>'">
                    <td class='css-td'>
                        <?= $row['title_of_work'] ? $row['title_of_work'] : 'Not Yet Set'; ?>
                    </td>

                </tr>
                <?php
            }
            ?>
        </table>

    <?php } else {
            ?>
        <tr class='css-tr' data-clickable='false'>
            <td class='css-td'>No Records Found</td>
        </tr>


        <?php
        }
} ?>