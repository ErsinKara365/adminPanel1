<?php 
require_once "header.php"; 

if (isset($_POST["hotel_kayit"])) {
    $hotelEkle = $db->insert("hotels", $_POST, $_FILES["resim"], ["form_name" => "hotel_kayit"], $_FILES["resimler"] );
    


    if ($hotelEkle["error"] == "TRUE"){
        echo '<div class="success"><h3>Hotel Eklendi </h3></div>';

    } else if ($hotelEkle["error"] == "FALSE") {
        echo '<div class="warning"><h3>'.$hotelEkle["status"].'</h3></div>';
    } 
   


} ?>

<div class="add_container">
    <h1>Hotel Ekle</h1>
    <form action="#" method="POST" enctype="multipart/form-data"> 
        <label for="profile-picture">Ana Resim:</label>
        <input type="file" id="profile-picture" name="resim">

        <label for="profile-picture">Ayrıntılı Resimler:</label>
        <input type="file" id="profile-picture" name="resimler[]" multiple>

        <label for="name">Hotel İsim:</label>
        <input type="text" id="name" name="hotel_isim" >

        <label for="name">Hotel Adres:</label>
        <input type="text" id="name" name="hotel_adres" >


        <label for="email">Hotel İletisim :</label>
        <input type="text" id="email" name="hotel_iletisim" >

        <label for="surname">Hotel Aciklama :</label>
        <textarea name="hotel_aciklama" id="hotel_aciklama"></textarea>

        <button type="submit" name="hotel_kayit" >Kaydet</button>
    </form>

</div>
</div>
</body>
</html>
