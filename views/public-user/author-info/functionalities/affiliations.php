<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var max = 16; // max number of affiliations is 15

        function addInternalRow() {
            if ($('#affiliation-tbl-body td').length < max) {
                var internalRow = '\
                    <td>\
                        <div class="form-control aff-info">\
                            <label class="a-label" for="a-aff-dept">Department</label>\
                            <input type="text" class="a-aff-dept" name="a-aff-dept[]" placeholder="Department" required>\
                        </div>\
                        <div class="form-control aff-categ">\
                            <label class="a-label" for="a-aff-prog">Program</label>\
                            <select name="a-aff-prog[]" class="a-aff-prog" required>\
                                <option value="" hidden>--Choose from the options--</option>\
                            </select>\
                        </div>\
                        <div class="form-control aff-categ">\
                            <label class="a-label" for="a-aff-camp">Campus</label>\
                            <select name="a-aff-camp[]" class="a-aff-camp" required>\
                                <option value="" hidden>--Choose from the options--</option>\
                            </select>\
                        </div>\
                        <button class="a-remove-btn" type="button">x</button>\
                    </td>';
                $('#affiliation-tbl-body').append(internalRow);
            } else {
                alert('You have reached the maximum number of affiliations');
            }
        }

        function addExternalRow() {
            if ($('#affiliation-tbl-body td').length < max) {
                var externalRow = '<td>\
                        <div class="form-control aff-info">\
                            <label class="a-label" for="a-ex-aff">External Affiliation</label>\
                            <input type="text" class="a-ex-aff" name="a-ex-aff" placeholder="Affiliation" required>\
                        </div>\
                        <button class="a-remove-btn" type="button">x</button>\
                    </td>';
                $('#affiliation-tbl-body').append(externalRow);
            } else {
                alert('You have reached the maximum number of affiliations');
            }
        }

        function removeAffiliationRow() {
            $(this).closest('td').remove();
        }

        $('#affiliation-tbl').on('click', '#internal-btn', addInternalRow);
        $('#affiliation-tbl').on('click', '#external-btn', addExternalRow);
        $('#affiliation-tbl').on('click', '.a-remove-btn', removeAffiliationRow);
    });
</script>


<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var max = 16; // max number of affiliations is 15

    function addInternalRow() {
        if ($('#affiliation-tbl-body td').length < max) {
            var internalRow = '\
                <td>\
                    <div class="form-control aff-info">\
                        <label class="a-label" for="a-aff-dept">Department</label>\
                        <input type="text" class="a-aff-dept" name="a-aff-dept[]" placeholder="Department" required>\
                    </div>\
                    <div class="form-control aff-categ">\
                        <label class="a-label" for="a-aff-prog">Program</label>\
                        <select name="a-aff-prog[]" class="a-aff-prog" required>\
                            <option value="" hidden>--Choose from the options--</option>\
                                <?php 
                                    foreach ($program_options as $option) {
                                        
                                        echo '<option value="'.$option.'" >'.$option.'</option>';
                                    }
                                ?>
                        </select>\
                    </div>\
                    <div class="form-control aff-categ">\
                        <label class="a-label" for="a-aff-camp">Campus</label>\
                        <select name="a-aff-camp[]" class="a-aff-camp" required>\
                            <option value="" hidden>--Choose from the options--</option>\
                                <?php 
                                    foreach ($campus_options as $option) {
                                        echo '<option value="'.$option.'" >'.$option.'</option>';
                                    }
                                ?>
                        </select>\
                    </div>\
                    <button class="a-remove-btn" type="button">x</button>\
                    </td>';
            $('#affiliation-tbl-body').append(internalRow);
        }
        else{
            alert('You reached maximum number of affiliation')
        }
    }
    
    function addExternalRow() {
        if ($('#affiliation-tbl-body td').length < max) {
            var externalRow = '<td>\
                    <div class="form-control aff-info">\
                        <label class="a-label" for="a-ex-aff">External Affiliation</label>\
                        <input type="text" class="a-ex-aff" name="a-ex-aff" placeholder="Affiliation" required>\
                    </div>\
                    <button class="a-remove-btn" type="button">x</button>\
                    </td>';
            $('#affiliation-tbl-body').append(externalRow);
        }
        else{
            alert('You reached maximum number of affiliation') 
        }
    }

    function removeAffiliationRow() {
        $(this).closest('td').remove();
    }
  
    $('#affiliation-tbl').on('click', '#internal-btn', addInternalRow);
    $('#affiliation-tbl').on('click', '#external-btn', addExternalRow);
    $('#affiliation-tbl').on('click', '.a-remove-btn', removeAffiliationRow);
</script> -->
