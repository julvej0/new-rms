<?php
require_once('functionalities/ipa-get-info.php');
require_once('functionalities/ipa_include/ipa_count.php');

$additionalQuery = authorSearch($authorurl, $search);
$table_rows = get_data($conn, $additionalQuery, $search, $type, $class, $year, $page_number); // $table_rows is included from a ipa-get-info.php

$total_records = countIPA($conn, $additionalQuery, $search, $type, $class, $year);
?>

<table>
    <thead>
        <tr>
            <th class="col-registration">Registration Number</th>
            <th class="col-title" style="min-width: 350px;">Title</th>
            <th class="col-type">Type</th>
            <th class="col-cow">Class of Work</th>
            <th class="col-date-cre">Date of Creation</th>
            <th class="col-date-reg">Date Registered</th>
            <th class="col-campus">Campus</th>
            <th class="col-college">College</th>
            <th class="col-program">Program</th>
            <th class="col-authors">Authors</th>
            <th class="col-status">Status</th>
            <th class='stickey-col-header' style="background-color: var(--grey);">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($table_rows !== null && !empty($table_rows)) { // Check if $table_rows is not null
            foreach ($table_rows as $row) { // Loop through each row in $table_rows
                ?>
                <tr>
                    <!--Displays the data from the database per column-->
                    <td class="reg-num-col col-registration">
                        <?= $row['registration_number'] ?>
                    </td>
                    <td class="title-col col-title">
                        <?= $row['title_of_work']; ?>
                    </td>
                    <td class="type-col col-type">
                        <?= $row['type_of_document'] != null ? $row['type_of_document'] : "N/A"; ?>
                    </td>
                    <td class="cow-col col-cow">
                        <?= $row['class_of_work'] != null ? $row['class_of_work'] : "N/A"; ?>
                    </td>
                    <td class="cre-col col-date-cre">
                        <?= $row['date_of_creation'] != null ? $row['date_of_creation'] : "N/A"; ?>
                    </td>
                    <td class="date-reg-col col-date-reg">
                        <?= $row['date_registered'] != null ? $row['date_registered'] : "N/A"; ?>
                    </td>
                    <td class="campus-col col-campus">
                        <?= $row['campus'] != null ? $row['campus'] : "N/A"; ?>
                    </td>
                    <td class="college-col col-college">
                        <?= $row['college'] != null ? $row['college'] : "N/A"; ?>
                    </td>
                    <td class="program-col col-program">
                        <?= $row['program'] != null ? $row['program'] : "N/A"; ?>
                    </td>
                    <td class="authors-col col-authors">
                        <?= $row['authors'] != null ? $row['authors'] : "N/A"; ?>
                    </td>
                    <td class="status-col col-status" style="text-transform: uppercase;">
                        <?= $row['status'] != null ? $row['status'] : "N/A"; ?>
                    </td>
                    <td class='pb-action-btns stickey-col'>

                        <?php
                        $dir = "functionalities/button_functions/";
                        $certificate = $row['certificate'];
                        $hyperlink = $row['hyperlink'];

                        // Check if the hyperlink is empty which is prioritized by the redirect button
                        if (empty($hyperlink)) {
                            // If the certificate is empty, set $hyperlink to null
                            if (empty($certificate)) {
                                $hyperlink = null;
                            } else {
                                // Set the hyperlink to the certificate file path
                                $hyperlink = $dir . $certificate;
                            }
                        }
                        ?>

                        <!--If the $hyperlink == null, the value will be no_url which is needed to trigger SweetAlert2-->
                        <a onclick="redirect('<?= $hyperlink != null ? $hyperlink : 'no_url'; ?>')" class="gdrive-btn"
                            title="Click to Redirect">
                            <i class="fas fa-arrow-up-right-from-square icon"></i>
                        </a>

                        <form action="edit-ipa.php" method="POST">
                            <input type="hidden" name="row_id" value="<?= $row['registration_number'] ?>">
                            <button type="submit" class="edit-btn" name="edit" title="Click to Edit"><i
                                    class="fas fa-pen-to-square"></i></button>
                        </form>
                        <!--Onclick calls the confirmDelete() function with the registration number as a parameter-->
                        <button class="delete-btn" name="delete" onclick="confirmDelete('<?= $row['registration_number'] ?>')"
                            title="Click to Delete"><i class="fas fa-trash-can"></i></button>

                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan='10' style="text-align:center">No Records Found!</td>
                <!--If the $table_rows is empty, this will display instead of the table-->
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>