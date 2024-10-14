<?php
include 'db.php';
$db = getDBConnection();

$id = $_GET['id'];

// Hapus data dari database
$stmt = $db->prepare('DELETE FROM wishlist WHERE id = ?');
$stmt->bindValue(1, $id, SQLITE3_INTEGER);
$stmt->execute();

header('Location: index.php');
exit;
?>
