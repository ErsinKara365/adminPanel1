<?php require_once "header.php"; 

if (isset($_POST["ekip_id"])) {
    $ekiplerimiz = $db->wread("ekiplerimiz","ekip_id",$_POST['ekip_id']);
    $ekip = $ekiplerimiz->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST["ekip_update"])) {
    echo "basladi<br>";
    $updateEkip = $db->update("ekiplerimiz",$_POST,$_FILES['resim'],["form_name" => "ekip_update","column_key" => "ekip_id", "header" => "ekipler.php"]);
    if ($updateEkip["error"] == "FALSE") {
         echo "<div class='warning'><h3>".$updateEkip["status"]."</h3></div>";
    } 
}


?>

   
        <div class="update_container">
            <h1>Kullanıcı Güncelle</h1>
            <img src="resimler/<?php echo $ekip["resim"] ?>" alt="" width="100px" height="100px" >
            <form action="#" enctype="multipart/form-data" method="POST"> 



                <label for="profile-picture">Resim:</label>
                <input type="file" id="profile-picture" name="resim" >

                <input type="hidden" name="ekip_id" value="<?php echo $ekip["ekip_id"] ?>">
                <label for="name">İsim Soyisim :</label>
                <input type="text" id="name" name="ekip_isim" value="<?php echo $ekip["ekip_isim"] ?>"  >

                <button type="submit" name="ekip_update">Ekip Güncelle</button>
            </form>  

        </div>
    </div>    

</body>
</html>
