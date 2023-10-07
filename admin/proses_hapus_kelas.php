<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_kelas = $_GET['id_kelas'];
if(!empty($id_kelas)){
	$nama_kelas = mysql_fetch_array(mysql_query("SELECT tingkat,jurusan FROM tabel_kelas WHERE id_kelas='$id_kelas'"));
	$hapus_kelas_query = mysql_query("DELETE FROM tabel_kelas WHERE id_kelas='$id_kelas'");
	if($hapus_kelas_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Kelas $nama_kelas[tingkat] $nama_kelas[jurusan]',NOW());");
			if($log_query){
				header("location: index.php?menu=kelas&alert=success");
			}
	}else{
		header("Location: index.php?menu=kelas&alert=error");
	}
}else{
	header("Location: index.php?menu=kelas&alert=error");
}
?>