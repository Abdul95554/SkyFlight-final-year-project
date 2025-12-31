
<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from_city = intval($_POST['from_city']);
    $to_city = intval($_POST['to_city']);
    $passenger_count = intval($_POST['passenger_count']);
    $price = floatval($_POST['calculated_price']);
    $distance_km = floatval($_POST['distance_km']);
    $amount_given = floatval($_POST['amount_given']);
    $change_returned = $amount_given - $price;
    $departure_date = date('Y-m-d');

    // Insert into bookings
    $stmt = $conn->prepare("INSERT INTO bookings (from_city_id, to_city_id, passenger_count, price, distance_km, amount_given, change_returned, departure_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiidddds", $from_city, $to_city, $passenger_count, $price, $distance_km, $amount_given, $change_returned, $departure_date);
    $stmt->execute();
    $booking_id = $stmt->insert_id;
    $stmt->close();

    // Insert passengers
    $names = $_POST['passenger_names'];
    $cnics = $_POST['passenger_cnic'];

    $stmt_passenger = $conn->prepare("INSERT INTO passengers (booking_id, name, cnic) VALUES (?, ?, ?)");
    foreach ($names as $i => $name) {
        $cnic = $cnics[$i];
        $stmt_passenger->bind_param("iss", $booking_id, $name, $cnic);
        $stmt_passenger->execute();
    }
    $stmt_passenger->close();

    // Redirect to booked tickets or confirmation
    header("Location: booked_tickets.php");
    exit;
} else {
    echo "Invalid access.";
}
?>
