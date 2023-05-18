<?php
include_once "../../../db/db.php";
require_once "config.php";

if (isset($_SESSION['user_email'])) {

    $author_user = $_SESSION['user_email'];

    $sql_data = "SELECT a.author_name, a.gender, a.type_of_author, a.affiliation, a.email, p.title_of_paper, p.publication_id, COUNT(i.*) as total_ip_assets
                 FROM table_authors a
                 LEFT JOIN table_publications p ON a.author_id = p.authors
                 LEFT JOIN table_ipassets i ON a.author_id = i.authors
                 WHERE a.email = '$author_user'
                 GROUP BY a.author_name, a.gender, a.type_of_author, a.affiliation, a.email, p.title_of_paper, p.publication_id";

    $sql_result = pg_query($conn, $sql_data);

    if ($sql_result && pg_num_rows($sql_result) > 0) {
        ?>
        <table id='css-table'>
            <tr id='css-header-container'>
                <th class='css-header'> Publications </th>
            </tr>
            <?php
            while ($row = pg_fetch_assoc($sql_result)) {
                $encrypted_ID = encryptor('encrypt', $row['publication_id']);
                ?>
                <tr class='css-tr' <?php if ($row['title_of_paper'] == 'Not Yet Set') {
                    echo "data-clickable='false'";
                } else {
                    echo "data-clickable='true'";
                } ?>>
                    <td class='css-td'><?= $row['title_of_paper'] ? $row['title_of_paper'] : 'Not Yet Set'; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <table id='css-table'>
            <tr id='css-header-container'>
                <th class='css-header'> IP Assets </th>
            </tr>
            <?php
            pg_result_seek($sql_result, 0); // Reset the result pointer to the beginning
            while ($row = pg_fetch_assoc($sql_result)) {
                $encrypted_ID = encryptor('encrypt', $row['publication_id']);
                ?>
                <tr class='css-tr' <?php if ($row['total_ip_assets'] == 0) {
                    echo "data-clickable='false'";
                } else {
                    echo "data-clickable='true'";
                } ?>>
                    <td class='css-td'><?= $row['total_ip_assets'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php

    } else {
        // No results found
        ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'No results found',
                text: 'No Results!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Clear the search query and reload the page
                // window.location.href = 'author-profile.php';
            });
        </script>
        <?php
    }
} else {
    ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Authorization Warning',
            text: 'You are not an Author!',
            confirmButtonText: 'OK'
        }).then(() => {
            // Clear the search query and reload the page
            window.location.href = '../../admin/account/login.php';
        });
    </script>
    <?php
}
?>
