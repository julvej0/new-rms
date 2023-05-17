<?php
include_once "../../../db/db.php";

if (isset($_SESSION['user_email'])) {

    $author_user = $_SESSION['user_email'];

    $sql_data = "SELECT * FROM table_authors WHERE email = '$author_user'";
    $sql_result = pg_query($conn, $sql_data);

    if ($sql_result && pg_num_rows($sql_result) > 0)  {
        ?>
        <table id='css-table'>
            <tr id='css-header-container'>
            <th class='css-header'> Author Name </th>
            <th class='css-header'> Gender </th>
            <th class='css-header'> Type of Author </th>
            <th class='css-header'> Affiliation </th>
            <th class='css-header'> Email </th>
            </tr>
        <?php

        while ($row = pg_fetch_assoc($sql_result)) {
            ?>
            <tr class='css-tr'>
                <td class='css-td'><?= $row['author_name'] ?></td>
                <td class='css-td'><?= $row['gender'] ?></td>
                <td class='css-td'><?= $row['type_of_author'] ?></td>
                <td class='css-td'><?= $row['affiliation'] ?></td>
                <td class='css-td'><?= $row['email'] ?></td>
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
                window.location.href = 'author-profile.php';
            });
        </script>
        <?php
    }
} else {
    ?>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'No results found',
            text: 'No Results!',
            confirmButtonText: 'OK'
        }).then(() => {
            // Clear the search query and reload the page
            window.location.href = '../../admin/account/login.php';
        });
    </script>
    <?php
}
?>
