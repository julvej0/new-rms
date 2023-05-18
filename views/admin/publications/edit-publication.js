// CANCEL MODAL

const cancelBtn = document.querySelector('.cancel-btn');

cancelBtn.addEventListener('click', (e) => {
  e.preventDefault();
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
      window.location.href = "publications.php";
    }
    })
})


// sdg limit selection

function limitSelection() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const errorMessage = document.querySelector(".error");
  let max = 0;
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      max++;
      if (max > 5) {
        checkboxes[i].checked = false;
        checkboxes[i].disabled = true;
        errorMessage.style.display = "block";
        errorMessage.innerHTML = "You can select up to 5 options only";
      }
    } else {
      checkboxes[i].disabled = false;
    }
  if (max <= 5) {
    errorMessage.innerHTML = "";
  }
  }
  if(errorMessage.innerHTML === "Please select at least one SDG."){
      document.location.href = "#sdg";
    }
}
  // DISABLE INPUT

  //FUNDING SCRIPTS
const fundedRadio = document.getElementById("funded");
const nonFundedRadio = document.getElementById("non-funded");
const internalFundingRadio = document.getElementById("internal");
const externalFundingRadio = document.getElementById("external");

const typeOfFundingLabel = document.getElementById("fund-type-label");
const fundingAgencyField = document.getElementById("pb-funding-agency");

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
function nonFundedClick() {
    typeOfFundingLabel.style.color = "gray";
    fundingAgencyField.style.color = "gray";
    internalFundingRadio.disabled = true;
    externalFundingRadio.disabled = true;
    fundingAgencyField.disabled = true;
    fundingAgencyField.value = "";

}

function enableTypeOfFunding() {
  typeOfFundingLabel.style.color = "black";
  internalFundingRadio.disabled = false;
  externalFundingRadio.disabled = false;
  // fundingAgencyField.disabled = true;
  fundingAgencyField.value = "";  // clear the field
}


function disableFundingAgency() {
  fundingAgencyField.disabled = true;
  fundingAgencyField.value = "";
}

function enableFundingAgency() {
  fundingAgencyField.disabled = false;
  fundingAgencyField.value = "";
}

nonFundedRadio.addEventListener("click", nonFundedClick);
fundedRadio.addEventListener("click", enableTypeOfFunding);
internalFundingRadio.addEventListener("click", disableFundingAgency);
externalFundingRadio.addEventListener("click", enableFundingAgency);

disableFields();  // disable the fields on page load