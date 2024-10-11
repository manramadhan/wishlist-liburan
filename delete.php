<?php
$db = new PDO('sqlite:database.db');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM wishlist WHERE id = $id";
    $db->exec($query);

    header('Location: index.php');
    exit;
}
?>