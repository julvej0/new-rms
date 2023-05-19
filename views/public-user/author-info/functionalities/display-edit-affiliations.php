<?php


function display_edit_aff($author_affiliations, $campus_options, $program_options){
    if(!is_null($author_affiliations)){
                                        
        $affiliation = explode(' || ', $table_rows[0]["affiliation"]);
        $internal = explode('_ ', $affiliation[0]);
        $external = explode('_ ', $affiliation[1]);


        $campus_affiliations = [];
        $program_affiliations = [];
        $department_affiliations = [];

        if($internal[0]!==""){
            foreach ($internal as $affiliation) {
                $affiliation_parts = explode(", ", $affiliation);
                $department_affiliations[] = $affiliation_parts[0];
                $program_affiliations[] = $affiliation_parts[1];
                $campus_affiliations[] = $affiliation_parts[2];
            }
    
            for ($i = 0; $i < count($campus_affiliations); $i++) {
                echo '
                    <td>
                        <div class="form-control aff-info">
                            <label class="a-label" for="a-aff-dept">Department</label>
                            <input type="text" class="a-aff-dept" name="a-aff-dept[]" placeholder="Department" required value="'.
                                $department_affiliations[$i].'">
                        </div>
                        <div class="form-control aff-categ">
                            <label class="a-label" for="a-aff-prog">Program</label>
                            <select name="a-aff-prog[]" class="a-aff-prog" required>';
                                foreach ($program_options as $option) {
                                    if ($option == $program_affiliations[$i]) {
                                        echo '<option value="'.$option.'" selected>'.$option.'</option>';
                                    } else {
                                        echo '<option value="'.$option.'">'.$option.'</option>';
                                    }
                                }
                        echo   '</select>
                    </div>
                    <div class="form-control aff-categ">
                        <label class="a-label" for="a-aff-camp">Campus</label>
                        <select name="a-aff-camp[]" class="a-aff-camp" required>';
                            foreach ($campus_options as $option) {
                                if ($option == $campus_affiliations[$i]) {
                                    echo '<option value="'.$option.'" selected>'.$option.'</option>';
                                } else {
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                            }
                        echo '</select>
                    </div>
                    <button class="a-remove-btn" type="button">x</button>
                    </td>';
            }
        }
       

        if($external[0]!==""){
            foreach ($external as $affiliation) {
                echo '<td>
                    <div class="form-control aff-info">
                        <label class="a-label" for="a-ex-aff">External Affiliation</label>
                        <input type="text" class="a-ex-aff" name="a-ex-aff" placeholder="Affiliation" value="'.$affiliation.'"required>
                    </div>
                    <button class="a-remove-btn" type="button">x</button>
                </td>';
            }
        }
        
    }

}
?>