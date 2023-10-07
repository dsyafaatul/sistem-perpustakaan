<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_kategori = $_GET['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nama_kategori)){
		$edit_kategori_buku_query = mysql_query("UPDATE tabel_kategori SET nama_kategori='$nama_kategori' WHERE id_kategori=$id_kategori");
		if($edit_kategori_buku_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data Kategori $nama_kategori',NOW());");
				if($log_query){
					header("location: index.php?menu=kategori_buku&alert=success");
				}
		}else{
			header("location: index.php?menu=kategori_buku&aksi=edit&id_kategori=$id_kategori&alert=error");
		}
	}else{
		header("location: index.php?menu=kategori_buku&aksi=edit&id_kategori=$id_kategori&alert=error");
	}
}else{
	header("location: index.php?menu=kategori_buku&aksi=edit&id_kategori=$id_kategori&alert=error");
}
?>