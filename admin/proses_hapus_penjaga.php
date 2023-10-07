<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_GET['id_penjaga'];
if(!empty($id_penjaga)){
	$data_penjaga = mysql_fetch_array(mysql_query("SELECT nama_penjaga FROM tabel_penjaga WHERE id_penjaga='$id_penjaga'"));
	$hapus_penjaga_query = mysql_query("DELETE FROM tabel_penjaga WHERE id_penjaga='$id_penjaga'");
	if($hapus_penjaga_query){
		$id_penjaga = $_SESSION['id_penjaga'];
		$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menghapus Penjaga $data_penjaga[0]',NOW());");
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