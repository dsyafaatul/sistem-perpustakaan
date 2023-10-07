<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_peminjaman = $_GET['id_peminjaman'];
$nis = $_POST['nis'];
$kode_buku = $_POST['kode_buku'];
$action = $_POST['action'];
if(!empty($action)){
	$data_siswa = mysql_fetch_array(mysql_query("SELECT nama_siswa FROM tabel_siswa WHERE nis='$nis'"));
	$data_buku = mysql_fetch_array(mysql_query("SELECT judul_buku FROM tabel_buku WHERE kode_buku='$kode_buku'"));
	$edit_peminjaman_query = mysql_query("UPDATE tabel_peminjaman SET kode_buku='$kode_buku' WHERE id_peminjaman=$id_peminjaman");
	if(!empty($kode_buku)){
		if($edit_peminjaman_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Peminjaman $data_siswa[0] $data_buku[0]',NOW());");
				if($log_query){
					header("location: index.php?menu=siswa&aksi=detail&nis=$nis&alert=success");
				}
		}else{
			header("location: index.php?menu=siswa&aksi=detail&nis=$nis&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
		}
	}else{
		header("location: index.php?menu=siswa&aksi=detail&nis=$nis&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
	}
}else{
	header("location: index.php?menu=siswa&aksi=detail&nis=$nis&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
}
?>