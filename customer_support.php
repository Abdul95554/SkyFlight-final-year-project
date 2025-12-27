<?php
// You can add form handling or DB connection here in the future
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skyflight - Customer Support</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="dropdown.js" defer></script>
  <style>
    #services-dropdown {
      left: 50%;
      transform: translateX(-50%);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <header class="bg-blue-900 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold">Skyflight</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="index.php" class="hover:underline">Home</a></li>
          <li id="services-tab" class="relative">
            <a href="#" class="hover:underline">Services</a>
            <ul id="services-dropdown" class="hidden absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 py-2 w-48 text-center">
              <li><a href="live_tracking.php" class="block px-4 py-2 hover:bg-gray-200">Live Flight Tracking</a></li>
              <li><a href="ticket_booking.php" class="block px-4 py-2 hover:bg-gray-200">Flexible Ticket Booking</a></li>
              <li><a href="payment_option.php" class="block px-4 py-2 hover:bg-gray-200">Payment Options</a></li>
              <li><a href="customer_support.php" class="block px-4 py-2 hover:bg-gray-200">Customer Support</a></li>
            </ul>
          </li>
          <li><a href="contactus.php" class="hover:underline">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto py-10 px-6">
    <h2 class="text-4xl font-bold text-center text-blue-900 mb-6">Customer Support</h2>

    <!-- Support Form -->
    <section class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-2xl font-semibold text-blue-900 mb-4">Submit Your Query</h3>
      <form id="support-form" method="POST" action="#" class="space-y-6">
        <div>
          <label for="name" class="block text-lg font-medium">Full Name</label>
          <input type="text" id="name" name="name" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
          <label for="email" class="block text-lg font-medium">Email Address</label>
          <input type="email" id="email" name="email" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
          <label for="issue" class="block text-lg font-medium">Issue Type</label>
          <select id="issue" name="issue" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <option value="">Select an Issue</option>
            <option value="booking">Booking Issue</option>
            <option value="payment">Payment Issue</option>
            <option value="account">Account Issue</option>
            <option value="general">General Query</option>
          </select>
        </div>
        <div>
          <label for="message" class="block text-lg font-medium">Message</label>
          <textarea id="message" name="message" rows="5" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        <button type="submit" class="bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800">Submit</button>
      </form>
    </section>

    <!-- Contact Details -->
    <section class="mt-10 bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-2xl font-semibold text-blue-900 mb-4">Contact Details</h3>
      <p><strong>Email:</strong> support@Skyflight.com</p>
      <p><strong>Phone:</strong> +92 329 9843770</p>
      <p><strong>Office Address:</strong> Mohajir Colony, Street 4, House No. 59/B3</p>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4">
    <p>&copy; <?php echo date("Y"); ?> Skyflight. All rights reserved.</p>
  </footer>

  <script>
    // Dropdown hover effect
    const tab = document.getElementById('services-tab');
    const dropdown = document.getElementById('services-dropdown');

    tab.addEventListener('mouseenter', () => dropdown.classList.remove('hidden'));
    tab.addEventListener('mouseleave', () => dropdown.classList.add('hidden'));
  </script>
</body>
</html>
