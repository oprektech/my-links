<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = (int)getenv('DB_PORT'); // Pastikan dibaca sebagai angka

// Coba koneksi dengan timeout 5 detik
$conn = mysqli_init();
if (!$conn) { die("mysqli_init failed"); }

mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

// Melakukan koneksi
$konek = @mysqli_real_connect($conn, $host, $user, $pass, $db, $port);

if (!$konek) {
    die("Gagal Konek Database: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
