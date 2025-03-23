<?php 
require_once "header.php"; 


if (isset($_POST["ekip_kayit"])) {

    $ekip_kayit=$db->insert("ekiplerimiz",$_POST, $_FILES["resim"], ["form_name" => "ekip_kayit","referans" => True]);

    if ($ekip_kayit["error"] == "TRUE"){
        echo '<div class="success"><h3>Yeni Üye Eklendi </h3></div>';

    } else if ($ekip_kayit["error"] == "FALSE") {
        echo '<div class="warning"><h3>'.$ekip_kayit["status"].'</h3></div>';
    } 
}




?>




<div class="add_container">
    <h1>Yeni Üye Ekle</h1>

    <form action="#" enctype="multipart/form-data" method="post"> 

        <label for="profile-picture">Resim:</label>
        <input type="file" id="profile-picture" name="resim" required>


        <label for="name">İsim Soyisim :</label>
        <input type="text" id="name" name="ekip_isim" required>


        <button type="submit" name="ekip_kayit">Yeni Üye Kaydet</button>
    </form>  

</div>
</div>


</body>
</html>
