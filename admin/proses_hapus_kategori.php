<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_kategori = $_GET['id_kategori'];
if(!empty($id_kategori)){
	$data_kategori = mysql_fetch_array(mysql_query("SELECT nama_kategori,status FROM tabel_kategori WHERE id_kategori='$id_kategori'"));
	$hapus_kategori_query = mysql_query("DELETE FROM tabel_kategori WHERE id_kategori='$id_kategori'");
	if($hapus_kategori_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Anggota $data_kategori[0]',NOW());");
			if($log_query){
				header("location: index.php?menu=kategori_buku&alert=success");
			}
	}else{
		header("Location: index.php?menu=kategori_buku&alert=error");
	}
}else{
	header("Location: index.php?menu=kategori_buku&alert=error");
}
?>