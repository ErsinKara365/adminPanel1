<?php require_once "header.php"; 


if (isset($_POST["hotel_id"])) {
    $hotels = $db->wread("hotels","hotel_id",$_POST['hotel_id']);
    $hotel = $hotels->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST["hotel_update"])) {
    echo "basladi<br>";
    $updateHotel = $db->update("hotels",$_POST,$_FILES['resim'],["form_name" => "hotel_update","column_key" => "hotel_id", "header" => "hotels.php"]);
    if ($updateHotel["error"] == "FALSE") {
         echo "<div class='warning'><h3>".$updateHotel["status"]."</h3></div>";
    } 
}

?>
   
<div class="update_container">
    <h1>Hotel Güncelle</h1>
    <img src="resimler/<?php echo $hotel["resim"] ?>" alt="" width="100px" height="100px" >
    <form action="#" enctype="multipart/form-data" method="post"> 

       

        <label for="profile-picture">Resim:</label>
        <input type="file" id="profile-picture" name="resim" >
        
        <input type="hidden" value="<?php echo $hotel["hotel_id"] ?>" name="hotel_id">
        <label for="name">Hotel İsim :</label>
        <input type="text" id="name" name="hotel_isim" placeholder="" value="<?php echo $hotel["hotel_isim"] ?>"  >

        <label for="name">Hotel iletisim :</label>
        <input type="tel" id="name" name="hotel_iletisim" placeholder="" value="<?php echo $hotel["hotel_iletisim"] ?>">

        <label for="email">Adres :</label>
        <input type="text" id="email" name="hotel_adres" placeholder="" value="<?php echo $hotel["hotel_adres"] ?>">

        <label for="email">Aciklama :</label>
       <textarea name="hotel_aciklama" id="hotel_aciklama"><?php echo $hotel["hotel_aciklama"] ?>
       </textarea>

        <button type="submit" name="hotel_update">Güncelle</button>
    </form>  

</div>
</div>    

</body>
</html>
