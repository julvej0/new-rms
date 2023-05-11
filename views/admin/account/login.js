
function checkdata() {
    var emailAddress = document.getElementById('login_email').value;
    var passwordInput = document.getElementById('login_password').value;

    console.log(emailAddress);

    if (emailAddress == '' || passwordInput == ''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter your email/password',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });

        return false;
    }
    else{
        return true;
    }


}


  

