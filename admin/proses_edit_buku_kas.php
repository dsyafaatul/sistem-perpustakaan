<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$id = $_GET['id'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];
$uang = is_numeric($_POST['uang'])?$_POST['uang']:header("location: index.php?menu=buku_kas&alert=error");
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($keterangan) AND !empty($uang)){
		$edit_buku_kas_query = mysql_query("UPDATE tabel_buku_kas SET status='$status',keterangan='$keterangan',uang='$uang' WHERE id=$id");
		if($edit_buku_kas_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Catatan Buku Kas',NOW());");
				if($log_query){
					header("location: index.php?menu=buku_kas&alert=success");
				}
		}else{
			header("location: index.php?menu=buku_kas&aksi=edit&id=$id&alert=error");
		}
	}else{
		header("location: index.php?menu=buku_kas&aksi=edit&id=$id&alert=error");
	}
}else{
	header("location: index.php?menu=buku_kas&aksi=edit&id=$id&alert=error");
}
?>