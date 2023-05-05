function confirmBtn() {
  var emailAddress = document.getElementById('userEmailAddressInput').value;
  var otpTextBox = document.getElementById("otpVerification").value;
  var srCode = document.getElementById('userSrCode').value;
  var confirmPassword = document.getElementById("confirmedPassword").value;
  var disableConfirmBtn = document.getElementById('btnSubmit');
  var fname = document.getElementById('fName').value;
  var lname = document.getElementById('lName').value;
  var mname = document.getElementById('mName').value;
  disableConfirmBtn.disabled = true;

  // Convert the first letter of each word in fname, lname, and mname to uppercase
  fname = fname.split(' ').map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
  lname = lname.split(' ').map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');
  mname = mname.split(' ').map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(' ');

  // send the OTP and email address to verify_otp.php
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../account/functionalities/verification.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      if (xhr.responseText === "success") {

        // redirect the user to a success page
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        
        Toast.fire({
          icon: 'success',
          title: 'Account Created Successfully'
        })
        // Redirect to login page after 3 seconds
        setTimeout(() => {
          window.location.href = "login.php";
        }, 3000);
        console.log(otpTextBox);

      } else {
        // display an error message
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Wrong OTP, Please Try Again.',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'OK'
        });
        console.log(otpTextBox);

      }
    }
  };
  xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) + "&srcode=" + encodeURIComponent(srCode) + "&password=" + encodeURIComponent(confirmPassword) + "&fname=" + encodeURIComponent(fname) + "&lname=" + encodeURIComponent(lname)+ "&mname=" + encodeURIComponent(mname));
}
