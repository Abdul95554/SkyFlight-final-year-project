
<?php
require_once 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete passengers first due to foreign key constraint
    $conn->query("DELETE FROM passengers WHERE booking_id = $id");

    // Then delete the booking
    $conn->query("DELETE FROM bookings WHERE id = $id");

    header("Location: booked_tickets.php");
    exit;
} else {
    echo "Invalid request.";
}
?>
