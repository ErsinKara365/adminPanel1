<?php 
require_once "header.php"; 



$paketler = $db->wread("packets");
$sira = 0;

if (isset($_POST["deleteUsers"])) {
    $silmek = $db->delete("packets", $_POST, ["form_name" => "deleteUsers" , "column_value" => "packet_id"]);
    if ($silmek["error"] == "FALSE") {
      echo '<div class="warning"><h3>'.$silmek["status"].'</h3></div>';
      
  }
}
?>



<div class="packets contentler">
    <h1>Paketler</h1>
    <table>
        <thead>
            <tr>
                <th>Sıra No</th>
                <th>Paket Resim</th>
                <th>Paket İsmi</th>
                <th>Paket Açıklama</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while($paket = $paketler->fetch(PDO::FETCH_ASSOC)){ $sira++ ;?>
                <tr>
                    <td> <?php echo $sira ?></td>
                    <td><img src="resimler/<?php echo $paket["resim"] ?>" alt="<?php echo $paket["resim"] ?>" height="75px" width="auto"></td>
                    <td><?php echo $paket["packet_isim"] ?></td>
                    <td><?php echo $paket["packet_aciklama"] ?></td>

                    <td>
                       <form action="update_packet.php" method="POST">
                        <input type="hidden" name="packet_id" value="<?php echo $paket["packet_id"] ?>">
                        <button class="updateBtn" type="submit" >Güncelle</button>
                    </form>
                    <form action="#" method="POST">
                        <input type="hidden" name="packet_id" value="<?php echo $paket["packet_id"] ?>">
                        <button class="deleteBtn" type="submit" name="deleteUsers">Sil</button>
                    </form>
                    
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
</div>
</div>
</body>
</html>
