function submitPss() {
    // Get the necessary elements from the DOM
    var emailAddress = document.getElementById("userEmailAddressInput").value;
    var passwordInput = document.getElementsByClassName('passwordInput')[1].value;
    var confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
    var emailTooltip = document.getElementById("emailTooltip");
    var passwordTooltip = document.getElementById("passwordTooltip");
    var otpTextBox = document.getElementById("otpVerification").value;

    // Validate the email address format
    if (!/^[^@\s]+@g.batstate-u.edu.ph$/.test(emailAddress)) {
        emailTooltip.innerHTML = "Please use a valid email address!";
        emailTooltip.style.display = "inline-block";
        passwordTooltip.style.display = "none"; // hide password tooltip
        return;
    }

    // Check if the password and confirm password match
    if (passwordInput !== confirmPasswordInput) {
        passwordTooltip.innerHTML = 'Password does not match.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";
    } else if (passwordInput === '' || confirmPasswordInput === '') {
        // Check if the passwords are empty
        passwordTooltip.innerHTML = 'Passwords cannot be empty.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";
    } else {
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";

        // Send the OTP, email address, and password to the server for verification
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../account/functionalities/change-password.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "successful") {
                    // Redirect the user to a success page if the password change is successful
                    window.location.href = "login.php?edit=successful";
                    console.log(otpTextBox);
                } else {
                    // Redirect the user to an error page if there is an error during password change
                    window.location.href = "login.php?error=wrong";
                    console.log(otpTextBox);
                }
            }
        };
        xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) + "&password=" + encodeURIComponent(confirmPasswordInput));
    }
}
