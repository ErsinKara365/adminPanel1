<?php 
require_once "header.php";

$bilgiler = $db->wread("kullanicilar","users_sessions", $_SESSION['users']["users_sessions"]); 
$bilgi = $bilgiler->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["users_kayit"])) {
    $updateask = $db->update("kullanicilar", $_POST, $_FILES['resim'], [
        "form_name" => "users_kayit" ,
        "column_key" => "mail", 
        "pass" => "users_pass",
        "header" => true]);
   if ($updateask["error"] == "FALSE") {
      echo '<div class="warning"><h3>'.$updateask["status"].'</h3></div>';
  }

}
?>



    <div class="add_container">
        <h1>Profil Ayarlari</h1>
        <img src="resimler/<?php echo $bilgi["resim"]; ?>" alt="<?php echo $bilgi["resim"]; ?>" width="100px" height="100px" >
        <form action="#" enctype="multipart/form-data" method="post"> 



            <label for="profile-picture">Resim:</label>
            <input type="file" id="profile-picture" name="resim" >


            <label for="name">İsim Soyisim :</label>
            <input type="text" id="name" name="namesurname" value="<?php echo $bilgi["namesurname"]; ?>">

            <label for="name">iletisim :</label>
            <input type="tel" id="name" name="iletisim" value="<?php echo $bilgi["iletisim"]; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="mail" value="<?php echo $bilgi["mail"]; ?>" placeholder="<?php echo $bilgi["mail"]; ?>" readonly  >

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="users_pass" placeholder="Yeni Sifreniz ?"   >

            <button type="submit" name="users_kayit">Profil Güncelle</button>
        </form>  

    </div>
</div>


</body>
</html>
