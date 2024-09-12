document.getElementById("openPageButton").addEventListener("click", function() {
  // Calculate the horizontal position to move towards the center from the right
  var horizontalPosition = window.innerWidth - 400; // Adjust 400 according to your window width
  
  // Open the new page with specified dimensions and without full screen mode
  var newWindow = window.open("../chatbot/chatbot.html", "_blank", "width=400,height=600");
  
  // Position the new window towards the center from the right
  newWindow.moveTo(horizontalPosition / 2, 100); // Adjust 100 according to your desired vertical position
});






function toggleDropdown() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  



  document.getElementById('nextButton').addEventListener('click', function() {
    document.querySelector('.team-cards-container').scrollBy({
        left: 200, // Adjust scroll distance as needed
        behavior: 'smooth'
    });
});

document.getElementById('prevButton').addEventListener('click', function() {
    document.querySelector('.team-cards-container').scrollBy({
        left: -200, // Adjust scroll distance as needed
        behavior: 'smooth'
    });
});
