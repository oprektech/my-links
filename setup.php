<?php
include 'db.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS links (id INT AUTO_INCREMENT PRIMARY KEY, judul VARCHAR(255), url VARCHAR(255), ikon VARCHAR(50) DEFAULT 'fa-link', clicks INT DEFAULT 0, is_highlighted TINYINT(1) DEFAULT 0) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
    "CREATE TABLE IF NOT EXISTS settings (id INT PRIMARY KEY, running_text TEXT) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
    "INSERT IGNORE INTO settings (id, running_text) VALUES (1, '🔥 Selamat Datang di Takapedia! | Layanan Joki & Top Up 24 Jam.')",
    "CREATE TABLE IF NOT EXISTS admin (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), password VARCHAR(255))",
    "INSERT IGNORE INTO admin (username, password) VALUES ('admin', 'Yoga230907')"
];

echo "<h2>Status Setup Database:</h2>";

foreach ($queries as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "✅ Perintah Berhasil dijalankan.<br>";
    } else {
        echo "❌ Gagal: " . mysqli_error($conn) . "<br>";
    }
}

echo "<br><a href='index.php'>Klik di sini untuk ke halaman utama</a>";
?>
