<?php
include '../db.php'; // Pastikan jalur ke db.php benar
$db = getDBConnection();

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari database
    $stmt = $db->prepare('DELETE FROM wishlist WHERE id = ?');
    $stmt->bindValue(1, $id, SQLITE3_INTEGER);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Parameter id tidak ditemukan']);
}
?>
