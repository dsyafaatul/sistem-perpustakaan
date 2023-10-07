<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nis = $_GET['nis'];
if(!empty($nis)){
	$nama_siswa = mysql_fetch_array(mysql_query("SELECT nama_siswa FROM tabel_siswa WHERE nis='$nis'"));
	$hapus_siswa_query = mysql_query("DELETE FROM tabel_siswa WHERE nis='$nis'");
	if($hapus_siswa_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Anggota $nama_siswa[0]',NOW());");
			if($log_query){
				header("location: index.php?menu=siswa&alert=success");
			}
	}else{
		header("Location: index.php?menu=siswa&alert=error");
	}
}else{
	header("Location: index.php?menu=siswa&alert=error");
}
?>