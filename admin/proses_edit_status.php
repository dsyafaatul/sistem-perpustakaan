<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_peminjaman = $_GET['id_peminjaman'];
$action = $_POST['action'];
	if(!empty($id_peminjaman)){
		$data_peminjaman = mysql_fetch_array(mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_buku WHERE tabel_peminjaman.nis=tabel_siswa.nis AND tabel_peminjaman.kode_buku=tabel_buku.kode_buku AND tabel_peminjaman.id_peminjaman='$id_peminjaman'"));
		$config = mysql_fetch_array(mysql_query("SELECT * FROM config"));
		if($data_peminjaman[status_peminjaman]=="0"){
			$sekarang = date("Y-m-d");
			if($data_peminjaman['batas_waktu']<$sekarang){
				$sekarang_date_time = new DateTime(date("Y-m-d"));
				$batas_waktu_date_time = new DateTime($data_peminjaman['batas_waktu']);
				$selisih = $sekarang_date_time->diff($batas_waktu_date_time)->days;
				$denda = $config['denda']*$selisih;
				$keterangan = ($selisih>0)?0:1;
				$status_denda = 0;
			}else{
				$denda = 0;
				$keterangan = 1;
			}
			$edit_status_query = mysql_query("UPDATE tabel_peminjaman SET status='1',denda='$denda',keterangan='$keterangan',tanggal_kembali='$sekarang',status_denda='$status_denda' WHERE id_peminjaman=$id_peminjaman");
		}else{
			$edit_status_query = mysql_query("UPDATE tabel_peminjaman SET status='0',denda=0,keterangan='',tanggal_kembali='' WHERE id_peminjaman='$id_peminjaman'");
		}
		if($edit_status_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','$data_peminjaman[nama_siswa] Mengembalikan Buku $data_peminjaman[judul_buku]',NOW());");
				if($log_query){
					if($data_peminjaman[status_peminjaman]=="0"){
						header("location: index.php?menu=pengembalian&alert=success");
					}else{
						header("location: index.php?menu=pengembalian&alert=success");
					}
				}
		}else{
			header("location: index.php?menu=pengembalian&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
		}
	}else{
		header("location: index.php?menu=pengembalian&aksi=edit&id_peminjaman=$id_peminjaman&alert=error");
	}
?>