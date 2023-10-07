<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nis = $_POST['nis'];
$kode_buku = $_POST['kode_buku'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nis) AND !empty($kode_buku)){
		$data_siswa = mysql_fetch_array(mysql_query("SELECT nama_siswa FROM tabel_siswa WHERE nis='$nis'"));
		$data_buku = mysql_fetch_array(mysql_query("SELECT judul_buku,stok FROM tabel_buku WHERE kode_buku='$kode_buku'"));
		$config = mysql_fetch_array(mysql_query("SELECT * FROM config"));
		$count = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE nis='$nis' AND status='0'"));
		$tanggal_pinjam = date("Y-m-d");
		$batas_waktu = date("Y-m-d",strtotime("+$config[lama_pinjam_maksimal] days"));
		if($count<$config['jumlah_pinjam_maksimal']){
		$tambah_peminjaman_query = mysql_query("INSERT INTO tabel_peminjaman VALUES('','$id_penjaga','$nis','$kode_buku','$tanggal_pinjam','$batas_waktu','0000-00-00','0','','0','')");
		if($tambah_peminjaman_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan peminjaman baru dari $data_siswa[nama_siswa]',NOW());");
				if($log_query){
					header("location: index.php?menu=peminjaman&alert=success");
				}
		}else{
			header("location: index.php?menu=peminjaman&alert=error");
		}
		}else{
			header("location: index.php?menu=peminjaman&alert=error");
		}
	}else{
		header("location: index.php?menu=peminjaman&alert=error");
	}
}else{
	header("location: index.php?menu=peminjaman&alert=error");
}
?>