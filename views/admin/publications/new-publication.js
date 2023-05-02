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
        history.back(-1);
    }
    })
})


// sdg limit selection

function chooseOneSDG() {
  var checkboxes = document.getElementsByName('sdg_no[]');
  var isChecked = false;
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
          isChecked = true;
          break;
      }
  }
  if (!isChecked) {
      // alert('Please select at least one SDG.');
      var errorMessage = document.querySelector(".error");
      errorMessage.style.display = "block";
      errorMessage.innerHTML = 'Please select at least one SDG.';
      errorMessage.style.color = 'red'; // optional styling
      return false;
  }
  return true;
}

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

// ADD AUTHOR
// const addBtn = document.getElementById("pb-add-btn");

//   addBtn.addEventListener("click", (e) => {
//     e.preventDefault();
//     const firstTd = document.querySelector(".author-table-container td");

//     const newTd = firstTd.cloneNode(true);

//     const addBtnInNewTd = newTd.querySelector("#pb-add-btn");

//     const removeBtn = document.createElement("button");
//     removeBtn.id = "pb-remove-btn";
//     removeBtn.textContent = "-";
//     removeBtn.style.background = 'red';
//     removeBtn.addEventListener("click", () => {
//       newTd.remove();
//     });
//     addBtnInNewTd.replaceWith(removeBtn);

//     const tableBody = document.querySelector(".author-table-container tbody");
//     const newRow = document.createElement("tr");
//     newRow.appendChild(newTd);
//     tableBody.appendChild(newRow);
//   });



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

  // internalFundingRadio.disabled = true;
  // externalFundingRadio.disabled = true;
  // fundingAgencyField.disabled = true;
  // fundingAgencyField.value = "";
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

nonFundedRadio.addEventListener("click", disableFields);
fundedRadio.addEventListener("click", enableTypeOfFunding);
internalFundingRadio.addEventListener("click", disableFundingAgency);
externalFundingRadio.addEventListener("click", enableFundingAgency);

disableFields();  // disable the fields on page load