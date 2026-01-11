<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OprekTech - Link</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-color: #050505; --card-color: #1a1a1a; --accent: #ffffff; }
        body { background: var(--bg-color); color: #fff; font-family: 'Poppins', sans-serif; margin: 0; display: flex; flex-direction: column; align-items: center; }
        
        /* Running Text */
        .marquee-container { background: #ff0055; color: white; padding: 8px 0; width: 100%; overflow: hidden; position: sticky; top: 0; z-index: 100; font-size: 0.85rem; font-weight: bold; }
        
        .profile-section { margin-top: 40px; text-align: center; }
        .profile-img { width: 110px; height: 110px; background: #333; border-radius: 50%; margin: 0 auto 15px; border: 3px solid #222; overflow: hidden; }
        .profile-img img { width: 100%; }
        
        .handle { font-weight: 600; font-size: 1.3rem; margin-bottom: 5px; }
        .bio { max-width: 320px; font-size: 0.9rem; color: #aaa; margin-bottom: 20px; line-height: 1.4; padding: 0 20px; }

        .wa-badge { background: #25d366; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.75rem; cursor: pointer; border: none; margin-bottom: 25px; transition: 0.3s; }
        .wa-badge:active { transform: scale(0.9); }

        .link-container { width: 90%; max-width: 400px; padding-bottom: 50px; }
        .link-card { background: var(--card-color); color: #fff; padding: 16px; border-radius: 12px; margin-bottom: 12px; display: flex; align-items: center; text-decoration: none; border: 1px solid #333; transition: 0.3s; position: relative; }
        
        /* Efek Glow/Pulse untuk Link Highlight */
        .highlight { border: 2px solid #fff; animation: pulse 2s infinite; }
        @keyframes pulse { 
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); } 
            70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); } 
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); } 
        }

        .link-card i { font-size: 1.3rem; width: 30px; margin-right: 15px; }
        .link-card span { flex-grow: 1; }
        .link-card.disabled { opacity: 0.6; cursor: default; }
        .link-card:not(.disabled):hover { background: #252525; transform: translateY(-3px); }

        .footer { font-size: 0.7rem; color: #444; margin-bottom: 30px; }
    </style>
</head>
<body>

    <!-- Running Text Dinamis -->
    <?php 
    $set = mysqli_query($conn, "SELECT running_text FROM settings WHERE id=1");
    $s = mysqli_fetch_assoc($set);
    ?>
    <div class="marquee-container">
        <marquee scrollamount="6"><?= $s['running_text'] ?></marquee>
    </div>

    <div class="profile-section">
        <div class="profile-img">
            <img src="1768141321473.jpg" alt="Logo">
        </div>
        <div class="handle">OprekTech</div>
        <div class="bio">Edukasi IT, Website, Apps, IoT 💻 <br>Jangan Lupa Support dan Follow Sosmed Gw !!!</div>
        <button class="wa-badge" onclick="copyWA()">
            <i class="fab fa-whatsapp"></i> +62Test (Salin)
        </button>
    </div>

    <div class="link-container">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM links");
        while($row = mysqli_fetch_assoc($query)) { 
            $is_soon = ($row['url'] == "#");
            $class = "link-card";
            if($row['is_highlighted']) $class .= " highlight";
            if($is_soon) $class .= " disabled";
            
            // Link diarahkan ke go.php untuk hitung statistik
            $href = $is_soon ? "javascript:void(0)" : "go.php?id=" . $row['id'];
            ?>
            <a href="<?= $href ?>" class="<?= $class ?>" <?= !$is_soon ? 'target="_blank"' : '' ?>>
                <i class="<?= $row['ikon'] ?>"></i>
                <span><?= $row['judul'] ?></span>
                <?php if($is_soon) echo '<small style="font-size:10px; background:#444; padding:2px 6px; border-radius:4px;">SOON</small>'; ?>
            </a>
        <?php } ?>
    </div>

    <div class="footer">MADE WITH <b>OPREKTECH</b></div>

    <script>
    function copyWA() {
        navigator.clipboard.writeText("+6283131315353");
        alert("Nomor WhatsApp berhasil disalin!");
    }
    </script>
</body>
</html>
