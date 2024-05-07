<!--Javascript syntax inside a separated php file to avoid JS and PHP conflicts if put in a js file-->
<script>
  let all_authors = [...document.querySelectorAll('#option')].map(option => option.value)

  function AddAuthor(author) {
    $.ajax({
        url: "./functionalities/add-author.php",
        type: 'POST',
        data: { author: author },
        dataType: 'json',
        success: function(response) {
            // Handle success response
            if(response.message == 'Author created successfully.'){
              all_authors.push(response.author)
              let authorNoString = response.author.replace(/\s/g, "")
              document.querySelector(`.${authorNoString}`).innerHTML = "&#x1F5F9"
              document.querySelector(`.${authorNoString}`).disabled = true
              Swal.fire({
                      title: 'Author "<b><i>' + author + '</i></b>" successfully added.',
                      text: 'The author has been successfully added to the database.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Ok'
                    })
            }else{
              Swal.fire({
                      title: 'Error Adding Author',
                      text: 'An error occurred while adding the author to the database.',
                      icon: 'error',
                      confirmButtonText: 'Ok'
                    })
            }
        },
        error: function() {
            Swal.fire({
                      title: 'Error',
                      text: 'Failed to add author. Please try again.',
                      icon: 'error',
                      confirmButtonText: 'Ok'
                    })
        }
    });
}
  $(document).ready(function() {
  // Listen for changes to the select fields
  $(document).on('change', 'input[name="author_name[]"]', function() {
    checkDuplicateAuthors(); // Call the comparison function
  });

  // Handle form submission
  $('#form-ipa').submit(function(event) {
    // Prevent the default form submission
    event.preventDefault();
    const authors = [...document.querySelectorAll('#ipa-author')].map( option => option.value)

    let exist = []
    for (const index in authors){
      if(!all_authors.includes(authors[index])){
        exist.push(authors[index])
      }
    }
    
    if(exist.length > 0){
      $.ajax({
        url: "./functionalities/get-authors.php",
        type: 'POST',
        data: { author: exist },
        dataType: 'json',
        success: function(response) {
            if (response != "") {
              $('#modalBody').empty();
              response.forEach(function(author) {
              let authorNoSpace = author.replace(/\s/g, "")
              let inputHtml = '<div class="authorGroup"><p>' + author + '</p><button onclick="AddAuthor(\'' + author + '\')" class="' + authorNoSpace + '">Add</button></div>';
        $('#modalBody').append(inputHtml);
      });
                      showModal()
                    } 
                },
                error: function() {
                  Swal.fire({
                      title: 'Error',
                      text: 'There is an Error',
                      icon: 'error',
                      showCancelButton: false,
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                    })
                }
            });
    }else{

      var emptyFields = $('input, select, radio').filter(function() {
        return $(this).val().trim() === '';
      });
  
      if (emptyFields.length > 2) {
        // Display Swal.fire confirmation dialog for incomplete IP Asset information
        Swal.fire({
          title: 'Are you sure?',
          text: 'The IP Asset information you provided is incomplete. Save anyways?',
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
    }
    // Check for empty fields 
  });
});

function showModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    setTimeout(function () {
        modal.querySelector(".modal-container").style.transform = "translate(-50%, -50%)";
    }, 10);
}

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
  var authorInputs = document.querySelectorAll('input[name="author_name[]"]');

  for (var i = 0; i < authorInputs.length; i++) {
    authorInputs[i].addEventListener('input', checkDuplicateAuthors);
  }
});

var max = 15; // Maximum number of authors
var x = 1; // Represents the index of the first author field
<?php
require_once dirname(__FILE__, 4) . "../helpers/utils/utils-author.php";
require_once dirname(__FILE__, 5) . "../helpers/db.php";
$result = getAuthors($authorurl);

$datalistHtml = '<input list="authors" id="ipa-author" name="author_name[]" style="width: 100%; height: 50px; padding: 10px 36px 10px 16px; border-radius: 5px; border: 1px solid var(--dark-grey);" placeholder="Author Name...">';
$datalistHtml .= '<datalist id="authors">';
foreach ($result as $key => $row) {
  $datalistHtml .= '<option value="' . $row['author_name'] . '">' . $row['author_id'] . '</option>';
}
$datalistHtml .= '</datalist>';
?>

var rowHtml = '<tr>\
                  <td class="ipa-author-field"><?php echo $datalistHtml; ?></td>\
                  <td class="ipa-author-field" style="text-align:center;"><button name="remove" style="height: 50px; width:3.7rem; border-radius: 5px; border: none; padding: 0 20px; background: var(--primary); color: var(--light); font-size: 25px; font-weight: 600; cursor: pointer; letter-spacing: 1px; font-weight: 600;"id="remove"><i class="fas fa-xmark fa-xs"></i></button> </td>\
              </tr>';

// Add row function
$('.add-row-btn').click(function() {
    if (x < max) {
        $('#author-tbl-body').append(rowHtml);
        x++;
    }
});

// Remove row function
$('#author-tbl-body').on('click', '#remove', function() {
    event.preventDefault();
    $(this).closest('tr').remove();
    checkDuplicateAuthors();
    x--;
});


//Auto Registration Number
// $(document).ready(function(){
//     // Get the input fields
//     const classOfWork = document.getElementById('class_of_work');
//     var today = new Date();
//     var year = today.getFullYear();

//     // Get the registration number field
//     const registrationNumber = document.getElementById('reg_num');

//     // Listen for changes to the IPA registration radio buttons
//     const ipaRegistration = document.getElementsByName('registerInfo');
//     ipaRegistration.forEach(function (radio) {
//         radio.addEventListener('change', function () {
//             if (this.value === 'not-registered') {
//                 // Generate the registration number
//                 const classOW = classOfWork.value.split(' ').join('');
//                 const yearNow = year.toString();
//                 const registration = classOW + yearNow + '-';
                
//                 // Set the registration number field value
//                 reg_num.value = registration;
//             } else {
//                 // Clear the registration number field value
//                 reg_num.value = '';
//             }
//         });
//     });
// });
</script>