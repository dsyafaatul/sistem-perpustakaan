<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id = $_GET['id'];
if(!empty($id)){
	$data_buku_kas = mysql_fetch_array(mysql_query("SELECT * FROM tabel_buku_kas WHERE id='$id'"));
	$hapus_kategori_query = mysql_query("DELETE FROM tabel_buku_kas WHERE id='$id'");
	if($hapus_kategori_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Catatan Buku Kas',NOW());");
		if($data_buku_kas['nis']!==0){
			$konfirmasi_pembayaran = mysql_query("UPDATE tabel_peminjaman SET status_denda='0' WHERE id_peminjaman='$data_buku_kas[id_peminjaman]'");
		}
		if($log_query){
			header("location: index.php?menu=buku_kas&alert=success");
		}
	}else{
		header("Location: index.php?menu=buku_kas&alert=error");
	}
}else{
	header("Location: index.php?menu=buku_kas&alert=error");
}
?>