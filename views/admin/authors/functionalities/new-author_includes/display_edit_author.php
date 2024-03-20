<?php

$author_info_arr = []; //initialize
include_once dirname(__FILE__, 5) . "/helpers/utils/utils-author.php";
//check if id exists, if exists user is editing
if (isset ($_GET['id'])) {
    $id = $_GET['id'];
    $row = getAuthorById($authorurl, $id);
    if ($row != null) {
        $author_info_arr[] = array(
            'author_id' => $row['author_id'],
            'author_name' => $row['author_name'],
            'gender' => $row['gender'],
            'type_of_author' => $row['type_of_author'],
            'affiliation' => isset ($row['affiliation']) ? $row['affiliation'] : null,
            'email' => $row['email']
        );
    }
} else {
    //author is adding a new entry
    $author_info_arr[] = array(
        'author_id' => '',
        'author_name' => '',
        'gender' => '',
        'type_of_author' => '',
        'affiliation' => '',
        'email' => ''

    );
}


//displaying affiliation
function display_edit_aff($table_rows, $campus_options, $program_options)
{
    if (!is_null($table_rows[0]['affiliation'])) {
        //extract internal and external affiliation
        $affiliation = explode(' || ', $table_rows[0]["affiliation"]);
        $internal = explode('_ ', $affiliation[0]);
        $external = explode('_ ', $affiliation[1]);

        //initialize
        $campus_affiliations = [];
        $program_affiliations = [];
        $department_affiliations = [];

        //extact campus, program, and department
        if ($internal[0] !== "") {
            foreach ($internal as $affiliation) {
                $affiliation_parts = explode(", ", $affiliation);
                $department_affiliations[] = $affiliation_parts[0];
                $program_affiliations[] = $affiliation_parts[1];
                $campus_affiliations[] = $affiliation_parts[2];
            }

            //display internal affiliation
            for ($i = 0; $i < count($campus_affiliations); $i++) {
                echo '
                    <td>
                        <div class="form-control aff-info">
                            <label class="a-label" for="a-aff-dept">Department</label>
                            <input type="text" class="a-aff-dept" name="a-aff-dept[]" placeholder="Department" required value="' .
                    $department_affiliations[$i] . '">
                        </div>
                        <div class="form-control aff-categ">
                            <label class="a-label" for="a-aff-prog">Program</label>
                            <select name="a-aff-prog[]" class="a-aff-prog" required>';
                //display option from array
                foreach ($program_options as $option) {
                    if ($option == $program_affiliations[$i]) {
                        echo '<option value="' . $option . '" selected>' . $option . '</option>'; //if option was seleted, echo selected
                    } else {
                        echo '<option value="' . $option . '">' . $option . '</option>';
                    }
                }
                echo '</select>
                    </div>
                    <div class="form-control aff-categ">
                        <label class="a-label" for="a-aff-camp">Campus</label>
                        <select name="a-aff-camp[]" class="a-aff-camp" required>';
                foreach ($campus_options as $option) {
                    if ($option == $campus_affiliations[$i]) {
                        echo '<option value="' . $option . '" selected>' . $option . '</option>'; //if option was seleted, echo selected
                    } else {
                        echo '<option value="' . $option . '">' . $option . '</option>';
                    }
                }
                echo '</select>
                    </div>
                    <button class="a-remove-btn" type="button">x</button>
                    </td>';
            }
        }

        //display external affiliation
        if ($external[0] !== "") {
            foreach ($external as $affiliation) {
                echo '<td>
                    <div class="form-control aff-info">
                        <label class="a-label" for="a-ex-aff">External Affiliation</label>
                        <input type="text" class="a-ex-aff" name="a-ex-aff" placeholder="Affiliation" value="' . $affiliation . '"required>
                    </div>
                    <button class="a-remove-btn" type="button">x</button>
                </td>';
            }
        }

    }

}
?>