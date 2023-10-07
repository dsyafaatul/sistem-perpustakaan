<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_peminjaman = $_GET['id_peminjaman'];
$action = $_POST['action'];
	if(!empty($id_peminjaman)){
		$data_peminjaman = mysql_fetch_array(mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_buku.* FROM tabel_peminjaman,tabel_siswa,tabel_buku WHERE tabel_peminjaman.nis=tabel_siswa.nis AND tabel_peminjaman.kode_buku=tabel_buku.kode_buku AND tabel_peminjaman.id_peminjaman='$id_peminjaman'"));
		$config = mysql_fetch_array(mysql_query('SELECT * FROM config'));
		$batas_waktu = date('Y-m-d',strtotime("+$config[lama_pinjam_maksimal] days $data_peminjaman[batas_waktu]"));
		$perpanjang = mysql_query("UPDATE tabel_peminjaman SET batas_waktu='$batas_waktu',keterangan='' WHERE id_peminjaman=$id_peminjaman");
		if($perpanjang){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','$data_peminjaman[nama_siswa] Memperpanjang Memperpanjang Buku $data_peminjaman[judul_buku]',NOW());");
				if($log_query){
					header("location: index.php?menu=pengembalian&alert=success");
				}
		}else{
			header("location: index.php?menu=pengembalian&alert=error");
		}
	}else{
		header("location: index.php?menu=pengembalian&alert=error");
	}
?>