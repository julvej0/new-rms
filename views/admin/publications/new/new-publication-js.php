<script>
$(document).ready(function() {
  // Listen for changes to the select fields
  $(document).on('change', 'input[name="author_name[]"]', function() {
    checkDuplicateAuthors(); // Call the comparison function
  });

  // Handle form submission
  $('#form-pb').submit(function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Check for empty fields
    var emptyFields = $('input, select, radio, checkbox').filter(function() {
      return $(this).val().trim() === '';
    });

    if (emptyFields.length > 2) {
      // Display Swal.fire confirmation dialog for incomplete IP Asset information
      Swal.fire({
        title: 'Are you sure?',
        text: 'The Publication you provided is incomplete. Save anyways?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          // Programmatically trigger the form submission
          this.submit();
        }
      });
    } else {
      // All fields are filled, submit the form
      this.submit();
    }
  });
});

  var max = 15; // Maximum number of Authors
  var x = 1; // Represents the 1st author field
  var rowHtml = '<tr>\
      <td class="ipa-author-field">\
        <?php
          $query = "SELECT author_id, author_name FROM table_authors";
          $params = array();
          $result = pg_query_params($conn, $query, $params);
          echo '<input list="authors" name="author_name[]" style="width: 100%; height: 50px; padding: 10px 36px 10px 16px; border-radius: 5px; border: 1px solid var(--dark-grey);" placeholder="Author Name..." onchange="showAuthorId(this)">';
          echo '<datalist id="authors">'; 
          while ($row = pg_fetch_assoc($result)) { 
            echo '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>'; 
          } 
          echo '</datalist>'; 
        ?>
      </td>\
      <td class="ipa-author-field" style="text-align:center;"><button name="remove" style="height: 50px; width:3.7rem; border-radius: 5px; border: none; padding: 0 20px; background: var(--primary); color: var(--light); font-size: 25px; font-weight: 600; cursor: pointer; letter-spacing: 1px; font-weight: 600;" id="remove"><i class="fas fa-xmark fa-xs"></i></button></td>\
    </tr>';

  // Add row function
  $('.add-row-btn').click(function() {
    if (x < max) {
      $('#author-tbl-body').append(rowHtml);
      x++;
    }
  });

  // Remove row function
  $('#author-tbl-body').on('click', 'button[name="remove"]', function(event) {
    $(this).closest('tr').remove();
    checkDuplicateAuthors();
    x--;
  });


function checkDuplicateAuthors() {
  var authors = {};
  var authorInputs = document.querySelectorAll('input[name="author_name[]"]');
  var errorMsg = document.getElementById('error-msg');
  var submitButton = document.getElementById('submitBTN');
  var duplicate = false;

  for (var i = 0; i < authorInputs.length; i++) {
    var input = authorInputs[i];
    var id = input.value.toLowerCase();

    // Exclude empty input values from duplicate check
    if (id.trim() === '') {
      continue;
    }

    if (id in authors) {
      duplicate = true;
      input.focus(); // Focus on the input field with duplicate value
      errorMsg.style.display = 'inline'; // Show the error message
      submitButton.disabled = true; // Disable the submit button
      submitButton.style.backgroundColor = 'gray'; // Set the background color to gray
      break; // Exit the loop if duplicate is found
    } else {
      authors[id] = true;
    }
  }

  if (!duplicate) {
    errorMsg.style.display = 'none'; // Hide the error message if no duplicates found
    submitButton.disabled = false; // Enable the submit button
    submitButton.style.backgroundColor = 'var(--blue)'; // Reset the background color
  }

  return !duplicate; // Return false to prevent form submission if duplicate is found
}

document.addEventListener('DOMContentLoaded', function() {
  // Get all author input elements
  var authorInputs = document.querySelectorAll('input[name="author_name[]"]');

  // Attach event listener to each author input
  for (var i = 0; i < authorInputs.length; i++) {
    authorInputs[i].addEventListener('input', checkDuplicateAuthors);
  }
});


</script>