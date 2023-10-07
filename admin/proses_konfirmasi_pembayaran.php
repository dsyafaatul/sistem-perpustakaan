<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_peminjaman = $_GET['id_peminjaman'];
$action = $_POST['action'];
	if(!empty($id_peminjaman)){
		$data_peminjaman = mysql_fetch_array(mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_buku.* FROM tabel_peminjaman,tabel_siswa,tabel_buku WHERE tabel_peminjaman.nis=tabel_siswa.nis AND tabel_peminjaman.kode_buku=tabel_buku.kode_buku AND tabel_peminjaman.id_peminjaman='$id_peminjaman'"));
		$konfirmasi_pembayaran = mysql_query("UPDATE tabel_peminjaman SET status_denda='1' WHERE id_peminjaman='$id_peminjaman'");
		$config = mysql_fetch_array(mysql_query("SELECT * FROM config"));
		if($konfirmasi_pembayaran){
			$status = 1;
			$denda = $data_peminjaman['denda'];
			$tambah_buku_kas_query = mysql_query("INSERT INTO tabel_buku_kas VALUES('','$id_penjaga','$data_peminjaman[id_peminjaman]','$status','$data_peminjaman[nama_siswa] Membayar denda','$denda',NOW())");
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','$data_peminjaman[nama_siswa] Membayar denda',NOW());");
				if($log_query){
					header("location: index.php?menu=pengembalian&alert=success");
				}
		}else{
			header("location: index.php?menu=pengembalian&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
		}
	}else{
		header("location: index.php?menu=pengembalian&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
	}
?>