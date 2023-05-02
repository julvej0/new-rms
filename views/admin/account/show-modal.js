
function showModal() {

    const modal = document.getElementById("myModal");
    const srCode = document.getElementById("srcode").value;
    const emailAddress = document.getElementById("email").value;
    const passwordInput = document.getElementsByClassName('passwordInput')[0].value;
    const confirmPasswordInput = document.getElementById('confirmPasswordInput').value;
    const emailTooltip = document.getElementById("emailTooltip");
    const passwordTooltip = document.getElementById("passwordTooltip");

   if (!srCode || !emailAddress || !passwordInput || !confirmPasswordInput) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Input Fields Are Empty, Please Try Again!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
       return;
   }
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
   } else {
       passwordTooltip.style.display = "block";
       emailTooltip.style.display = "none";

       // check for existing SR code and email 
       const xhr = new XMLHttpRequest();
       const url = `../account/functionalities/create-account.php?srcode=${srCode}&email=${emailAddress}`;
       xhr.open("GET", url, true);
       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       xhr.onreadystatechange = function () {
           if (xhr.readyState === 4 && xhr.status === 200) {
               const response = xhr.responseText;
               if (response === 'exists') {
                    // display an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Existing SR Code or Email! Please Try Again',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
               } else {
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