<?php 
require_once "header.php";


if(isset($_POST["mail"])){

   $userask = $db->wread("kullanicilar","mail", $_POST["mail"]);
   $user = $userask->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['updateUsers'])) {

  $updateask = $db->update("kullanicilar", $_POST, $_FILES['resim'], ["form_name" => "updateUsers" , "column_key" => "mail", "header" => "users.php" ]);
  if ($updateask["error"] == "FALSE") {
      echo '<div class="warning"><h3>'.$updateask["status"].'</h3></div>';
      
  }
}
?>

<style>
    
    #users_status {
        height: 50px;
        border-radius: 5px;
        padding-left: 20px;
        font-size: 1.2em;
        text-transform: capitalize;
    }
</style>


    <div class="update_container">
        <h1>Kullanıcı Güncelle</h1>
        <img src="resimler/<?php echo $user["resim"] ?>" alt="<?php echo $user["resim"] ?>" width="100px" height="100px" >
        <form action="#" enctype="multipart/form-data" method="POST"> 

            <label for="profile-picture">Resim:</label>
            <input type="file" id="profile-picture" name="resim" >


            <label for="name">İsim Soyisim :</label>
            <input type="text" id="name" name="namesurname" placeholder="<?php echo $user["namesurname"] ?>" value="<?php echo $user["namesurname"]; ?>"  >

            <label for="name">iletisim :</label>
            <input type="tel" id="name" name="iletisim" placeholder="<?php echo $user["iletisim"] ?>" value="<?php echo $user["iletisim"]; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="<?php echo $user["mail"] ?>" name="mail" value="<?php echo $user["mail"]; ?>"  readonly>
            

            <?php  if($_SESSION['users']["users_status"] == "admin"){ ?>
                <label for="email">Kullanici Durum :</label>
                <select name="users_status" id="users_status">
                   <option value="askida" <?php echo ($user["users_status"] == "askida")? "selected":"" ; ?> >askida</option>
                   <option value="kullanici" <?php echo ($user["users_status"] == "kullanici")? "selected":"" ; ?>  >kullanici</option>
                   <option value="admin" <?php echo ($user["users_status"] == "admin")? "selected":"" ; ?>  >admin</option>
               </select>
           <?php }  ?>
           <button type="submit" name="updateUsers" >Güncelle</button>
       </form>  

   </div>
</div>    

</body>
</html>
