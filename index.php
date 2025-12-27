<?php
// You can include database connection here in the future if needed.
// include("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skyflight - Your Travel Companion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hero {
      background: url("img/mainBG.jpg") no-repeat center center / cover;
      height: 100vh;
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

    .card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body class="text-gray-800 relative">

  <!-- Transparent Header -->
  <header id="header" class="header fixed top-0 left-0 w-full py-4 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold text-white text-shadow">Skyflight</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="services.php" class="text-white text-lg hover:text-blue-300">Services</a></li>
          <li><a href="booked_tickets.php" class="text-white text-lg hover:text-blue-300">Book Tickets</a></li>
          <li><a href="contactus.php" class="text-white text-lg hover:text-blue-300">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero flex items-center justify-center relative">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-center text-white px-6">
      <h1 class="text-6xl font-extrabold mb-6 text-shadow">Welcome Skyflight</h1>
      <p class="text-xl mb-8 text-shadow">
        Your trusted partner for seamless flight booking and travel experiences. Explore new destinations today!
      </p>
      <a href="services.php" class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg text-lg font-semibold text-white">
        Explore Services
      </a>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="py-16 bg-gray-100">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-blue-900 text-center mb-6">Our Services</h2>
      <p class="text-lg text-gray-700 text-center mb-12">
        At skyflight, we offer a range of services to make your travel experience smooth, stress-free, and enjoyable.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1 -->
        <div class="card bg-white p-6 rounded-lg shadow-md">
          <img src="img/livetrackinglogo.jpg" alt="Live Tracking" class="w-16 mx-auto mb-4">
          <h3 class="text-2xl font-semibold text-blue-900 mb-2">Live Flight Tracking</h3>
          <p class="text-gray-700">Stay updated with real-time flight information for a hassle-free journey.</p>
        </div>
        <!-- Card 2 -->
        <div class="card bg-white p-6 rounded-lg shadow-md">
          <img src="img/ticktbooklogo.jpg" alt="Easy Booking" class="w-16 mx-auto mb-4">
          <h3 class="text-2xl font-semibold text-blue-900 mb-2">Easy Ticket Booking</h3>
          <p class="text-gray-700">Search and book tickets conveniently for your next adventure.</p>
        </div>
        <!-- Card 3 -->
        <div class="card bg-white p-6 rounded-lg shadow-md">
          <img src="img/customersupportlogo.jpg" alt="Customer Support" class="w-16 mx-auto mb-4">
          <h3 class="text-2xl font-semibold text-blue-900 mb-2">24/7 Customer Support</h3>
          <p class="text-gray-700">Our team is always ready to assist you with any queries or concerns.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto text-center">
      <p class="text-lg">&copy; <?php echo date("Y"); ?> Skyflight. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Header scroll effect
    const header = document.getElementById('header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  </script>
</body>
</html>
