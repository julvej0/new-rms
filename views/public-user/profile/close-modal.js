const modal = document.getElementById("myModal");
const closeBtn = modal.querySelector(".close");

closeBtn.addEventListener("click", function() {
  modal.querySelector(".modal-content").classList.add("fade-out");
  setTimeout(function() {
    modal.style.display = "none";
    modal.querySelector(".modal-content").classList.remove("fade-out");
    window.location.href = "user-profile.php"; // navigate to user-profile.php
  }, 300); // match the duration of the slide-out animation
});
