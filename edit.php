<?php
include 'db.php';
$db = getDBConnection();

$id = $_GET['id'];

// Ambil data wishlist berdasarkan id
$stmt = $db->prepare('SELECT * FROM wishlist WHERE id = ?');
$stmt->bindValue(1, $id, SQLITE3_INTEGER);
$result = $stmt->execute()->fetchArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = $_POST['destination'];
    $description = $_POST['description'];

    // Proses update database
    $stmt = $db->prepare('UPDATE wishlist SET destination = ?, description = ? WHERE id = ?');
    $stmt->bindValue(1, $destination);
    $stmt->bindValue(2, $description);
    $stmt->bindValue(3, $id, SQLITE3_INTEGER);
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
    <title>Edit Wishlist</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Edit Wishlist</h1>
</header>

<div class="container">
    <form action="" method="POST" class="form-wishlist">
        <label for="destination">Destinasi:</label>
        <input type="text" id="destination" name="destination" value="<?php echo $result['destination']; ?>" required autofocus><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description"><?php echo $result['description']; ?></textarea><br>

        <button type="submit" class="btn-submit">Simpan</button>
        <a href="index.php" class="btn-back">Kembali</a>
    </form>
</div>
</body>
</html>
