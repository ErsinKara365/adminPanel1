<?php 
require_once "file_php/Class_php.php";
require_once "file_php/check_sessions.php";

$db = new crud();


 ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a href="#"> <?php echo $_SESSION['users']["namesurname"]; ?></a>
    </div>
    <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="users.php">Kullanıcılar</a></li>
            <li><a href="hotels.php">Hoteller</a></li>
            <li><a href="packets.php">Paketler</a></li>
            <li><a href="ekipler.php">Üyelerimiz</a></li>
            <li><a href="add-user.php">Kullanıcı Ekle</a></li>
            <li><a href="add-ekip.php">Yeni Üye Ekle</a></li>
            <li><a href="add-hotel.php">Hotel Ekle</a></li>
            <li><a href="add_packet.php">Paket Ekle</a></li>
            <li><a href="profil_ayari.php">Profil Ayari</a></li>
            <li><a href="exit_php.php">Çıkış</a></li>
    </ul>
</div>
 <div class="content">