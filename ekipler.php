<?php 
require_once "header.php"; 

$ekiplerimiz = $db->wread("ekiplerimiz");

$sira = 0;

if (isset($_POST["ekipSil"])) {
 $db->delete("ekiplerimiz",$_POST, ["column_value" => "ekip_id"]  );
 
}


?>


<div class="contentler">
    <h1>Ekiplerimiz</h1>
    <table>
        <thead>
            <tr>
                <th>Sıra No</th>
                <th>Üye İsim</th>
                <th>Üye Resim</th>
                
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
         <?php while($ekip = $ekiplerimiz->fetch(PDO::FETCH_ASSOC)){ $sira ++;?>
            <tr>
                <td><?php echo $sira ?></td>
                <td><img src="resimler/<?php echo $ekip["resim"] ?>" alt="" height="75px" width="auto"></td>
                <td><?php echo $ekip["ekip_isim"] ?> </td>
                <td>
                   
                 
                    <form action="update_ekip.php" method="POST">
                        <input type="hidden" name="ekip_id" value="<?php echo $ekip["ekip_id"] ?>">
                        <button class="updateBtn" type="submit" name="ekipUpdate">Değiştir</button>
                    </form>
                    <form action="#" method="POST">
                        <input type="hidden" name="ekip_id" value="<?php echo $ekip["ekip_id"] ?>">
                        <button class="deleteBtn" type="submit" name="ekipSil">Sil</button>
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
