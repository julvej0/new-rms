// sdg limit selection
function limitSelection() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const errorMessage = document.querySelector(".error");
  let max = 0;
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      max++;
      if (max > 5) {
        checkboxes[i].checked = false; // Uncheck the checkbox if limit is reached
        checkboxes[i].disabled = true;
        errorMessage.style.display = "block";
        errorMessage.innerHTML = "You can select up to 5 options only";
      }
    } else {
      checkboxes[i].disabled = false;
    }
  }
  if (max <= 5) {
    errorMessage.innerHTML = "";
  }
}