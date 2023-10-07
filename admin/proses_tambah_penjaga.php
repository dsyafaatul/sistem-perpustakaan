<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$username = $_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
$nama_penjaga = anti_injection($_POST['nama_penjaga']);
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telepon = (is_numeric($_POST['no_telepon']))?$_POST['no_telepon']:header("location: index.php?menu=penjaga&alert=error");
$alamat = $_POST['alamat'];
$level = "Penjaga";
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($username) AND !empty($password) AND !empty($nama_penjaga) AND !empty($jenis_kelamin) AND !empty($no_telepon) AND !empty($alamat)){
		$tambah_data_penjaga = mysql_query("INSERT INTO tabel_penjaga VALUES('','$username','$password','$nama_penjaga','$jenis_kelamin','$no_telepon','$alamat','user.jpg','$level','1')");
		echo mysql_error();
		if($tambah_data_penjaga){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan Penjaga Baru $nama_penjaga',NOW());");
				if($log_query){
					header("location: index.php?menu=penjaga&alert=success");
				}
		}else{
			header("location: index.php?menu=penjaga&alert=error");
		}
	}else{
		header("location: index.php?menu=penjaga&alert=error");
	}
}else{
	header("location: index.php?menu=penjaga&alert=error");
}
?>