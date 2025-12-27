
<?php
require_once 'db_connect.php';

$query = "SELECT b.*, 
    fc.name AS from_city, 
    tc.name AS to_city,
    (SELECT p.name FROM passengers p WHERE p.booking_id = b.id ORDER BY p.id ASC LIMIT 1) AS first_passenger
  FROM bookings b
  JOIN cities fc ON fc.id = b.from_city_id
  JOIN cities tc ON tc.id = b.to_city_id
  ORDER BY b.created_at DESC";



$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booked Tickets - Skyflight</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('img/mainBG.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .glass {
      backdrop-filter: blur(12px);
      background-color: rgba(255,255,255,0.9);
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
        <li><a href="ticket_booking.php" class="hover:underline">Book Ticket</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="pt-32 pb-16 container mx-auto px-6">
  <h2 class="text-4xl text-white font-bold text-center mb-6">Booked Tickets</h2>

  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="glass p-6 rounded-xl shadow-md mb-6">
      <h3 class="text-xl font-semibold text-blue-900 mb-2">
  <?= htmlspecialchars($row['first_passenger'] ?? 'Passenger') ?> - Booking #<?= $row['id'] ?>
  </h3>
      <p><strong>From:</strong> <?= $row['from_city'] ?> <strong>To:</strong> <?= $row['to_city'] ?></p>
      <p><strong>Date:</strong> <?= $row['departure_date'] ?> | <strong>Passengers:</strong> <?= $row['passenger_count'] ?></p>
      <p><strong>Total Price:</strong> PKR <?= number_format($row['price']) ?> | <strong>Amount Paid:</strong> <?= number_format($row['amount_given']) ?> | <strong>Change:</strong> <?= number_format($row['change_returned']) ?></p>

      <div class="mt-4 flex space-x-4">
        <a href="edit_booking.php?id=<?= $row['id'] ?>" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <a href="delete_booking.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</a>
      </div>
    </div>
  <?php endwhile; ?>
</main>

</body>
</html>
