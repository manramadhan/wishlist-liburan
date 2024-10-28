<?php
include 'db.php';
$db = getDBConnection();

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

$destination = $data['destination'];
$description = $data['description'];
$image = $data['image'];

$stmt = $db->prepare('UPDATE wishlist SET destination = ?, description = ?, image = ? WHERE id = ?');
$stmt->bindValue(1, $destination);
$stmt->bindValue(2, $description);
$stmt->bindValue(3, $image);
$stmt->bindValue(4, $id, SQLITE3_INTEGER);
$result = $stmt->execute();

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data']);
}
?>
