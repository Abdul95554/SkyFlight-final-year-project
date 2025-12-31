
<?php
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departure_date = $_POST['departure_date'];
    $price = floatval($_POST['price']);
    $amount_given = floatval($_POST['amount_given']);
    $change_returned = $amount_given - $price;

    // Update booking info
    $stmt = $conn->prepare("UPDATE bookings SET departure_date = ?, price = ?, amount_given = ?, change_returned = ? WHERE id = ?");
    $stmt->bind_param("sdddi", $departure_date, $price, $amount_given, $change_returned, $id);
    $stmt->execute();
    $stmt->close();

    // Update passengers
    $names = $_POST['passenger_names'];
    $cnics = $_POST['passenger_cnic'];
    $passenger_ids = $_POST['passenger_ids'];

    $stmt = $conn->prepare("UPDATE passengers SET name = ?, cnic = ? WHERE id = ?");
    for ($i = 0; $i < count($passenger_ids); $i++) {
        $stmt->bind_param("ssi", $names[$i], $cnics[$i], $passenger_ids[$i]);
        $stmt->execute();
    }
    $stmt->close();

    header("Location: booked_tickets.php");
    exit;
}

// Fetch booking
$booking = $conn->query("SELECT * FROM bookings WHERE id = $id")->fetch_assoc();
$from_city = $conn->query("SELECT name FROM cities WHERE id = " . $booking['from_city_id'])->fetch_assoc()['name'];
$to_city = $conn->query("SELECT name FROM cities WHERE id = " . $booking['to_city_id'])->fetch_assoc()['name'];
$passengers = $conn->query("SELECT * FROM passengers WHERE booking_id = $id");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Edit Booking - Musafir</title>
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
    <h1 class="text-3xl font-bold">Musafir</h1>
    <nav>
      <ul class="flex space-x-6 text-lg">
        <li><a href="index.php" class="hover:underline">Home</a></li>
        <li><a href="booked_tickets.php" class="hover:underline">Booked Tickets</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="pt-32 pb-16 container mx-auto px-6">
  <section class="glass p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
    <h2 class="text-4xl text-center font-bold text-blue-900 mb-6">Edit Booking #<?= $booking['id'] ?></h2>
    <form method="POST">
      <label class="block font-semibold">From City</label>
      <input type="text" readonly class="w-full p-2 border rounded mb-4" value="<?= $from_city ?>">

      <label class="block font-semibold">To City</label>
      <input type="text" readonly class="w-full p-2 border rounded mb-4" value="<?= $to_city ?>">

      <label class="block font-semibold">Departure Date</label>
      <input type="date" name="departure_date" value="<?= $booking['departure_date'] ?>" class="w-full p-2 border rounded mb-4" required>

      <label class="block font-semibold">Price (PKR)</label>
      <input type="number" step="0.01" name="price" value="<?= $booking['price'] ?>" class="w-full p-2 border rounded mb-4" required>

      <label class="block font-semibold">Amount Given (PKR)</label>
      <input type="number" step="0.01" name="amount_given" value="<?= $booking['amount_given'] ?>" class="w-full p-2 border rounded mb-4" required>

      <h3 class="text-xl font-semibold text-blue-800 mb-2 mt-6">Passenger Info</h3>
      <?php while ($p = $passengers->fetch_assoc()): ?>
        <div class="grid grid-cols-2 gap-4 mb-4">
          <input type="hidden" name="passenger_ids[]" value="<?= $p['id'] ?>">
          <input type="text" name="passenger_names[]" value="<?= $p['name'] ?>" class="p-2 border rounded" placeholder="Full Name" required>
          <input type="text" name="passenger_cnic[]" value="<?= $p['cnic'] ?>" class="p-2 border rounded" placeholder="CNIC" required>
        </div>
      <?php endwhile; ?>

      <div class="text-center mt-6">
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-600">Update Booking</button>
      </div>
    </form>
  </section>
</main>
</body>
</html>
