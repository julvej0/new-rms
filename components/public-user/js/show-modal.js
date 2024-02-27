const modal = document.getElementById("myModal");
const closeBtn = modal.querySelector(".close");

function showModal() {
  modal.style.display = "block";
  setTimeout(function () {
      modal.querySelector(".modal-container").style.transform = "translate(-50%, -50%)";
  }, 10);
}