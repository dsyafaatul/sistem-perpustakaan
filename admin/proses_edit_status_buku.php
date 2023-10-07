<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$kode_buku = $_GET['kode_buku'];
if(!empty($kode_buku)){
	$data_buku = mysql_fetch_array(mysql_query("SELECT judul_buku,status FROM tabel_buku WHERE kode_buku='$kode_buku'"));
	if($data_buku[1]==1){
	$status_buku_query = mysql_query("UPDATE tabel_buku SET status='0' WHERE kode_buku='$kode_buku'");
	}else{
	$status_buku_query = mysql_query("UPDATE tabel_buku SET status='1' WHERE kode_buku='$kode_buku'");
	}
	if($status_buku_query){
		if($data_buku[1]==1){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengnonaktifkan Buku $data_buku[0]',NOW());");
		}else{
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengaktifkan Buku $data_buku[0]',NOW());");
		}
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