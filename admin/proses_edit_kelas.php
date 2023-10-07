<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_kelas = $_GET['id_kelas'];
$tingkat = (is_numeric($_POST['tingkat']))?$_POST['tingkat']:header("location: index.php?menu=kelas&aksi=edit&id_kelas=$id_kelas&alert=error");
$jurusan = $_POST['jurusan'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($tingkat) AND !empty($jurusan)){
		$edit_kelas_query = mysql_query("UPDATE tabel_kelas SET tingkat='$tingkat',jurusan='$jurusan' WHERE id_kelas=$id_kelas");
		if($edit_kelas_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data kelas $tingkat $jurusan',NOW());");
				if($log_query){
					header("location: index.php?menu=kelas&alert=success");
				}
		}else{
			header("location: index.php?menu=kelas&aksi=edit&id_kelas=$id_kelas&alert=error");
		}
	}else{
		header("location: index.php?menu=kelas&aksi=edit&id_kelas=$id_kelas&alert=error");
	}
}else{
	header("location: index.php?menu=kelas&aksi=edit&id_kelas=$id_kelas&alert=error");
}
?>