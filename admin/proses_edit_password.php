<?php
//created by dsyafaatul
include("koneksi.php");
$password_lama = anti_injection($_POST['password_lama']);
$password_baru = anti_injection($_POST['password_baru']);
$password_baru_ulang = anti_injection($_POST['password_baru_ulang']);
$id_penjaga = $_SESSION['id_penjaga'];
$action = $_POST['action'];
	if(!empty($action)){
		if(!empty($password_lama) AND !empty($password_baru) AND !empty($password_baru_ulang)){
			$data_penjaga_query = mysql_query("SELECT * FROM tabel_penjaga WHERE id_penjaga='$id_penjaga'");
			$data_penjaga = mysql_fetch_array($data_penjaga_query);
			$validasi =  mysql_num_rows($data_penjaga_query);
			if($validasi>=1){
				if(password_verify($password_lama,$data_penjaga['password'])){
					if($password_baru == $password_baru_ulang){
						$password_baru = password_hash($password_baru,PASSWORD_BCRYPT);
							$ganti_password_query = mysql_query("UPDATE tabel_penjaga SET password='$password_baru' WHERE id_penjaga='$id_penjaga'");
							if($ganti_password_query){
								$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengubah Password',NOW());");
								if($log_query){
									header("location: index.php?menu=profile&alert=success");
								}
							}else{
								header("location: index.php?menu=profile&alert=error");
							}
					}else{
						header("location: index.php?menu=profile&alert=error");
					}
				}else{
					header("location: index.php?menu=profile&alert=error");
				}
			}else{
				header("location: index.php?menu=profile&alert=error");
			}
		}else{
			header("location: index.php?menu=profile&alert=error");
		}
	}else{
		header("location: index.php?menu=profile&alert=error");
	}
?>