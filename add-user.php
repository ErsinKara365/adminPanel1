<?php 
require_once "header.php"; ?>


    <?php 
    if (isset($_POST['users_kayit'])) {
        $insert = $db->insert("kullanicilar",$_POST, $_FILES['resim'], ["form_name" => "users_kayit" , "pass" => "users_pass", "check_mail" => "mail"]);

        if ($insert["error"] == "FALSE") {
            echo "<div class='warning'><h3>".$insert["status"]."</h3></div>";
        }else if ($insert["error"] == "TRUE"){
            echo '<div class="success"><h3>İşlem Tamamdir</h3></div>';  
        }
    }
    ?>

    <div class="add_container">
        <h1>Kullanıcı Ekle</h1>

        <form action="#" enctype="multipart/form-data" method="post"> 

            <label for="profile-picture">Resim:</label>
            <input type="file" id="profile-picture" name="resim">


            <label for="name">İsim Soyisim :</label>
            <input type="text" id="name" name="namesurname" required>

            <label for="name">iletisim :</label>
            <input type="tel" id="name" name="iletisim" >

            <label for="email">Email:</label>
            <input type="email" id="email" name="mail" required>

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="users_pass" required>


            <button type="submit" name="users_kayit">Kaydet</button>
        </form>  

    </div>



</div>


</body>
</html>
