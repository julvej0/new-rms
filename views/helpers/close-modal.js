// Get the modal element
const modal = document.getElementById("myModal");

// Get the close button element within the modal
const closeBtn = modal.querySelector(".close");

// Add a click event listener to the close button
closeBtn.addEventListener("click", function () {
    // Find the modal container element and add the "fade-out" class
    modal.querySelector(".modal-container").classList.add("fade-out");

    // Set a timeout to remove the modal from display after the fade-out animation
    setTimeout(function () {
        // Hide the modal by setting its display property to "none"
        modal.style.display = "none";

        // Remove the "fade-out" class from the modal container element
        modal.querySelector(".modal-container").classList.remove("fade-out");
    }, 300); // Match the duration of the slide-out animation
});
