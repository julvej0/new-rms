const modal = document.getElementById("myModal");
    const closeBtn = modal.querySelector(".close");

    closeBtn.addEventListener("click", function() {
    modal.querySelector(".modal-container").classList.add("fade-out");
    setTimeout(function() {
        modal.style.display = "none";
        modal.querySelector(".modal-container").classList.remove("fade-out");
    }, 300); // match the duration of the slide-out animation
});