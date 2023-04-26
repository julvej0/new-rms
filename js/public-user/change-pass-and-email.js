// Get the modal element
var modalPassword = document.getElementById("change-password-modal");

// Get the button that opens the modal
var btnPassword = document.getElementById("change-password-btn");

// Get the <span> element that closes the modal
var spanPassword = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btnPassword.onclick = function() {
    modalPassword.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
spanPassword.onclick = function() {
    modalPassword.style.display = "none";

    
}

// When the user clicks anywhere outside of the modalPassword or modalEmail, close it
window.onclick = function(event) {
    if (event.target == modalPassword) {
        modalPassword.style.display = "none";
    }
};



// Validate password fields before submitting the form
document.getElementById("change-password-form").addEventListener("submit", function(event) {
    var newPassword = document.getElementById("oldPasswordInput").value;
    var confirmPassword = document.getElementById("confirmPasswordInput").value;
    if (newPassword != confirmPassword) {
        alert("New password and confirm password fields do not match.");
        event.preventDefault();
    }
});



