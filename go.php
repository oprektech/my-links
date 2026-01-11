<?php
include 'db.php'; // Pastikan koneksi db benar

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // 1. Tambah jumlah klik di database
    mysqli_query($conn, "UPDATE links SET clicks = clicks + 1 WHERE id = '$id'");
    
    // 2. Ambil URL tujuan dari database
    $res = mysqli_query($conn, "SELECT url FROM links WHERE id = '$id'");
    $row = mysqli_fetch_assoc($res);
    
    $urlTujuan = $row['url'];

    // 3. Cek jika URL kosong atau cuma '#' (Soon)
    if(empty($urlTujuan) || $urlTujuan == "#") {
        header("Location: index.php");
    } else {
        // 4. Redirect ke URL asli
        header("Location: " . $urlTujuan);
    }
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>