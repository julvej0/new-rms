function signUpConfirmBtn() {
    // Get input values from the HTML elements
    var emailAddress = document.getElementById("userEmailAddressInput").value;
    var otpVal = document.getElementById("otpVerification").value;
    var srCode = document.getElementById("userSrCode").value;
    var passwordVal = document.getElementById("confirmedPassword").value;
    var disableConfirmBtn = document.getElementById("btnSubmit");
    var fname = document.getElementById("fName").value;
    var lname = document.getElementById("lName").value;
    var mname = document.getElementById("mName").value;

    // Disable the confirm button
    disableConfirmBtn.disabled = true;

    // Convert the first letter of each word in fname, lname, and mname to uppercase
    fname = fname.split(" ").map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(" ");
    lname = lname.split(" ").map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(" ");
    mname = mname.split(" ").map((s) => s.charAt(0).toUpperCase() + s.substring(1)).join(" ");

    // Send the OTP and email address to verify_otp.php using AJAX
    // var xhr = new XMLHttpRequest();
    // xhr.open("POST", "./functionalities/otp-verify.php", true);
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // xhr.onreadystatechange = function () {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //         if (xhr.responseText === "success") {
    //             // Display a success message using Swal (SweetAlert)
    //             const Toast = Swal.mixin({
    //                 toast: true,
    //                 position: "top-end",
    //                 showConfirmButton: false,
    //                 timer: 3000,
    //                 timerProgressBar: true,
    //                 didOpen: (toast) => {
    //                     toast.addEventListener("mouseenter", Swal.stopTimer);
    //                     toast.addEventListener("mouseleave", Swal.resumeTimer);
    //                 }
    //             });

    //             Toast.fire({
    //                 icon: "success",
    //                 title: "Account Created Successfully"
    //             });

    //             // Redirect to the login page after 3 seconds
    //             setTimeout(() => {
    //                 window.location.href = base_url() + "../login.php";
    //             }, 3000);

    //             console.log(otpTextBox);

    //         } else {
    //             // Display an error message using Swal (SweetAlert)
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Oops...",
    //                 text: "Wrong OTP, Please Try Again.",
    //                 confirmButtonColor: "#3085d6",
    //                 confirmButtonText: "OK"
    //             });

    //             console.log(otpTextBox);
    //         }
    //     }
    // };

    // // Send the data to the server for verification
    // xhr.send("email=" + encodeURIComponent(emailAddress) + "&otp=" + encodeURIComponent(otpTextBox) +
    //     "&srcode=" + encodeURIComponent(srCode) + "&password=" + encodeURIComponent(confirmPassword) +
    //     "&fname=" + encodeURIComponent(fname) + "&lname=" + encodeURIComponent(lname) + "&mname=" + encodeURIComponent(mname));
    otpVerify(emailAddress, otpVal, srCode, passwordVal, fname, lname, mname);
}

async function otpVerify(email, otp, srCode, password, fname, lname, mname) {
    if (email != "" && otp != "" && srCode != "" && password != "" && fname != "" && lname != "" && mname != "") {
        console.log("sessVerCode: " + sessionStorage.getItem("verification_code"));
        console.log("otp: " + otp);
        // check if the OTP entered by the user matches the one sent to their email
        if (otp == sessionStorage.getItem("verification_code")) {
            // the OTP is valid, so clear the session and post the data to the API endpoint

            // Remove the unset($_SESSION["verification_code"]); line here if you want to keep the verification code in the session for further processing on the API side.

            console.log("otp matched, creating new record");
            getPasswordHash(password).then((resp) => {
                console.log("otpVerify hashedPassword: " + JSON.stringify(resp));
                fetch("http://localhost:5000/table_user", {
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
                        user_mname: mname
                    }),
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    }
                }).then(response => {
                    response.json().then(data => {
                        console.log("data: " + JSON.stringify(data));
                    })
                }).catch((error) => {
                    console.log(error)
                });
            });
        } else {
            // the OTP is invalid, so return an error message
            console.log("The OTP you entered is incorrect. Please try again.");
        }
    }
}

// var hashedPassword = "";
async function getPasswordHash(password) {
    return $.ajax({
        type: "post",
        url: "./functionalities/hash-password.php",
        dataType: "json",
        data: { password: password }
        // success: function (resp) {
        //     console.log("getPasswordHash hashed_password: " + resp["hashed_password"]);
        //     // hashedPassword = resp["hashed_password"];
        //     return resp["hashed_password"];
        // },
        // error: function (error) {
        //     console.log("getPasswordHash err: " + JSON.stringify(error));
        // }
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
