
//old password is also the current password one sorry too tiring to change all the names

//password input is the new password input


//user password
const passwordInput = document.getElementsByClassName('passwordInput')[0];
const passwordInput2 = document.getElementsByClassName('passwordInput')[1];
const confirmPasswordInput = document.getElementById('confirmPasswordInput');

//user details
const emailInput = document.getElementById('email');
const srCode = document.getElementById('srcode');
const fname = document.getElementById('fName');
const lname = document.getElementById('lName'); 
const mname = document.getElementById('mName'); 


//show hide password
const toggleShowButton = document.getElementById('passwordToggle');
const toggleShowButton2 = document.getElementById('passwordToggle2');
const showHidePassword = document.querySelectorAll('.toggle-password');
const showHidePassword2 = document.querySelectorAll('.toggle-password2');

showHidePassword.forEach(function(button) {
  button.addEventListener('click', function() {

    const passwordToggle = button.previousElementSibling;
    const icon = button.parentElement.querySelector('i');
    
    if (passwordToggle.type === 'password') {
      passwordToggle.type = 'text';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
    else {
      passwordToggle.type = 'password';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    }

  });
});

showHidePassword2.forEach(function(button) {
  button.addEventListener('click', function() {

    const passwordToggle = button.previousElementSibling;
    const icon = button.parentElement.querySelector('i');
    
    if (passwordToggle.type === 'password') {
      passwordToggle.type = 'text';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
    else {
      passwordToggle.type = 'password';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    }

  });
});



if (toggleShowButton !== null){
toggleShowButton.addEventListener('click', function() {

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleShowButton.innerHTML = '<i class="fas fa-eye"></i>';
    }
    else {
        passwordInput.type = 'password';
        toggleShowButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }

});
}



// error handling

//email address
if (emailInput !== null) {
  emailInput.addEventListener('focus', () => {
    emailInput.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });

  emailInput.addEventListener('blur', () => {
    if (emailInput.value === '') {
      emailInput.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } else {
      emailInput.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


// sr code
if (srCode !== null) {
  srCode.addEventListener('focus', () => {
    srCode.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });

  srCode.addEventListener('blur', () => {
    if (srCode.value === '') {
      srCode.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } else {
      srCode.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


//First Name
if (fname !== null) {
  fname.addEventListener('focus', () => {
    fname.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });

  fname.addEventListener('blur', () => {
    if (fname.value === '') {
      fname.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } else {
      fname.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


//Last Name
if (lname !== null) {
  lname.addEventListener('focus', () => {
    lname.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });

  lname.addEventListener('blur', () => {
    if (lname.value === '') {
      lname.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } else {
      lname.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}

//Middle Initial
if (mname !== null) {
  mname.addEventListener('focus', () => {
    mname.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });

  mname.addEventListener('blur', () => {
    if (mname.value === '') {
      mname.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } else {
      mname.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


//password index 0

if(passwordInput) {
  passwordInput.addEventListener('focus', () => {
    passwordInput.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });
  
  passwordInput.addEventListener('blur', () => {
    if (passwordInput.value === '') {
      passwordInput.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } 
    else if(passwordInput.value.length < 8) {
      passwordInput.style.borderColor = '#cf102d'; // set the border color to red when the input field length is below 8
    }
    else {
      passwordInput.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


//password index 1
if(passwordInput2) {
  passwordInput2.addEventListener('focus', () => {
    passwordInput2.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });
  
  passwordInput2.addEventListener('blur', () => {
    if (passwordInput2.value === '') {
      passwordInput2.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } 
    else if(passwordInput2.value.length < 8) {
      passwordInput2.style.borderColor = '#cf102d'; // set the border color to red when the input field length is below 8
    }
    else {
      passwordInput2.style.borderColor = 'greenyellow'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


// confirm password for the change password in login
if (confirmPasswordInput) {
  confirmPasswordInput.addEventListener('focus', () => {
    confirmPasswordInput.style.borderColor = 'greenyellow'; // set the border color to green when the input field is focused
  });
  
  confirmPasswordInput.addEventListener('blur', () => {
    if (confirmPasswordInput.value === '') {
      confirmPasswordInput.style.borderColor = '#cf102d'; // set the border color to red when the input field is blurred and empty
    } 
    else if(confirmPasswordInput.value.length < 8) {
      confirmPasswordInput.style.borderColor = '#cf102d'; // set the border color to red when the input field length is below 8
    }
    else if (confirmPasswordInput.value === passwordInput.value) {
      confirmPasswordInput.style.borderColor = 'greenyellow'; // set the border color to red when the confirm password input does not match the password input
    } 
    else if (confirmPasswordInput.value === '' && passwordInput.value ==='' ) {
      confirmPasswordInput.style.borderColor = '#cf102d'; // set the border color to red when the confirm password input does not match the password input
    } 
    else if (passwordInput2 && confirmPasswordInput.value === passwordInput2.value) {
      confirmPasswordInput.style.borderColor = 'greenyellow'; // set the border color to green when the confirm password input matches the password input2
    } 
    else {
      confirmPasswordInput.style.borderColor = '#cf102d'; // set the border color to the default when the input field is blurred and has a value
    }
  });
}


