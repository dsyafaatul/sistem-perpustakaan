<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
if(isset($_GET['hapus'])){
	$hapus_log_aktivitas_query = mysql_query("TRUNCATE log");
	if($hapus_log_aktivitas_query){
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Log Aktivitas',NOW());");
			if($log_query){
				header("location: index.php?alert=success");
			}
	}else{
		header("Location: index.php?alert=error");
	}
}else{
	header("Location: index.php?alert=error");
}
?>