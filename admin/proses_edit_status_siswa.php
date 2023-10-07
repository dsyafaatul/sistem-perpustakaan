<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nis = $_GET['nis'];
if(!empty($nis)){
	$data_siswa = mysql_fetch_array(mysql_query("SELECT nama_siswa,status FROM tabel_siswa WHERE nis='$nis'"));
	if($data_siswa[1]==1){
	$status_siswa_query = mysql_query("UPDATE tabel_siswa SET status='0' WHERE nis='$nis'");
	}else{
	$status_siswa_query = mysql_query("UPDATE tabel_siswa SET status='1' WHERE nis='$nis'");
	}
	if($status_siswa_query){
		if($data_siswa[1]==1){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengnonaktifkan Anggota $data_siswa[0]',NOW());");
		}else{
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengaktifkan Anggota $data_siswa[0]',NOW());");
		}
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