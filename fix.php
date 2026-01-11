<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = (int)getenv('DB_PORT');

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Perintah SQL Lengkap
$sql = "
DROP TABLE IF EXISTS links, settings, admin;
CREATE TABLE links (id INT AUTO_INCREMENT PRIMARY KEY, judul VARCHAR(255), url VARCHAR(255), ikon VARCHAR(50) DEFAULT 'fa-link', clicks INT DEFAULT 0, is_highlighted TINYINT(1) DEFAULT 0);
CREATE TABLE settings (id INT PRIMARY KEY, running_text TEXT);
CREATE TABLE admin (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), password VARCHAR(255));
INSERT INTO settings (id, running_text) VALUES (1, '🔥 Welcome to Takapedia! | Layanan Joki Terpercaya 24/7');
INSERT INTO admin (username, password) VALUES ('admin', 'Yoga230907');
";

if (mysqli_multi_query($conn, $sql)) {
    echo "<h1>✅ DATABASE BERHASIL DI-FIX!</h1>";
    echo "<p>Semua tabel & data awal sudah masuk.</p>";
    echo "<a href='/'>Klik di sini untuk ke Beranda</a>";
} else {
    echo "❌ Gagal: " . mysqli_error($conn);
}
?>
