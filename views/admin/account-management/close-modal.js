const modal = document.getElementById("myModal");
const closeBtn = modal.querySelector(".close");

closeBtn.addEventListener("click", function() {
  // When the close button is clicked, add the "fade-out" class to the modal content
  modal.querySelector(".modal-content").classList.add("fade-out");

  // Wait for the slide-out animation to finish before performing the next actions
  setTimeout(function() {
    // Hide the modal by setting its display property to "none"
    modal.style.display = "none";

    // Remove the "fade-out" class from the modal content to reset its state
    modal.querySelector(".modal-content").classList.remove("fade-out");

    // Navigate to user-profile.php after closing the modal
    window.location.href = "user-profile.php";
  }, 300); // Match the duration of the slide-out animation
});
