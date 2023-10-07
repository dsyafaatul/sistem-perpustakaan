<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','	Berhasil Logout',NOW());");
if($log_query){
	session_destroy();
	setcookie("username_cookie","", time() + (60 * 60 * 24 * 30));
	header("Location: login.php");
}else{
	header("Location: index.php");
}
?>