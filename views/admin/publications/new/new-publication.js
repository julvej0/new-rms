// CANCEL MODAL

const cancelBtn = document.querySelector('.cancel-btn');

// Add event listener to the cancel button
cancelBtn.addEventListener('click', (e) => {
  e.preventDefault();

  // Display a confirmation dialog using SweetAlert library
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to cancel?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    // If the user confirms the cancellation
    if (result.isConfirmed) {
      // Redirect to "publications.php" page
      window.location.href = "publications.php";
    }
  });
});


function limitSelection() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const errorMessage = document.querySelector(".error");
  let max = 0;

  // Iterate through each checkbox
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      max++;

      // Check if maximum selection limit is exceeded
      if (max > 5) {
        checkboxes[i].checked = false;
        checkboxes[i].disabled = true;
        errorMessage.style.display = "block";
        errorMessage.innerHTML = "You can select up to 5 options only";
      }
    } else {
      checkboxes[i].disabled = false;
    }
  }

  // Clear error message if selection is within the limit
  if (max <= 5) {
    errorMessage.innerHTML = "";
  }

  // Scroll to the error message if "Please select at least one SDG" error is displayed
  if (errorMessage.innerHTML === "Please select at least one SDG.") {
    document.location.href = "#sdg";
  }
}

// Get radio button elements
const fundedRadio = document.getElementById("funded");
const nonFundedRadio = document.getElementById("non-funded");
const internalFundingRadio = document.getElementById("internal");
const externalFundingRadio = document.getElementById("external");

// Get label and input field elements
const typeOfFundingLabel = document.getElementById("fund-type-label");
const fundingAgencyField = document.getElementById("pb-funding-agency");

// Function to disable or enable funding fields based on input value
function disableFields() {
  typeOfFundingLabel.style.color = "gray";
  if (fundingAgencyField.value !== '') {
    fundingAgencyField.disabled = false;
    internalFundingRadio.disabled = false;
    externalFundingRadio.disabled = false;
  } else {
    fundingAgencyField.disabled = true;
    internalFundingRadio.disabled = true;
    externalFundingRadio.disabled = true;
    fundingAgencyField.value = "";
  }
}

// Function to handle click on non-funded radio button
function nonFundedClick() {
  typeOfFundingLabel.style.color = "gray";
  fundingAgencyField.style.color = "gray";
  internalFundingRadio.disabled = true;
  externalFundingRadio.disabled = true;
  fundingAgencyField.disabled = true;
  fundingAgencyField.value = "";
}

// Function to enable type of funding fields
function enableTypeOfFunding() {
  typeOfFundingLabel.style.color = "black";
  internalFundingRadio.disabled = false;
  externalFundingRadio.disabled = false;
  fundingAgencyField.value = "";  // clear the field
}

// Function to disable funding agency field
function disableFundingAgency() {
  fundingAgencyField.disabled = true;
  fundingAgencyField.value = "";
}

// Function to enable funding agency field
function enableFundingAgency() {
  fundingAgencyField.disabled = false;
  fundingAgencyField.value = "";
}

// Event listeners for radio button clicks
nonFundedRadio.addEventListener("click", nonFundedClick);
fundedRadio.addEventListener("click", enableTypeOfFunding);
internalFundingRadio.addEventListener("click", disableFundingAgency);
externalFundingRadio.addEventListener("click", enableFundingAgency);

disableFields();  // disable the fields on page load