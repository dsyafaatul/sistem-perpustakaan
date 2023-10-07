<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$kode_buku = $_GET['kode_buku'];
$judul_buku = $_POST['judul_buku'];
$id_kategori = $_POST['id_kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok = (is_numeric($_POST['stok']))?$_POST['stok']:header("location: index.php?menu=buku&aksi=edit&kode_buku=$kode_buku&alert=error");
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($judul_buku) AND !empty($id_kategori) AND !empty($pengarang) AND !empty($penerbit) AND !empty($tahun_terbit) AND !empty($stok)){
		$edit_buku_query = mysql_query("UPDATE tabel_buku SET judul_buku='$judul_buku',id_kategori='$id_kategori',pengarang='$pengarang',penerbit='$penerbit',tahun_terbit='$tahun_terbit', stok='$stok' WHERE kode_buku='$kode_buku'");
		if($edit_buku_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data Buku $judul_buku',NOW());");
				if($log_query){
					header("location: index.php?menu=buku&alert=success");
				}
		}else{
			header("location: index.php?menu=buku&aksi=edit&kode_buku=$kode_buku&alert=error");
		}
	}else{
		header("location: index.php?menu=buku&aksi=edit&kode_buku=$kode_buku&alert=error");
	}
}else{
	header("location: index.php?menu=buku&aksi=edit&kode_buku=$kode_buku&alert=error");
}
?>