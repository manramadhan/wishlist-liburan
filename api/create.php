<?php
include '../db.php'; // Pastikan jalur ke db.php benar
$db = getDBConnection();

// Debug: Tampilkan semua data POST yang diterima
error_log(print_r($_POST, true)); // Log data yang diterima

// Periksa apakah data 'destination' dan 'description' ada di request
if (isset($_POST['destination']) && isset($_POST['description'])) {
    $destination = $_POST['destination'];
    $description = $_POST['description'];

    // Simpan ke database
    $stmt = $db->prepare('INSERT INTO wishlist (destination, description) VALUES (?, ?)');
    $stmt->bindValue(1, $destination);
    $stmt->bindValue(2, $description);
    
    // Jalankan pernyataan dan tangani kemungkinan error
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan data ke database']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap. Pastikan field "destination" dan "description" dikirim.']);
}
?>
