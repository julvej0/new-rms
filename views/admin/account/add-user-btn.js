

function confirmBtn() {
    var emailAddress = document.getElementById('userEmailAddressInput').value;
    var otpTextBox = document.getElementById("otpVerification").value;
    var srCode = document.getElementById('userSrCode').value;
    var confirmPassword = document.getElementById("confirmedPassword").value;
    
  
    // send the OTP and email address to verify_otp.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../account/functionalities/verification.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        if (xhr.responseText === "success") {
          // redirect the user to a success page
          window.location.href = "login.php?add=correct";
          console.log(otpTextBox);
  
        } else {
          // display an error message
          alert('Wrong OTP, Please Try Again');
          console.log(otpTextBox);
  
        }
      }
    };
    xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) + "&srcode=" + encodeURIComponent(srCode) + "&password=" + encodeURIComponent(confirmPassword));
  }