<?php
require_once 'db_connect.php';
$countries = $conn->query("SELECT * FROM countries ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ticket Booking - skyflight</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('img/mainBG.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .glass {
      backdrop-filter: blur(12px);
      background-color: rgba(255, 255, 255, 0.9);
    }
  </style>
</head>
<body class="text-gray-800">
  <header class="bg-blue-900 text-white py-4 fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold">Skyflight</h1>
      <nav>
        <ul class="flex space-x-6 text-lg">
          <li><a href="index.php" class="hover:underline">Home</a></li>
          <li><a href="booked_tickets.php" class="hover:underline">Booked Tickets</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="pt-32 pb-20 container mx-auto px-6">
    <section class="glass p-6 rounded-lg shadow-md max-w-4xl mx-auto">
      <h2 class="text-4xl text-blue-900 font-bold text-center mb-6">Book Your Ticket</h2>
      <form method="POST" action="save_booking.php" id="booking-form">
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label class="font-semibold">From Country</label>
            <select id="from_country" class="w-full p-2 border rounded" required></select>
          </div>
          <div>
            <label class="font-semibold">To Country</label>
            <select id="to_country" class="w-full p-2 border rounded" required></select>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label class="font-semibold">From City</label>
            <select id="from_city" name="from_city" class="w-full p-2 border rounded" required></select>
          </div>
          <div>
            <label class="font-semibold">To City</label>
            <select id="to_city" name="to_city" class="w-full p-2 border rounded" required></select>
          </div>
        </div>

        <div class="mb-4">
          <label class="font-semibold">Departure Date</label>
          <input type="date" name="departure_date" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
          <label class="font-semibold">No. of Passengers</label>
          <input type="number" min="1" id="passenger_count" class="w-full p-2 border rounded" required>
        </div>

        <div id="passenger_inputs" class="space-y-4"></div>

        <div id="pricing_section" class="hidden mt-8">
          <h3 class="text-xl font-bold text-blue-800 mb-4">Fare Details</h3>
          <input type="hidden" id="calculated_price" name="price">
          <input type="hidden" id="distance_input" name="distance_km">
          <p><strong>Estimated Distance:</strong> <span id="distance_km">-</span> km</p>
          <p><strong>Total Price:</strong> PKR <span id="total_price">-</span></p>

          <div class="mt-4">
            <label class="font-semibold">Amount Given by Passenger</label>
            <input type="number" name="amount_given" id="amount_given" class="w-full p-2 border rounded" required>
            <p class="mt-2"><strong>Change to Return:</strong> PKR <span id="change_amount">0</span></p>
          </div>

          <div class="text-center mt-6">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-600">Confirm & Print</button>
          </div>
        </div>
      </form>
    </section>
  </main>

  <script src="ticket_booking.js"></script>
</body>
</html>
