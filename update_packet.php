<?php require_once "header.php"; 


if(isset($_POST['packet_id'])){
    $packets = $db->wread("packets","packet_id",$_POST['packet_id']);
    $packet = $packets->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST["packet_update"])) {
    $updatePacket = $db->update("packets",$_POST, $_FILES['resim'], ["form_name" => "packet_update","column_key" => "packet_id", "header" => "packets.php"]);
    if ($updatePacket["error"] == "FALSE") {
        echo "<div><h3>".$updatePacket["status"]."</h3></div>";
    } 

    
}

?>

    
        <div class="update_container">
            <h1>Paket Güncelle</h1>
            <img src="resimler/<?php echo $packet["resim"] ?>" alt="" width="100px" height="100px" >
            <form action="#" enctype="multipart/form-data" method="post"> 

                

                <label for="profile-picture">Resim:</label>
                <input type="file" id="profile-picture" name="resim" >
                <input type="hidden" name="packet_id" value="<?php echo $packet["packet_id"] ?>">

                <label for="name">Hotel İsim :</label>
                <input type="text" id="name" name="packet_isim" placeholder="<?php echo $packet["packet_isim"] ?>" value="<?php echo $packet["packet_isim"] ?>"  >

                <label for="email">Aciklama :</label>
                <textarea name="packet_aciklama" id="packet_aciklama"><?php echo $packet["packet_aciklama"] ?></textarea>

                <button type="submit" name="packet_update">Paket Güncelle</button>
            </form>  

        </div>
    </div>    

</body>
</html>
