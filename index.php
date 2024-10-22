<?php
include 'db.php';
$db = getDBConnection();

// Ambil data dari database
$results = $db->query('SELECT * FROM wishlist');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Liburan</title>
    <link rel="stylesheet" href="../wishlist-liburan/css/style.css">
</head>
<body>
<header>
    <h1>Wishlist Liburan ke Luar Negeri</h1>
</header>

<div class="container">
    <form action="add.php" method="POST" enctype="multipart/form-data" class="form-wishlist">
        <label for="destination">Destinasi:</label>
        <input type="text" id="destination" name="destination" placeholder="Masukkan destinasi" required autocomplete="off" autofocus>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" placeholder="Tambahkan deskripsi"></textarea>

        <label for="image">Unggah Gambar:</label>
        <input type="file" id="image" name="image">

        <button type="submit" class="btn-submit">Tambahkan</button>
    </form>

    <h2>Daftar Wishlist</h2>
    <ul class="wishlist-list">
        <?php while ($row = $results->fetchArray()) : ?>
        <li class="wishlist-item">
            <?php if ($row['image']) : ?>
            <img src="images/<?php echo $row['image']; ?>" alt="Foto <?php echo $row['destination']; ?>" class="wishlist-image">
            <?php endif; ?>
            <div>
                <h3><?php echo $row['destination']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <div class="action-links">
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="?action=delete&id=<?= $movie['id']; ?>" class="btn" onclick="return confirm('Anda yakin ingin menghapus ini?');">Hapus</a>
                </div>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Wishlist Liburan. All rights reserved.</p>
</footer>
</body>
</html>
