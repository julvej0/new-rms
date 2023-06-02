var sendOtpLink = document.getElementById("sendOtpLink");

// Add a click event listener to the send OTP link/button
sendOtpLink.addEventListener("click", sendOtp);

function sendOtp() {
  // Get the value of the email input
  var emailInput = document.getElementById("userEmailAddressInput").value;
  console.log(emailInput);

  if (emailInput === "") {
    // Display an error message using Swal (SweetAlert) if the email input is empty
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please Enter Your Email Address",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
    });
  } else {
    // Disable the send OTP button and enable the OTP input
    var disableotpInput = document.getElementById("otpVerification");
    var sendOtpLink = document.getElementById("sendOtpLink");
    sendOtpLink.disabled = true;
    disableotpInput.disabled = false;

    // Start the timer for OTP resend countdown
    var timeLeft = 300; // in seconds
    var timerId = setInterval(function () {
      if (timeLeft <= 0) {
        // Enable the send OTP button and stop the timer when countdown reaches 0
        sendOtpLink.disabled = false;
        clearInterval(timerId);
      } else {
        // Update the timer display
        sendOtpLink.textContent = "Resend OTP in " + timeLeft + "s";
        timeLeft--;
      }
    }, 1000);

    // Send the emailInput value to sendcode.php using XMLHttpRequest
    //TODO: search for how to get reference to the base project folder for ease of
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./../../helpers/send-code.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        console.log("try otp sending");
        //TODO: check why this code considers a failed attempt ok
        if (xhr.readyState === XMLHttpRequest.DONE) {
            const status = xhr.status;

            console.log("status: " + status);
            if (status === 0 || (status >= 200 && status < 400)) {
              // Display a success message using Swal (SweetAlert) when OTP is sent successfully
              Swal.fire({
                icon: "success",
                title: "OTP Sent",
                text: "OTP has been sent to your email " + emailInput,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
              });
            }
        }
    };
    xhr.addEventListener("error", (event) => {
        console.log("error " + event);
    });

    xhr.send("textValue=" + emailInput);
  }
}
