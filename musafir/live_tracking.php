<?php
// Optional: backend logic or OpenSky proxy
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Musafir - Live Flight Tracking</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Leaflet for Map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="opensky_map.js" defer></script>

  <style>
    body {
      background: url('img/mainBG.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .text-shadow {
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    }

    .header {
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .header.scrolled {
      background-color: rgba(27, 27, 27, 0.9);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .glass-card {
      backdrop-filter: blur(12px);
      background-color: rgba(255, 255, 255, 0.85);
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header id="header" class="header fixed top-0 left-0 w-full py-4 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold text-white text-shadow">Musafir</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="index.php" class="text-white text-lg hover:text-blue-300">Home</a></li>
          <li><a href="services.php" class="text-white text-lg hover:text-blue-300">Services</a></li>
          <li><a href="ticket_booking.php" class="text-white text-lg hover:text-blue-300">Book Tickets</a></li>
          <li><a href="contactus.php" class="text-white text-lg hover:text-blue-300">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Page Heading -->
  <section class="pt-32 pb-8 text-center text-white">
    <h2 class="text-5xl font-extrabold text-shadow mb-2">Live Flight Tracking</h2>
    <p class="text-xl text-shadow">Track aircraft in real time by country</p>
  </section>

  <!-- Tracking Controls & Map -->
  <main class="container mx-auto px-6 pb-16">
    <section class="glass-card p-6 rounded-2xl shadow-md">
      <h3 class="text-2xl font-bold text-blue-900 mb-4">Select Country to View Live Flights</h3>

      <!-- Filter Form -->
      <div class="flex flex-col md:flex-row gap-4 mb-6">
        <select id="country-select" class="w-full md:w-1/2 p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
          <option value="">Select a Country</option>
          <option value="Pakistan">Pakistan</option>
          <option value="India">India</option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Canada">Canada</option>
        </select>
        <button id="filter-button" class="bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">
          Show Live Flights
        </button>
      </div>

      <!-- Map -->
      <div id="map" class="w-full h-[500px] rounded-lg shadow-md"></div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-6">
    <p class="text-lg">&copy; <?php echo date("Y"); ?> Musafir. All rights reserved.</p>
  </footer>

  <!-- Header Scroll Script -->
  <script>
    const header = document.getElementById("header");
    window.addEventListener("scroll", () => {
      header.classList.toggle("scrolled", window.scrollY > 50);
    });
  </script>
</body>
</html>
