<?php 

if (empty($_SESSION['users']["users_sessions"])) {
	header("location:../login/index.php");
	exit("Yetkisiz Giriş");
}



 ?>