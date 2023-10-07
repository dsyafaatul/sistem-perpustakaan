<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id_kelas = $_GET['id_kelas'];
if(!empty($id_kelas)){
	$data_kelas = mysql_fetch_array(mysql_query("SELECT tingkat,jurusan,status FROM tabel_kelas WHERE id_kelas='$id_kelas'"));
	if($data_kelas[2]==1){
	$status_kelas_query = mysql_query("UPDATE tabel_kelas SET status='0' WHERE id_kelas='$id_kelas'");
	}else{
	$status_kelas_query = mysql_query("UPDATE tabel_kelas SET status='1' WHERE id_kelas='$id_kelas'");
	}
	if($status_kelas_query){
		if($data_kelas[2]==1){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengnonaktifkan Kelas $data_kelas[0] $data_kelas[1]',NOW());");
		}else{
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengaktifkan Kelas $data_kelas[0] $data_kelas[1]',NOW());");
		}
			if($log_query){
				header("location: index.php?menu=kelas&alert=success");
			}
	}else{
		header("Location: index.php?menu=kelas&alert=error");
	}
}else{
	header("Location: index.php?menu=kelas&alert=error");
}
?>