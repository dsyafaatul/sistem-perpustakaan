<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nama_kategori = $_POST['nama_kategori'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nama_kategori)){
		$tambah_kategori_query = mysql_query("INSERT INTO tabel_kategori VALUES('','$nama_kategori','1')");
		if($tambah_kategori_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan Kategori Baru $nama_kategori',NOW());");
				if($log_query){
					header("location: index.php?menu=kategori_buku&alert=success");
				}
		}else{
			header("location: index.php?menu=kategori_buku&alert=error");
		}
	}else{
		header("location: index.php?menu=kategori_buku&alert=error");
	}
}else{
	header("location: index.php?menu=kategori_buku&alert=error");
}
?>