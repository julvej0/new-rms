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

        console.log("emailRecepient: " + emailInput);
        prepareOTPSending(emailInput);
    }

    function prepareOTPSending(emailRecepient) {
        if (emailRecepient != "") {
            // generate a random verification code and store it in a session variable
            var verification_code = getRndInteger(100000, 999999); // change this to generate a code of desired length
            sessionStorage.setItem("verification_code", verification_code);
            console.log("otpCOde: " + verification_code);

            // send the verification code to the user's email
            var subject = "VERIFICATION CODE";
            var message =
                "This is your verification code: " + verification_code;

            console.log("Attempt email sending to " + emailRecepient);
            attempOTPSending(emailRecepient, subject, message).then((resp) => {
                if (resp["status"]) {
                    Swal.fire({
                        icon: "success",
                        title: "OTP Sent",
                        text: "OTP has been sent to your email " + emailInput,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: "OTP Sending Failed",
                    });
                }
            });
        } else {
            console.log("emailRecepient not set");
        }
    }

    function attempOTPSending(emailRecepient, subject, message) {
        return $.ajax({
            type: "POST",
            url: "../../helpers/send-mail.php",
            dataType: "json",
            data: {
                email_recepient: emailRecepient,
                subject: subject,
                message: message,
            },
        });
    }

    function getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
}
