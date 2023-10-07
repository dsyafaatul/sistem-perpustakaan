<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_GET['id_penjaga'];
if(!empty($id_penjaga)){
	$data_penjaga = mysql_fetch_array(mysql_query("SELECT nama_penjaga,status FROM tabel_penjaga WHERE id_penjaga='$id_penjaga'"));
	if($data_penjaga[1]==1){
	$status_penjaga_query = mysql_query("UPDATE tabel_penjaga SET status='0' WHERE id_penjaga='$id_penjaga'");
	}else{
	$status_penjaga_query = mysql_query("UPDATE tabel_penjaga SET status='1' WHERE id_penjaga='$id_penjaga'");
	}
	if($status_penjaga_query){
		$id_penjaga = $_SESSION['id_penjaga'];
		if($data_penjaga[1]==1){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengnonaktifkan Penjaga $data_penjaga[0]',NOW());");
		}else{
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengaktifkan Penjaga $data_penjaga[0]',NOW());");
		}
			if($log_query){
				header("location: index.php?menu=penjaga&alert=success");
			}
	}else{
		header("Location: index.php?menu=penjaga&alert=error");
	}
}else{
	header("Location: index.php?menu=penjaga&alert=error");
}
?>