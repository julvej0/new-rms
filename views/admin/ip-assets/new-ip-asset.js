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
      window.location.href = "ip-assets.php";
    }
    })
});

var inputElement = document.getElementById('reg_num');
var dataList = document.getElementById('regnums');
var errorMsg = document.getElementById('regnum-error');
var submit_button = document.getElementById('submitBTN');

inputElement.addEventListener('input', function() {
  var value = inputElement.value;
  var options = dataList.options;
  var exists = false;
  
  for (var i = 0; i < options.length; i++) {
    if (options[i].value === value) {
      exists = true;
      break;
    }
  }
  
  if (exists) {
    errorMsg.style.display = 'inline';
    submit_button.disabled = true;
    submit_button.style.backgroundColor = "gray";
  } else {
    errorMsg.style.display = 'none';
    submit_button.disabled = false;
    submit_button.style.backgroundColor = "var(--blue)";
  }
});