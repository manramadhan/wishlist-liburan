<?php
include 'db.php';
$db = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = $_POST['destination'];
    $description = $_POST['description'];
    $image = '';

    // Proses upload gambar
    if (!empty($_FILES['image']['name'])) {
        // Buat folder 'images/' di root project jika belum ada
        $image = basename($_FILES['image']['name']);
        $target_dir = 'images/';  // Mengubah path ke 'images/' bukan 'css/image/'
        $target_file = $target_dir . $image;

        // Periksa apakah folder 'images/' ada, jika tidak buat folder
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Buat folder jika tidak ada
        }

        // Pindahkan file yang di-upload ke folder 'images/'
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo "Gambar berhasil diupload!";
        } else {
            echo "Upload gambar gagal!";
        }
    }

    // Insert ke database
    $stmt = $db->prepare('INSERT INTO wishlist (destination, description, image) VALUES (?, ?, ?)');
    $stmt->bindValue(1, $destination);
    $stmt->bindValue(2, $description);
    $stmt->bindValue(3, $image);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wishlist Liburan</title>
    <style>
        /* Sama seperti pada file sebelumnya */
    </style>
</head>
<body>

    <div class="container-tambah">
        <h2>Tambah Wishlist Liburan</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Upload Gambar Tempat Wisata</label>
            <input type="file" name="gambar"><br>
            <label>Nama Tempat Wisata</label>
            <input type="text" name="nama_tempat"><br>
            <label>Deskripsi Tempat</label>
            <textarea name="deskripsi" rows="5"></textarea><br>
            <input type="submit" name="submit" value="Tambah Wishlist"><br>
            <a href="wishlist.php">Kembali</a>
        </form>
    </div>

</body>
</html>
