// CANCEL MODAL
const cancelBtn = document.querySelector('.cancel-btn');

// Add click event listener to cancel button
cancelBtn.addEventListener('click', (e) => {
  e.preventDefault();
  
  // Show confirmation modal using Swal library
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to cancel?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.isConfirmed) {
      // If confirmed, navigate to "publications.php"
      window.location.href = "publications.php";
    }
  });
});

// Function to limit checkbox selection
function limitSelection() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const errorMessage = document.querySelector(".error");
  let max = 0;
  
  // Loop through checkboxes
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      max++;
      
      // Check if maximum selection limit (5) is exceeded
      if (max > 5) {
        checkboxes[i].checked = false;
        checkboxes[i].disabled = true;
        errorMessage.style.display = "block";
        errorMessage.innerHTML = "You can select up to 5 options only";
      }
    } else {
      checkboxes[i].disabled = false;
    }
    
    // Reset error message if the maximum limit is not exceeded
    if (max <= 5) {
      errorMessage.innerHTML = "";
    }
  }
  
  // Scroll to the SDG section if "Please select at least one SDG" error is displayed
  if (errorMessage.innerHTML === "Please select at least one SDG.") {
    document.location.href = "#sdg";
  }
}

// Constants for radio buttons and input fields
const fundedRadio = document.getElementById("funded");
const nonFundedRadio = document.getElementById("non-funded");
const internalFundingRadio = document.getElementById("internal");
const externalFundingRadio = document.getElementById("external");

const typeOfFundingLabel = document.getElementById("fund-type-label");
const fundingAgencyField = document.getElementById("pb-funding-agency");

// Function to disable or enable fields based on funding selection
function disableFields() {
  typeOfFundingLabel.style.color = "gray";
  
  // Check if funding agency field has a value
  if (fundingAgencyField.value !== '') {
    // Enable fields for internal and external funding options
    fundingAgencyField.disabled = false;
    internalFundingRadio.disabled = false;
    externalFundingRadio.disabled = false;
  } else {
    // Disable fields and clear values
    fundingAgencyField.disabled = true;
    internalFundingRadio.disabled = true;
    externalFundingRadio.disabled = true;
    fundingAgencyField.value = "";
  }
}

// Function to handle click event for non-funded option
function nonFundedClick() {
  typeOfFundingLabel.style.color = "gray";
  fundingAgencyField.style.color = "gray";
  internalFundingRadio.disabled = true;
  externalFundingRadio.disabled = true;
  fundingAgencyField.disabled = true;
  fundingAgencyField.value = "";
}

// Function to enable type of funding options
function enableTypeOfFunding() {
  typeOfFundingLabel.style.color = "black";
  internalFundingRadio.disabled = false;
  externalFundingRadio.disabled = false;
  fundingAgencyField.value = ""; // Clear the field
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