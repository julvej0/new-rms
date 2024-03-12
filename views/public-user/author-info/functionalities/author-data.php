<?php
include_once "../../../helpers/db.php";
require_once "config.php";


function display_publications($conn, $id)
{
    $sql_data = "SELECT publication_id, title_of_paper FROM table_publications WHERE authors ILIKE '%$id%'";

    $sql_result = pg_query($conn, $sql_data);
    ?>
    <table class='css-table'>
        <tr id='css-header-container'>
            <th class='css-header'> Publications </th>
        </tr>
        <?php

        if ($sql_result && pg_num_rows($sql_result) > 0) {

            while ($row = pg_fetch_assoc($sql_result)) {
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

function display_ipassets($conn, $id)
{
    $sql_data = "SELECT registration_number, title_of_work FROM table_ipassets WHERE authors ILIKE '%$id%'";

    $sql_result = pg_query($conn, $sql_data);
    ?>
    <table class='css-table'>
        <tr id='css-header-container'>
            <th class='css-header'> Patented Documents </th>
        </tr>
        <?php

        if ($sql_result && pg_num_rows($sql_result) > 0) {

            while ($row = pg_fetch_assoc($sql_result)) {
                $encrypted_ID = encryptor('encrypt', $row['registration_number']);
                ?>
                <tr class='css-tr' data-clickable='true'
                    onclick="window.location='../ipa/ip-assets-view.php?ipID=<?= $encrypted_ID ?>'">
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