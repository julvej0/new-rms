function checkdata() {
    // Get the values of the email address and password inputs
    var emailAddress = document.getElementById('login_email').value;
    var passwordInput = document.getElementById('login_password').value;
  
    console.log(emailAddress);
  
    // Check if the email address or password input is empty
    if (emailAddress == '' || passwordInput == '') {
      // Display an error message using Swal (SweetAlert)
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please enter your email/password',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
      });
  
      // Return false to prevent form submission
      return false;
    } else {
      // Return true to allow form submission
      return true;
    }
  }
  