document.addEventListener("DOMContentLoaded", () => {
    const airplaneSound = document.getElementById("airplane-sound");
  
    // Function to play sound
    function playAirplaneSound() {
      if (airplaneSound) {
        airplaneSound.currentTime = 0; // Reset sound to start
        airplaneSound.play().catch((error) => {
          console.error("Audio playback error:", error);
        });
      }
    }
  
    // Ensure sound plays on main page load
    if (window.location.pathname.endsWith("main.html")) {
      playAirplaneSound();
    }
  });
  