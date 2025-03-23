<?php 
require_once "header.php";


if (isset($_POST["packet_kayit"])) {
    $packetEkle = $db->insert("packets", $_POST, $_FILES['resim'] ,["form_name" => "packet_kayit"]);
   if ($packetEkle["error"] == "TRUE") {
       echo "<div class='success'><h3> Paket Eklendi</h3></div>";
   } else if ($packetEkle["error"] == "FALSE"){
    echo "<div class='warning'> <h3>".$packetEkle["status"]."</h3></div> " ;
}
}

?>

<div class="add_container">
    <h1>Paket Ekle</h1>
    <form action="#" method="POST" enctype="multipart/form-data"> 
        <label for="profile-picture">Paket Resim:</label>
        <input type="file" id="profile-picture" name="resim">

        <label for="name">Paket İsim:</label>
        <input type="text" id="name" name="packet_isim" >       


        <label for="surname">Paket Aciklama :</label>
        <textarea name="packet_aciklama" id="packet_aciklama"></textarea>

        <button type="submit" name="packet_kayit" >Kaydet</button>
    </form>
</div>
</div>
</body>
</html>
