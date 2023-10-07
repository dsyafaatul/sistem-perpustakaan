<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];
$uang = is_numeric($_POST['uang'])?$_POST['uang']:header("location: index.php?menu=buku_kas&alert=error");
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($keterangan) AND !empty($uang)){
		$tambah_buku_kas_query = mysql_query("INSERT INTO tabel_buku_kas VALUES('','$id_penjaga','','$status','$keterangan','$uang',NOW())");
		if($tambah_buku_kas_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Menambahkan Catatan Buku Kas',NOW());");
				if($log_query){
					header("location: index.php?menu=buku_kas&alert=success");
				}
		}else{
			header("location: index.php?menu=buku_kas&alert=error");
		}
	}else{
		header("location: index.php?menu=buku_kas&alert=error");
	}
}else{
	header("location: index.php?menu=buku_kas&alert=error");
}
?>