
function loginBtn () {
    var emailAddress = document.getElementById('email').value;
    var passwordInput = document.getElementsByClassName('passwordInput')[0].value;

    

      // send the OTP and email address to verify_otp.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "functionalities/login-account.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        if (xhr.responseText === "success") {
            // redirect the user to a success page
            window.location.href = "../../../views/admin/account-management/user-profile.php";
            console.log(xhr.responseText)

        } else {
            // display an error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Incorrect Email or Password',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
                console.log(xhr.responseText)
        }
        }
    };
    xhr.send("email=" + encodeURIComponent(emailAddress) + "&password=" + encodeURIComponent(passwordInput));
}

  

