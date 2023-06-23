var disableotpInput = document.getElementById("otpVerification");
var disableSubmitBtn = document.getElementById('submit-password');
var email = document.getElementById("userEmailAddressInput");
var pass = document.getElementsByClassName('passwordInput')[1];
var confirmpass = document.getElementById('confirmPasswordInput');
var otpBox = document.getElementById('otpVerification');

disableotpInput.disabled = true;

email.addEventListener('input', validateForm);
pass.addEventListener('input', validateForm);
confirmpass.addEventListener('input', validateForm);
otpBox.addEventListener('input', validateForm);
disableotpInput.addEventListener('input', validateForm);

function validateForm() {
    if (email.value === '' || pass.value === '' || confirmpass.value === '' || otpBox.value ==='' || disableotpInput.value==='') {
        disableSubmitBtn.disabled = true;
        disableSubmitBtn.style.backgroundColor = "gray";
        disableSubmitBtn.style.pointerEvents = "none";
    } else {
        disableSubmitBtn.disabled = false;
        disableSubmitBtn.style.backgroundColor = "";
        disableSubmitBtn.style.pointerEvents = ""; 
        
    }
}

window.onload = validateForm;

//<!-------------------------------------------- SHOW MODAL PASSWORD --------------------------------------------------------------->

function showModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    setTimeout(function() {
        modal.querySelector(".modal-container").style.transform = "translate(-50%, -50%)";
    }, 10);
}

function checkdata() {
    // Get the values of the email address and password inputs
    var emailAddress = document.getElementById("login_email").value;
    var passwordInput = document.getElementById("login_password").value;

    console.log(emailAddress);

    // Check if the email address or password input is empty
    if (emailAddress == "" || passwordInput == "") {
        // Display an error message using Swal (SweetAlert)
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please enter your email/password",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
        });

        // Return false to prevent form submission
        return false;
    } else {
        // Return true to allow form submission
        return true;
    }
}
