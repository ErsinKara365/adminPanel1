<?php 
require_once "header.php"; 

if (isset($_POST["deleteUsers"])) {
    $delete = $db->delete("kullanicilar",$_POST, ["column_value" => "mail"]) ;
    if ($delete["error"] == "FALSE") {
      echo '<div class="warning"><h3>'.$delete["status"].'</h3></div>';
      
  }
}
$userask = $db->wread("kullanicilar");
$sira = 0;

?>


<div class="contentler ">
    <h1>Kullanıcılar</h1>
    <table>
        <thead>
            <tr>
                <th>Sıra No</th>
                <th>Kullanıcı İsmi</th>
                <th>Email</th>
                <th>İletişim</th>
                <th>Durumu</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($users =$userask->fetch(PDO::FETCH_ASSOC)){ 

                if ($users["mail"] == $_SESSION['users']["mail"]) {
                    continue;
                }
                $sira += 1;?>
                <tr>
                    <td><?php echo $sira ?></td>
                    <td><?php echo $users["namesurname"] ?></td>
                    <td><?php echo $users["mail"] ?></td>
                    <td><?php echo $users["iletisim"] ?></td>
                    <td><?php echo $users["users_status"] ?></td>
                    <td >
                        <form action="update_user.php" method="POST">
                            <input type="hidden" name="mail" value="<?php echo $users["mail"] ?>">
                            <button class="updateBtn" type="submit" >Güncelle</button>
                        </form>
                        <form action="#" method="POST">
                            <input type="hidden" name="mail" value="<?php echo $users["mail"] ?>">
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
