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
    <link rel="stylesheet" href="../wishlist-liburan/style.css">
    <title>Wishlist Liburan</title>
</head>
<body>
    <header>
        <h1>Dream Destinations</h1>
        <p>List your favorite holiday spots around the world</p>
    </header>
        
    <div class="container">
        <form action="add.php" method="POST" enctype="multipart/form-data" class="form-wishlist">
            <label for="destination">Destinasi:</label>
            <input type="text" id="destination" name="destination" placeholder="Masukkan destinasi" required><br>

            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" placeholder="Tambahkan deskripsi"></textarea><br>

            <label for="image">Unggah Gambar:</label>
            <input type="file" id="image" name="image"><br>

            <button type="submit" class="btn-submit">Tambahkan</button>
        </form>

        <h2>Daftar Wishlist</h2>
        <ul class="wishlist-list">
            <?php while ($row = $results->fetchArray()) : ?>
            <li class="wishlist-item">
                <h3><?php echo $row['destination']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <?php if ($row['image']) : ?>
                <img src="images/<?php echo $row['image']; ?>" alt="Foto <?php echo $row['destination']; ?>" width="150">
                <?php endif; ?>
                <div class="action-links">
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Hapus</a>
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