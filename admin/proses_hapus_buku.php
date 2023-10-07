<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$kode_buku = $_GET['kode_buku'];
if(!empty($kode_buku)){
	$judul_buku = mysql_fetch_array(mysql_query("SELECT judul_buku FROM tabel_buku WHERE kode_buku='$kode_buku'"));
	$hapus_siswa_query = mysql_query("DELETE FROM tabel_buku WHERE kode_buku='$kode_buku'");
	if($hapus_siswa_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Buku $judul_buku[0]',NOW());");
			if($log_query){
				header("location: index.php?menu=buku&alert=success");
			}
	}else{
		header("Location: index.php?menu=buku&alert=error");
	}
}else{
	header("Location: index.php?menu=buku&alert=error");
}
?>