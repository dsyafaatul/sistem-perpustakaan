<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$kode_buku = $_POST['kode_buku'];
$judul_buku = $_POST['judul_buku'];
$id_kategori = $_POST['id_kategori'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = is_numeric($_POST['tahun_terbit'])?$_POST['tahun_terbit']:header("location: index.php?menu=buku&alert=error");
$stok = (is_numeric($_POST['stok']))?$_POST['stok']:header("location: index.php?menu=buku&alert=error");
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($judul_buku) AND !empty($id_kategori) AND !empty($pengarang) AND !empty($penerbit) AND !empty($tahun_terbit) AND !empty($stok)){
		$tambah_buku_query = mysql_query("INSERT INTO tabel_buku VALUES('','$kode_buku','$judul_buku','$id_kategori','$pengarang','$penerbit','$tahun_terbit',NOW(),'$stok','1')");
		if($tambah_buku_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan Buku Baru $judul_buku',NOW());");
				if($log_query){
					header("location: index.php?menu=buku&alert=success");
				}
		}else{
			header("location: index.php?menu=buku&alert=error");
		}
	}else{
		header("location: index.php?menu=buku&alert=error");
	}
}else{
	header("location: index.php?menu=buku&alert=error");
}
?>