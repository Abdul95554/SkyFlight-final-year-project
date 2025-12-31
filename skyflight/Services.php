<?php
// You could include shared resources like DB connection here later.
// include("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services - Skyflight</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes hover-bounce {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
      100% {
        transform: scale(1);
      }
    }

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
<body class="bg-gray-100">

  <!-- Transparent Header -->
  <header id="header" class="header fixed top-0 left-0 w-full py-4 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold text-white text-shadow">Skyflight</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="index.php" class="text-white text-lg hover:text-blue-300">Home</a></li>
          <li><a href="ticket_booking.php" class="text-white text-lg hover:text-blue-300">Book Tickets</a></li>
          <li><a href="contactus.php" class="text-white text-lg hover:text-blue-300">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Header Section with Overlay -->
  <header class="relative bg-cover bg-center h-screen" style="background-image: url('img/ServiceBG.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative h-full flex flex-col justify-center items-center text-center text-white">
      <h1 class="text-4xl font-bold">Welcome to Skyflight</h1>
      <p class="text-lg mt-2 mb-8">Your trusted partner for seamless travel experiences.</p>

      <!-- Service Boxes -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl">
        <!-- Live Tracking -->
        <a href="live_tracking.php" class="bg-white bg-opacity-90 text-black shadow-lg rounded-lg p-6 text-center hover:shadow-2xl hover:animate-hover-bounce transition duration-300 transform hover:scale-105">
          <h3 class="text-xl font-semibold">Live Tracking</h3>
          <p class="text-gray-600 mt-2">Track your flights in real-time with advanced tools.</p>
        </a>

        <!-- Ticket Booking -->
        <a href="ticket_booking.php" class="bg-white bg-opacity-90 text-black shadow-lg rounded-lg p-6 text-center hover:shadow-2xl hover:animate-hover-bounce transition duration-300 transform hover:scale-105">
          <h3 class="text-xl font-semibold">Ticket Booking</h3>
          <p class="text-gray-600 mt-2">Easily book tickets to your favorite destinations.</p>
        </a>

        <!-- Payment Options -->
        <a href="booked_tickets.php" class="bg-white bg-opacity-90 text-black shadow-lg rounded-lg p-6 text-center hover:shadow-2xl hover:animate-hover-bounce transition duration-300 transform hover:scale-105">
          <h3 class="text-xl font-semibold">Book Tickets</h3>
          <p class="text-gray-600 mt-2">Secure and flexible payment solutions for your convenience.</p>
        </a>

        <!-- Customer Support -->
        <a href="customer_support.php" class="bg-white bg-opacity-90 text-black shadow-lg rounded-lg p-6 text-center hover:shadow-2xl hover:animate-hover-bounce transition duration-300 transform hover:scale-105">
          <h3 class="text-xl font-semibold">Customer Support</h3>
          <p class="text-gray-600 mt-2">24/7 customer support for all your travel needs.</p>
        </a>

        <!-- AI-Powered Chatbot -->
        <a href="chatbot.php" class="bg-white bg-opacity-90 text-black shadow-lg rounded-lg p-6 text-center hover:shadow-2xl hover:animate-hover-bounce transition duration-300 transform hover:scale-105">
          <h3 class="text-xl font-semibold">AI-Powered Chatbot</h3>
          <p class="text-gray-600 mt-2">Get instant answers with our smart AI-powered chatbot.</p>
        </a>
      </div>
    </div>
  </header>

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
