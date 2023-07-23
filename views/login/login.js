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
    if (email.value === '' || pass.value === '' || confirmpass.value === '' || otpBox.value === '' || disableotpInput.value === '') {
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
    setTimeout(function () {
        modal.querySelector(".modal-container").style.transform = "translate(-50%, -50%)";
    }, 10);
}

let loginForm = document.getElementById("user_input");
loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let emailAddress = document.getElementById("login_email").value;
    let password = document.getElementById("login_password").value;

    if (emailAddress == "" || password == "") {
        // Display an error message using Swal (SweetAlert)
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please enter your email/password",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
        });

        return false;
    } else {
        getUserWithEmail(emailAddress).then((resp) => {
            if (resp["user"] != undefined || resp["user"] != null) {
                let userObj = resp["user"];

                verifyUserPassword(password, resp["user"]["password"]).then((resp2) => {
                    if (resp2["password_valid"]) {
                        let userFullName = userObj['user_fname'] + " " + userObj['user_mname'] + " " + userObj['user_lname'];

                        initSession(userObj["email"], userObj["account_type"], userFullName).then((resp3) => {
                            if (resp3["status"] == "success") {
                                // check account type and redirect accordingly

                                if (userObj["account_type"] === 'Admin') {
                                    window.location.href = "../admin/dashboard/dashboard.php";
                                } else {
                                    window.location.href = "../public-user/home/home.php";
                                }
                            }
                        });
                    } else {
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        }).fire({
                            icon: 'error',
                            title: 'Login Failed'
                        });
                    }
                });
            } else {
                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                }).fire({
                    icon: 'error',
                    title: 'Login Failed'
                });
            }
        });
    }
});

async function getUserWithEmail(email) {
    return $.ajax({
        type: "post",
        url: "./functionalities/get-user-with-email.php",
        dataType: "json",
        data: { user_email: email }
    });
}

async function verifyUserPassword(userPassword, hashedPassword) {
    return $.ajax({
        type: "post",
        url: "./functionalities/verify-password.php",
        dataType: "json",
        data: { user_password: userPassword, user_hashed_password: hashedPassword }
    });
}

async function initSession(userEmail, userAccountType, userFullName) {
    return $.ajax({
        type: "post",
        url: "./functionalities/init-current-session.php",
        dataType: "json",
        data: { user_email: userEmail, account_type: userAccountType, user_name: userFullName }
    });
}