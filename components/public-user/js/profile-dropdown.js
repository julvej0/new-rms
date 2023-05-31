
function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  var icon = document.querySelector(".dropdown-container i");
  dropdown.classList.toggle("show");
  icon.classList.toggle("rotate");
}

// Close the dropdown when clicking outside of it
window.onclick = function(event) {
  if (!event.target.matches('.fa-cog')) {
    var dropdowns = document.getElementsByClassName("dropdown");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');

        var icon = document.querySelector(".dropdown-container i");
        icon.classList.remove("rotate");
        // Add the rotate-back class to trigger the rotation back to 0 degrees
        icon.classList.add("rotate-back");
        // Remove the rotate class after a delay to allow the transition to take effect
        setTimeout(function() {
          icon.classList.remove("rotate-back");
        }, 300);
      }
    }
  }
};
