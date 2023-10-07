<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$tingkat = (is_numeric($_POST['tingkat']))?$_POST['tingkat']:header("location: index.php?menu=kelas&alert=error");
$jurusan = $_POST['jurusan'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($tingkat) AND !empty($jurusan)){
		$tambah_kelas_query = mysql_query("INSERT INTO tabel_kelas VALUES('','$tingkat','$jurusan','1')");
		if($tambah_kelas_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan kelas Baru $tingkat $jurusan',NOW());");
				if($log_query){
					header("location: index.php?menu=kelas&alert=success");
				}
		}else{
			header("location: index.php?menu=kelas&alert=error");
		}
	}else{
		header("location: index.php?menu=kelas&alert=error");
	}
}else{
	header("location: index.php?menu=kelas&alert=error");
}
?>