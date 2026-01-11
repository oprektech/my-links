<?php
session_start();
include 'db.php';

if(isset($_POST['login'])) {
    if($_POST['user'] == 'admin' && $_POST['pass'] == 'Yoga230907') $_SESSION['admin'] = true;
}
if(isset($_GET['logout'])) { session_destroy(); header("Location: admin.php"); }

// Update Running Text
if(isset($_POST['update_text'])) {
    $txt = mysqli_real_escape_string($conn, $_POST['running_text']);
    mysqli_query($conn, "UPDATE settings SET running_text='$txt' WHERE id=1");
}

// Tambah Link
if(isset($_POST['add'])) {
    $judul = $_POST['judul'];
    $url = empty($_POST['url']) ? "#" : $_POST['url'];
    $ikon = $_POST['ikon'];
    $high = isset($_POST['highlight']) ? 1 : 0;
    mysqli_query($conn, "INSERT INTO links (judul, url, ikon, is_highlighted) VALUES ('$judul', '$url', '$ikon', $high)");
}

if(isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM links WHERE id=" . $_GET['delete']);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Pro - Takapedia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .card { max-width: 600px; background: #fff; padding: 20px; margin: auto; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        input, select, textarea { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #000; color: #fff; border: none; padding: 12px; width: 100%; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .stat-box { display: flex; justify-content: space-between; background: #fafafa; padding: 10px; border-radius: 5px; margin-bottom: 5px; border-left: 4px solid #000; }
    </style>
</head>
<body>

<div class="card">
    <?php if(!isset($_SESSION['admin'])): ?>
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="user" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <button name="login">Masuk</button>
        </form>
    <?php else: ?>
        <h2>Settings <a href="?logout" style="float:right; font-size:12px;">Logout</a></h2>
        
        <!-- Setting Running Text -->
        <form method="POST">
            <label>Running Text Promo:</label>
            <?php $res = mysqli_query($conn, "SELECT running_text FROM settings WHERE id=1"); $s = mysqli_fetch_assoc($res); ?>
            <textarea name="running_text"><?= $s['running_text'] ?></textarea>
            <button name="update_text" style="background: #555;">Update Running Text</button>
        </form>
        <hr>

        <!-- Tambah Link -->
        <h3>Tambah Link Baru</h3>
        <form method="POST">
            <input type="text" name="judul" placeholder="Judul Link" required>
            <input type="text" name="url" placeholder="URL (Kosongkan untuk 'Soon')">
            <select name="ikon">
                <option value="fab fa-whatsapp">WhatsApp</option>
                <option value="fab fa-instagram">Instagram</option>
                <option value="fas fa-shopping-cart">Store</option>
                <option value="fas fa-fire">Hot Promo</option>
                <option value="fas fa-link">General Link</option>
            </select>
            <label><input type="checkbox" name="highlight"> Aktifkan Efek Glow (Highlight)</label>
            <button name="add">Simpan Link</button>
        </form>

        <hr>
        <h3>Statistik Klik & Kelola</h3>
        <?php
        $links = mysqli_query($conn, "SELECT * FROM links ORDER BY clicks DESC");
        while($l = mysqli_fetch_assoc($links)) {
            echo "<div class='stat-box'>
                    <div>
                        <strong>{$l['judul']}</strong><br>
                        <small>Klik: {$l['clicks']} | Highlight: ".($l['is_highlighted']?'Ya':'Tidak')."</small>
                    </div>
                    <a href='?delete={$l['id']}' style='color:red; text-decoration:none;'>Hapus</a>
                  </div>";
        }
        ?>
    <?php endif; ?>
</div>

</body>
</html>