var signUpSubmitBtn = null;
function signUpConfirmBtn() {
    // Get input values from the HTML elements
    var signUpEmailAddress = document.getElementById(
        "userEmailAddressInput"
    ).value;
    var signUpOtpVal = document.getElementById("otpVerification").value;
    var signUpSrCode = document.getElementById("userSrCode").value;
    var signUpPasswordVal = document.getElementById("confirmedPassword").value;
    signUpSubmitBtn = document.getElementById("btnSubmit");
    var signUpFname = document.getElementById("fName").value;
    var signUpLname = document.getElementById("lName").value;
    var signUpMname = document.getElementById("mName").value;

    // Disable the confirm button
    signUpSubmitBtn.disabled = true;

    // Convert the first letter of each word in fname, lname, and mname to uppercase
    signUpFname = signUpFname
        .split(" ")
        .map((s) => s.charAt(0).toUpperCase() + s.substring(1))
        .join(" ");
    signUpLname = signUpLname
        .split(" ")
        .map((s) => s.charAt(0).toUpperCase() + s.substring(1))
        .join(" ");
    signUpMname = signUpMname
        .split(" ")
        .map((s) => s.charAt(0).toUpperCase() + s.substring(1))
        .join(" ");

    // Send the OTP and email address to verify_otp.php using AJAX
    otpVerify(
        signUpEmailAddress,
        signUpOtpVal,
        signUpSrCode,
        signUpPasswordVal,
        signUpFname,
        signUpLname,
        signUpMname
    );
}

var redirectToLoginAfter = 3000;
// var serverIp = "192.168.101.90";
var serverIp = "localhost";
function otpVerify(email, otp, srCode, password, fname, lname, mname) {
    if (
        email != "" &&
        otp != "" &&
        srCode != "" &&
        password != "" &&
        fname != "" &&
        lname != "" &&
        mname != ""
    ) {
        // check if the OTP entered by the user matches the one sent to their email
        if (otp == sessionStorage.getItem("verification_code")) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });

            console.log("otp matched, creating new record");
            getPasswordHash(password).then((resp) => {
                fetch("http://" + serverIp + ":5000/table_user", {
                    method: "POST",
                    mode: "cors",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        sr_code: srCode,
                        email: email,
                        password: resp["hashed_password"],
                        account_type: "Regular",
                        user_fname: fname,
                        user_lname: lname,
                        user_mname: mname,
                    }),
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                })
                    .then((response) => {
                        response.json().then((data) => {
                            Toast.fire({
                                icon: "success",
                                title: "Account Creation Successful",
                            });
                            //clear session OTP
                            sessionStorage.removeItem("verification_code");

                            // Redirect to the login page after 3 seconds
                            setTimeout(() => {
                                window.location.href =
                                    getHostName() +
                                    "/new-rms-webdev/views/login/login.php";
                            }, redirectToLoginAfter);
                        });
                    })
                    .catch((error) => {
                        Toast.fire({
                            icon: "error",
                            title: "Account Creation Failed",
                        });
                        signUpSubmitBtn.disabled = false;
                    });
            });
        } else {
            // the OTP is invalid, so return an error message
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Wrong OTP, Please Try Again.",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            });
        }
    }
}

// var hashedPassword = "";
async function getPasswordHash(password) {
    return $.ajax({
        type: "post",
        url: "./functionalities/hash-password.php",
        dataType: "json",
        data: { password: password },
    });
}

function base_url() {
    var pathparts = location.pathname.split("/");
    if (location.host == "localhost") {
        var url = location.origin + "/" + pathparts[1].trim("/") + "/"; // http://localhost/myproject/
    } else {
        var url = location.origin; // http://stackoverflow.com
    }
    return url;
}

function getHostName() {
    return location.protocol + "//" + location.host;
}
