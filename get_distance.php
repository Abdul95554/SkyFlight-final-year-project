<?php
require_once 'db_connect.php';
header('Content-Type: application/json');

$from_id = intval($_GET['from']);
$to_id = intval($_GET['to']);

$query = "SELECT id, latitude, longitude FROM cities WHERE id IN ($from_id, $to_id)";
$result = $conn->query($query);

$coords = [];
while ($row = $result->fetch_assoc()) {
  $coords[$row['id']] = [
    'lat' => $row['latitude'],
    'lon' => $row['longitude']
  ];
}

// Check both exist
if (isset($coords[$from_id]) && isset($coords[$to_id])) {
  $distance = haversineGreatCircleDistance(
    $coords[$from_id]['lat'],
    $coords[$from_id]['lon'],
    $coords[$to_id]['lat'],
    $coords[$to_id]['lon']
  );
  echo json_encode(['distance_km' => round($distance)]);
} else {
  echo json_encode(['error' => 'Invalid city IDs']);
}

// Haversine formula
function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371)
{
  $latFrom = deg2rad($lat1);
  $lonFrom = deg2rad($lon1);
  $latTo = deg2rad($lat2);
  $lonTo = deg2rad($lon2);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}
?>
