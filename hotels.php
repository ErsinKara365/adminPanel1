<?php require_once "header.php"; 


$hotelListe = $db->wread("hotels");
$sira= 0;

if (isset($_POST["hotelDlt"])) {
    $hotelDlt = $db->delete("hotels", $_POST, ["column_value" => "hotel_id" , "resimler" => True]);
    print_r($hotelDlt);
}

?>


<div class="contentler">
    <h1>Oteller</h1>
    <table>
        <thead>
            <tr>
                <th>Sıra No</th>
                <th>Otel İsmi</th>
                <th>Açıklama</th>
                <th>İletişim</th>
                <th>Adres</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while($hotel= $hotelListe->fetch(PDO::FETCH_ASSOC)){ $sira +=1 ;?>
                <tr>
                    <td> <?php echo $sira ?></td>
                    <td> <?php echo $hotel["hotel_isim"] ?></td>
                    <td><?php echo $hotel["hotel_aciklama"] ?></td>
                    <td><?php echo $hotel["hotel_iletisim"] ?></td>
                    <td><?php echo $hotel["hotel_adres"] ?></td>
                    <td>
                        <form action="update_hotel.php" method="POST">
                            <input type="hidden" name="hotel_id" value="<?php echo $hotel["hotel_id"] ?>"> 
                            <button type="submit" class="updateBtn" name="" >Değiştir</button> 
                        </form>
                        <form action="#" method="POST">
                            <input type="hidden" name="hotel_id" value="<?php echo $hotel["hotel_id"] ?>"> 
                            <button type="submit" class="deleteBtn" name="hotelDlt" >Sil</button> 
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
