<?php
// Koneksi ke SQLite
function getDBConnection() {
    $db = new SQLite3('wishlist.db'); 
    return $db;
}

// Buat tabel jika belum ada
function initializeDatabase() {
    $db = getDBConnection();
    $db->exec("CREATE TABLE IF NOT EXISTS wishlist (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        destination TEXT NOT NULL,
        description TEXT,
        image TEXT
    )");
}

initializeDatabase();
?>
