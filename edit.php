<?php
$db = new PDO('sqlite:database.db');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $db->query("SELECT * FROM wishlist WHERE id = $id");
    $row = $result->fetch();
}

if (isset($_POST['destination']) && isset($_POST['description'])) {
    $destination = $_POST['destination'];
    $description = $_POST['description'];

    $query = "UPDATE wishlist SET destination = '$destination', description = '$description' WHERE id = $id";
    $db->exec($query);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi</title>
    <link rel="stylesheet" href="../wishlist-liburan/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Destinasi</h1>

        <form method="POST" action="">
            <input type="text" name="destination" value="<?php echo $row['destination']; ?>" required>
            <textarea name="description" required><?php echo $row['description']; ?></textarea>
            <button type="submit">Perbarui Destinasi</button>
            <a href="index.php" class="back-button">Kembali</a> 
        </form>
    </div>
</body>
</html>
