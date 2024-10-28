<?php
include '../db.php'; // Sesuaikan path dengan lokasi sebenarnya
$db = getDBConnection();

$results = $db->query('SELECT * FROM wishlist');
$data = [];

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'data' => $data]);
?>
