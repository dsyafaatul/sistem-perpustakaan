<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nama_penjaga = $_POST['nama_penjaga'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telepon = (is_numeric($_POST['no_telepon']))?$_POST['no_telepon']:header("location: index.php?menu=profile&alert=error");
$alamat = $_POST['alamat'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nama_penjaga) AND !empty($jenis_kelamin) AND !empty($no_telepon) AND !empty($alamat)){
		$edit_penjaga_query = mysql_query("UPDATE tabel_penjaga SET nama_penjaga='$nama_penjaga',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',alamat='$alamat' WHERE id_penjaga='$id_penjaga'");
		if($edit_penjaga_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data Profile $nama_penjaga',NOW());");
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
?>