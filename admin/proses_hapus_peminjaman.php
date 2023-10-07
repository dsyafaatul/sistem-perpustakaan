<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_peminjaman = $_GET['id_peminjaman'];
$data_peminjaman = mysql_fetch_array(mysql_query("SELECT nis,kode_buku FROM tabel_peminjaman WHERE id_peminjaman='$id_peminjaman'"));
$data_buku = mysql_fetch_array(mysql_query("SELECT judul_buku,stok,kode_buku FROM tabel_buku WHERE kode_buku='$data_peminjaman[kode_buku]'"));
$hapus_peminjaman_query = mysql_query("DELETE FROM tabel_peminjaman WHERE id_peminjaman='$id_peminjaman'");
	$nis = $data_peminjaman['nis'];
if(!empty($id_peminjaman)){
	if($hapus_peminjaman_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Peminjaman Buku $data_buku[judul_buku]',NOW());");
			if($log_query){
				header("location: index.php?menu=siswa&aksi=detail&nis=$nis&alert=success");
			}
	}else{
		header("Location: index.php?menu=siswa&aksi=detail&nis=$nis&alert=error");
	}
}else{
	header("Location: index.php?menu=siswa&aksi=detail&nis=$nis&alert=error");
}
?>