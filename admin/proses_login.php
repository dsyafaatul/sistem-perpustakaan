<?php
//created by dsyafaatul
	include("koneksi.php");
	$username = anti_injection($_POST["username"]);
	$password = anti_injection($_POST["password"]);
	$cookie = $_POST["cookie"];
	$action = $_POST['action'];
	if(!empty($action)){
		if(!empty($username) AND !empty($password)){
			$login_query = mysql_query("SELECT * FROM tabel_penjaga WHERE username='$username' AND status='1'");
			$data_penjaga = mysql_fetch_array($login_query);
			$id_penjaga = $data_penjaga['id_penjaga'];
			$cek = mysql_num_rows($login_query);
			if($cek>0){
				if(password_verify($password,$data_penjaga['password'])){
					buatsession($username,$password);
					if($cookie){
						setcookie("username_cookie",$data_penjaga['username'], time() + (60 * 60 * 24 * 30));
					}
					$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Berhasil Login',NOW());");
						if($log_query){
							if($data_penjaga['level']==="Admin"){
								$_SESSION['level'] = "Admin";
							}else{
								$_SESSION['level'] = "Petugas";
							}
							header("location: index.php");
						}
				}else{
					if(isset($_POST['back'])){
						header("location: lockscreen.php?alert=error");
					}else{
						header("Location: login.php?alert=error2");
					}
				}
			}else{
				header("Location: login.php?alert=error1");
			}
		}else{
			if(isset($_POST['back'])){
				header("location: lockscreen.php?alert=error");
			}else{
				header("Location: login.php?alert=error1");
			}
		}
	}else{
		header("Location: login.php?alert=error1");
	}
?>