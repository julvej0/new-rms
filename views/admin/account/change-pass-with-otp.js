function submitPss() {
    // Get input values from the HTML elements
    var emailAddress = document.getElementById("userEmailAddressInput").value;
    var passwordInput = document.getElementsByClassName('passwordInput')[1].value;
    var confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
    var emailTooltip = document.getElementById("emailTooltip");
    var passwordTooltip = document.getElementById("passwordTooltip");
    var otpTextBox = document.getElementById("otpVerification").value;
    var disableSubmitPassword = document.getElementById('submit-password');
  
    // Disable the submit password button
    disableSubmitPassword.disabled = true;
  
    // Validate the email address
    if (!/^[^@\s]+@g.batstate-u.edu.ph$/.test(emailAddress)) {
      emailTooltip.innerHTML = "Please use a valid email address!";
      emailTooltip.style.display = "inline-block";
      passwordTooltip.style.display = "none"; // hide password tooltip
      return;
    }
  
    // Validate the password and confirm password inputs
    if (passwordInput !== confirmPasswordInput) {
      passwordTooltip.innerHTML = 'Password does not match.';
      passwordTooltip.style.display = "block";
      emailTooltip.style.display = "none";
    } else if (passwordInput.length < 8 || confirmPasswordInput.length < 8) {
      passwordTooltip.innerHTML = 'Please enter at least 8 characters.';
      passwordTooltip.style.display = "block";
      emailTooltip.style.display = "none";
    } else if (passwordInput === '' || confirmPasswordInput === '') {
      passwordTooltip.innerHTML = 'Passwords cannot be empty.';
      passwordTooltip.style.display = "block";
      emailTooltip.style.display = "none";
    } else {
      // Password inputs are valid
      passwordTooltip.style.display = "block";
      emailTooltip.style.display = "none";
  
      // Send the OTP, email address, and new password to change-password.php using AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../account/functionalities/change-password.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "successful") {
                // Display a success message using Swal (SweetAlert)
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                  }
                });
              
                Toast.fire({
                  icon: 'success',
                  title: 'Password Changed Successfully'
                });
              
                // Redirect to the login page after 3 seconds
                setTimeout(() => {
                  window.location.href = "login.php";
                }, 3000);
              
                console.log(otpTextBox);
              } else {
                // Display an error message using Swal (SweetAlert)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Wrong OTP, Please Try Again.',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    // Redirect to the login page
                    window.location.href = "login.php";
                  }
                });
              
                console.log(otpTextBox);
              }
        }
      };
  
      // Send the data to the server for password change
      xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) + "&password=" + encodeURIComponent(confirmPasswordInput));
    }
  }
  