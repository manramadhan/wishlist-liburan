<?php
$db = new PDO('sqlite:' . __DIR__ . '/database.db');

$db->exec("CREATE TABLE IF NOT EXISTS wishlist (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    destination TEXT NOT NULL,
    description TEXT NOT NULL
)");

if (isset($_POST['destination']) && isset($_POST['description'])) {
    $destination = $_POST['destination'];
    $description = $_POST['description'];

    $query = "INSERT INTO wishlist (destination, description) VALUES ('$destination', '$description')";
    $db->query($query);
}

$results = $db->query("SELECT * FROM wishlist");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Liburan di Luar Negeri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="hero">
            <h1>Dream Destinations</h1>
            <p>List your favorite holiday spots around the world</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="">
            <input type="text" name="destination" placeholder="Enter Destination" required>
            <textarea name="description" placeholder="Enter Description" required></textarea>
            <button type="submit">Add Destination</button>
        </form>

        <h2>Your Wishlist</h2>

        <div class="wishlist-grid">
            <?php foreach ($results as $row): ?>
                <div class="wishlist-item">
                    <img src="../wishlist-liburan/fuji-web.jpg" alt="Destinasi Liburan">
                    <h3><?php echo $row['destination']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <div class="actions">
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Wishlist Liburan di Luar Negeri. All rights reserved.</p>
    </footer>
</body>
</html>
