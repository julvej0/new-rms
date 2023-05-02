
function submitPss() {
    var emailAddress = document.getElementById("userEmailAddressInput").value;
    var passwordInput = document.getElementsByClassName('passwordInput')[1].value;
    var confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
    var emailTooltip = document.getElementById("emailTooltip");
    var passwordTooltip = document.getElementById("passwordTooltip");
    var otpTextBox = document.getElementById("otpVerification").value;

    
    if (!/^[^@\s]+@g.batstate-u.edu.ph$/.test(emailAddress)) {
        emailTooltip.innerHTML = "Please use a valid email address!";
        emailTooltip.style.display = "inline-block";
        passwordTooltip.style.display = "none"; // hide password tooltip
        return;
    }

    if (passwordInput !== confirmPasswordInput) {
        passwordTooltip.innerHTML = 'Password does not match.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";
    } 
    else if ( passwordInput === '' || confirmPasswordInput ==='' ){
        passwordTooltip.innerHTML = 'Passwords cannot be Empty.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";
    }
    else {
        passwordTooltip.innerHTML = 'Passwords match.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";

        // send the OTP and email address to verify_otp.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../account/functionalities/change-password.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "successful") {
                // redirect the user to a success page
                window.location.href = "login.php?edit=successful";
                console.log(otpTextBox);

            } else {
                // display an error message
                window.location.href = "login.php?error=wrong";
                console.log(otpTextBox);

            }
            }
        };
        xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) + "&password=" + encodeURIComponent(confirmPasswordInput));
    }

}