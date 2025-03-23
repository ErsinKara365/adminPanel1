<?php
session_start();

require_once 'dbconfig.php';

class crud  {

	private $db;
	private $dbhost=DBHOST;
	private $dbuser=DBUSER;
	private $dbpass=DBPWD;
	private $dbname=DBNAME;


	function __construct() {
		try {
			$this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);
			/*echo "Bağlantı Başarılı";*/
		} catch (Exception $e) {
			die("Bağlantı Başarısız:".$e->getMessage());
		}
	}	

	public function addValue($argse) {

		$values=implode(',',array_map(function ($item){
			return $item.'=?';
		},array_keys($argse)));

		return $values;
	}

	public function login($mail, $pass){
		try {
			$loginask = $this->db->prepare("SELECT * FROM kullanicilar WHERE mail=? AND users_pass=?");
			$loginask->execute([htmlspecialchars($mail) , md5(htmlspecialchars($pass))]);
			$okey = $loginask->rowCount();

			if ($okey == 1) {
				$users = $loginask->fetch(PDO::FETCH_ASSOC);
				if ($users["users_status"] == "askida") {
					throw new Exception("Hesap Askıya Alınmıştır.");
				}

				$id = md5(uniqid());

				$loginupdate = $this->db->prepare("UPDATE kullanicilar SET users_sessions=? WHERE mail=? AND users_pass=?");
				$loginupdate->execute([$id , htmlspecialchars($mail) , md5(htmlspecialchars($pass))]);

				$_SESSION['users'] = [
					"namesurname" => $users["namesurname"],
					"users_status" => $users["users_status"],
					"users_resim" => $users["resim"],
					"mail" => $users["mail"],
					"users_sessions" => $id
				];

				header("location:../admin/index.php");
				exit;

			} else {
				throw new Exception("Mail veya Şifre Hatası !");
			}

		} catch (Exception $e) {
			return ["error" => "FALSE" , "status" => $e->getMessage()];
		}
	}

	public function imageUpload($name, $tmpname, $size){
		try {

			$uzanti = strtolower(pathinfo($name, PATHINFO_EXTENSION));

			$izinliUzantilar = ["jpg" ,"jpeg","png","ico", "gif", "png"];
			if ( !in_array($uzanti, $izinliUzantilar) ) {
				throw new Exception("Bu Resim Uzantisi Olmaz!");
			}

			if ($size > 3000000) {
				throw new Exception("Resim Boyutu Çok Büyüktür $name");
			}

			$yeni_isim = uniqid("R-").".".$uzanti;
			
			if (!move_uploaded_file($tmpname, "resimler/$yeni_isim")) {
				throw new Exception("Resim Yükleme Hatasi Olustu $tmpname");
			}

			return $yeni_isim ;

			
		} catch (Exception $e) {
			return ["error" => "FALSE" , "status" => $e->getMessage()];
			
		}
	}

	public function wread($table, $column_key=null, $column_value=null, $option=[]){
		if (!empty($column_key)) {
			$liste =$this->db->prepare("SELECT * FROM $table WHERE $column_key=?");
			$liste->execute([$column_value]);
			
		} else {
			$liste =$this->db->prepare("SELECT * FROM $table");
			$liste->execute();
		}
		return $liste;
	}

	public function insert ($table , $post,$resim, $option=[], $resimler=null){

		try {

			$resimListesi = [];
			if (isset($option["form_name"])) {
				unset($post[$option["form_name"]]);
			}

			if (isset($option["pass"])) {
				$post[$option["pass"]] = md5($post[$option["pass"]]);
			}
			
			if (!empty($resimler)) {
				foreach ($resimler['tmp_name'] as $key => $value) {				

					$Name = basename($resimler['name'][$key]);
					$tmpName =$resimler['tmp_name'][$key];
					$size =$resimler['size'][$key];				

					$isim = $this->imageUpload($Name, $tmpName,$size);
					
					if (is_array($isim)) {
						if ($isim["error"] == "FALSE") {					
							throw new Exception($isim["status"]);					
						}
					}
					$resimListesi[] = $isim;
				}

				$json_resimler = json_encode($resimListesi);
				$post["resimler"] = $json_resimler;				
			}

			if (!empty($option["referans"])) {
				$post["referans"] = $_SESSION['users']["namesurname"];
			}

			if (isset($option["check_mail"])) {
				$column_key = $option["check_mail"];
				$column_value =  $post[$option["check_mail"]];
				$liste = $this->wread("kullanicilar",$column_key, $column_value);
				$varmi = $liste->rowCount();
				if ($varmi == 1) {
					throw new Exception("Bu Mail Zaten var!");
				}
				$post[$option["pass"]] = md5($post[$option["pass"]]);
			}

			if ($resim["error"] == 0) {
				$resimdurum = $this->imageUpload($resim["name"], $resim["tmp_name"], $resim["size"]);
				if (isset($resimdurum["error"])=="FALSE") {
					throw new Exception($resimdurum["status"]);

				}
				$post["resim"] = $resimdurum ;
			}

			$insert =$this->db->prepare("INSERT $table SET {$this->addValue($post)} ");
			$insert->execute(array_values($post));
			return ["error" => "TRUE" ];
		} catch (Exception $e) {
			return ["error" => "FALSE" , "status" => $e->getMessage()];
		}
	}

	public function update($table, $post, $resim,$option=[]){
		/*header => gidecegi sayfa yazılır*/
		/* colum_key => mail veya id*/
		try {
			global $column_value ;
			global $column_key ;

			if (isset($option["form_name"])) {
				unset($post[$option["form_name"]]);
			}

			if (isset($post["users_pass"])) {
				if (empty($post["users_pass"])) {
					unset($post["users_pass"]);
				} else {
					$post["users_pass"] = md5($post["users_pass"]);
				}
			}

			if (isset($option["column_key"])) {
				global $column_value ;
				global $column_key ;
				$column_value = $post[$option["column_key"]];
				$column_key = $option["column_key"];
				unset($post[$option["column_key"]]);
			}

			if ($resim["error"] == 0) {
				global $column_value ;
				global $column_key ;
				$eski= $this->wread($table,$column_key, $column_value );
				$eskiresim = $eski->fetch(PDO::FETCH_ASSOC);
				$resimyolu = $eskiresim["resim"];
				if (!empty($resimyolu)) {
					if (file_exists("resimler/$resimyolu")) {
						unlink("resimler/$resimyolu");
					}				
				}

				$upload = $this->imageUpload($resim["name"],$resim["tmp_name"],$resim["size"]);

				if (isset($upload["error"]) == "FALSE") {
					throw new Exception($upload["status"]);
				} else {
					$post["resim"] = $upload ;
				}
			}
				
			$updates = $this->db->prepare("UPDATE $table SET {$this->addValue($post)} WHERE $column_key=? ");
			$post[$column_key] = $column_value;
			$updates->execute(array_values($post));
			
			header("location:".$option["header"]);
			exit();

		} catch (Exception $e) {
			return ["error" => "FALSE" , "status" => $e->getMessage()];
			
		}
	}

	public function delete($table, $post, $option=[]){
		/* option içerisinde column_value -> id veya mail  */
		try {
			$column_value = $post[$option["column_value"]] ;
			$column_key = array_keys($post)[0];

			$resimyolu = $this->wread($table, $column_key, $column_value);
			$resimler = $resimyolu->fetch(PDO::FETCH_ASSOC);
			$eskiresim = $resimler["resim"];

			if (@file_exists("resimler/$eskiresim")) {
				unlink("resimler/$eskiresim") ;
			}

			if ($option["resimler"] == True) {
				$eskiResim = $resimler["resimler"];
				$eskiResimler = json_decode($eskiResim);
				foreach($eskiResimler as $key => $value){
					if (@file_exists("resimler/$value")) {
						unlink("resimler/$value") ;
					}
				}				
			}

			$delete = $this->db->prepare("DELETE FROM $table WHERE $column_key=?");
			$delete->execute([$column_value]);
			
			header("location:".$_SERVER["PHP_SELF"]);
			exit;
		} catch (Exception $e) {
			return ["error" => "FALSE" , "status" => $e->getMessage()];
			
		}
	}

}

?>