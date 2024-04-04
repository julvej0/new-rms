<?php
require_once ('functionalities/publication-get-info.php');
require_once ('functionalities/publications_include/publication_count.php');


$table_rows = get_data($search, $type, $fund, $year, $page_number); // $table_rows is included from a ipa-get-info.php
$total_records = countPublications($search, $type, $fund, $year);
?>

<table>
    <thead>
        <tr>
            <th class="col-title" style="min-width: 350px;">Title</th>
            <th class="col-type">Type</th>
            <th class="col-publisher" style="min-width: 190px;">Publisher</th>
            <th class="col-research-area">Research Area</th>
            <th class="col-college">College</th>
            <th class="col-quartile">Quartile</th>
            <th class="col-campus">Campus</th>
            <th class="col-sdg">SDG's</th>
            <th class="col-date-published">Date Published</th>
            <th class="col-authors" style="min-width: 190px;">Authors</th>
            <th class="col-funding">Funding</th>
            <th class="col-fund-type">Fund Type</th>
            <th class="col-fund-agency">Fund Source</th>
            <th class="col-citations">Citations</th>
            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            if ($table_rows !== null && !empty($table_rows)) { // Check if $table_rows is not null
                foreach ($table_rows as $row) { // Loop through each row in $table_rows
                    ?>
                <tr>
                    <!--Displays the data from the database per column-->
                    <td class="publication-col col-title" style="min-width: 15.625rem">
                        <?= $row['title_of_paper']; ?>
                    </td>
                    <td class="publication-col col-type">
                        <?= $row['type_of_publication'] != null ? $row['type_of_publication'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-publisher">
                        <?= $row['publisher'] != null ? $row['publisher'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-research-area">
                        <?= $row['department'] != null ? $row['department'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-college">
                        <?= $row['college'] != null ? $row['college'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-quartile">
                        <?= $row['quartile'] != null ? $row['quartile'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-campus">
                        <?= $row['campus'] != null ? $row['campus'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-sdg">
                        <?= $row['sdg_no'] != null ? $row['sdg_no'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-date-published">
                        <?= $row['date_published'] != null ? $row['date_published'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-authors">
                        <?= $row['authors'] != null ? $row['authors'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-funding">
                        <?= $row['nature_of_funding'] != null ? $row['nature_of_funding'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-fund-type">
                        <?= $row['funding_type'] != null ? $row['funding_type'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-fund-agency">
                        <?= $row['funding_source'] != null ? $row['funding_source'] : "N/A"; ?>
                    </td>
                    <td class="publication-col col-citations">
                        <?= $row['number_of_citation'] != null ? $row['number_of_citation'] : "N/A"; ?>
                    </td>

                    <td class='pb-action-btns stickey-col'>
                        <?php
                        // Check if the $google_link is empty which is prioritized by the redirect button
                        $google_link = $row['google_scholar_details'];
                        if (empty($google_link)) { // If the $google_link is empty, set $google_link to null
                            $google_link = null;
                        }
                        ?>
                        <!--If the $google_link == null, the value will be no_url which is needed to trigger SweetAlert2-->
                        <a onclick="redirect('<?= $google_link != null ? $google_link : '../../../../../components/error-not-found/error-not-found.php'; ?>')"
                            class="gdrive-btn" title="Click to Redirect">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        <form action="../publications/edit/edit-publication.php" method="POST">
                            <input type="hidden" name="row_id" value="<?= $row['publication_id'] ?>">
                            <button type="submit" class="edit-btn" name="edit"><i class="fas fa-pen-to-square icon"
                                    title="Click to Edit"></i></button>
                        </form>
                        <!--Onclick calls the confirmDelete() function with the registration number as a parameter-->
                        <button class="delete-btn" name="delete" onclick="confirmDelete('<?= $row['publication_id'] ?>')"
                            title="Click to Delete"><i class="fas fa-trash-can"></i></button>
                    </td>
                </tr>
                <?php
                }
            } else {
                ?>
            <tr>
                <td colspan='15' style="text-align:center">No Records Found!</td>
                <!--If the $table_rows is empty, this will display instead of the table-->
            </tr>
            <?php
            }
            ?>
    </tbody>
</table>