function showModal() {
    // Get the necessary elements from the DOM
    var modal = document.getElementById("myModal");
    var srCode = document.getElementById("srcode").value;
    var emailAddress = document.getElementById("email").value;
    var passwordInput = document.getElementsByClassName('passwordInput')[0].value;
    var confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
    var emailTooltip = document.getElementById("emailTooltip");
    var passwordTooltip = document.getElementById("passwordTooltip");
    var fname = document.getElementById('fName').value;
    var lname = document.getElementById('lName').value;
    var mname = document.getElementById('mName').value;
    var fullName = fname + ' ' + mname + ' ' + lname;
    var capitalizedFullName = fullName.split(' ').map(word => {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    }).join(' ');

    // Check if any required inputs are empty
    if (!srCode || !emailAddress || !passwordInput || !confirmPasswordInput || !fname || !lname) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Some Inputs are Empty, Please Try Again!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }

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
    } else if (passwordInput.length < 8 || confirmPasswordInput.length < 8) {
        // Check if the password meets the minimum length requirement
        passwordTooltip.innerHTML = 'Please enter at least 8 characters.';
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";
    } else {
        // If all checks pass, display the modal and set the values of the input fields
        passwordTooltip.style.display = "block";
        emailTooltip.style.display = "none";

        // Check for existing SR code and email using XMLHttpRequest
        const xhr = new XMLHttpRequest();
        const url = `../account/functionalities/create-account.php?srcode=${srCode}&email=${emailAddress}`;
        xhr.open("GET", url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'exists') {
                    // Display an error message if SR code or email already exists
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Existing SR Code or Email! Please Try Again',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Set values for input fields and display the modal
                    document.getElementById('userFullName').value = capitalizedFullName;
                    document.getElementById('userEmailAddressInput').setAttribute('value', emailAddress);
                    document.getElementById("userSrCode").setAttribute('value', srCode);
                    document.getElementById("confirmedPassword").value = confirmPasswordInput;
                    modal.style.display = "block";
                }
            }
        };
        xhr.send();

        passwordTooltip.style.display = "none"; // hide password tooltip
        emailTooltip.style.display = "none"; // hide email tooltip
    }
}
