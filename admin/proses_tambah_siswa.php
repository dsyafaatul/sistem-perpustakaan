<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nis = (is_numeric($_POST['nis']))?$_POST['nis']:header("location: index.php?menu=siswa&alert=error");
$nama_siswa = anti_injection($_POST['nama_siswa']);
$id_kelas = $_POST['id_kelas'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telepon = (is_numeric($_POST['no_telepon']))?$_POST['no_telepon']:header("location: index.php?menu=siswa&alert=error");
$alamat = $_POST['alamat'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nis) AND !empty($nama_siswa) AND !empty($id_kelas) AND !empty($jenis_kelamin) AND !empty($no_telepon) AND !empty($alamat)){
		$tambah_siswa_query = mysql_query("INSERT INTO tabel_siswa VALUES('','$nis','$nama_siswa','$id_kelas','$jenis_kelamin','$no_telepon','$alamat','1')");
		if($tambah_siswa_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan anggota baru $nama_siswa',NOW())");
				if($log_query){
					header("location: index.php?menu=siswa&alert=success");
				}
		}else{
			header("location: index.php?menu=siswa&alert=error");
		}
	}else{
		header("location: index.php?menu=siswa&alert=error");
	}
}else{
	header("location: index.php?menu=siswa&alert=error");
}
?>