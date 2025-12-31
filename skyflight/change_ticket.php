
<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    echo "Booking ID is missing.";
    exit;
}

$id = intval($_GET['id']);

// Fetch booking
$b_query = "SELECT * FROM bookings WHERE id = $id";
$b_result = $conn->query($b_query);
$booking = $b_result->fetch_assoc();

if (!$booking) {
    echo "Booking not found.";
    exit;
}

// Fetch all countries
$countries = $conn->query("SELECT * FROM countries ORDER BY name ASC");

// Fetch from/to city data
$from_city = $conn->query("SELECT * FROM cities WHERE id = " . $booking['from_city_id'])->fetch_assoc();
$to_city = $conn->query("SELECT * FROM cities WHERE id = " . $booking['to_city_id'])->fetch_assoc();

// Fetch passengers
$passengers = $conn->query("SELECT * FROM passengers WHERE booking_id = $id");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Ticket - Musafir</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-4xl mx-auto mt-20 p-8 bg-white shadow-md rounded-lg">
    <h2 class="text-3xl font-bold mb-6">Edit Ticket #<?= $booking['id'] ?></h2>
    <form method="POST" action="save_edited_ticket.php">
      <input type="hidden" name="id" value="<?= $booking['id'] ?>">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block font-medium">From City</label>
          <input type="text" readonly value="<?= $from_city['name'] ?>" class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium">To City</label>
          <input type="text" readonly value="<?= $to_city['name'] ?>" class="w-full p-2 border rounded">
        </div>
      </div>
      <div class="mt-4">
        <label class="block font-medium">Departure Date</label>
        <input type="date" name="departure_date" value="<?= $booking['departure_date'] ?>" class="w-full p-2 border rounded">
      </div>
      <div class="mt-4">
        <label class="block font-medium">Amount Given (PKR)</label>
        <input type="number" name="amount_given" value="<?= $booking['amount_given'] ?>" class="w-full p-2 border rounded">
      </div>
      <div class="mt-6">
        <h4 class="text-xl font-semibold mb-2">Passenger Information</h4>
        <?php $index = 0; while ($p = $passengers->fetch_assoc()): ?>
          <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="hidden" name="passenger_ids[]" value="<?= $p['id'] ?>">
            <input type="text" name="passenger_names[]" value="<?= $p['name'] ?>" class="p-2 border rounded" required>
            <input type="text" name="passenger_cnic[]" value="<?= $p['cnic'] ?>" class="p-2 border rounded" required>
          </div>
        <?php endwhile; ?>
      </div>
      <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Changes</button>
    </form>
  </div>
</body>
</html>
