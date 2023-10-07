<?php
//created by dsyafaatul
	session_start();
	$koneksi = mysql_connect("localhost","root","");
	$databse = mysql_select_db("db_perpustakaan");

	if($koneksi AND $databse){
		// echo "Koneksi berhasil";
	}else{
		echo "Error :",mysql_error();
	}
	error_reporting(E_NOTICE ^(E_NOTICE | E_WARNING));

	function anti_injection($data){
		$filter=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}

	function buatsession($username){
		$query_login = mysql_query("SELECT * FROM tabel_penjaga WHERE username='$username'");
		$data_penjaga = mysql_fetch_array($query_login);
		$_SESSION['username'] = $username;
		$_SESSION['id_penjaga'] = $data_penjaga['id_penjaga'];
		$_SESSION['level'] = $data_penjaga['level'];
	}
	function cekuser($username){
		$query_login = mysql_query("SELECT * FROM tabel_penjaga WHERE username='$username'");
		$data_penjaga = mysql_fetch_array($query_login);
		$cek = mysql_num_rows($query_login);
		if($cek>0){
			return true;
			// header("Location: index.php");
		}else{
			setcookie("username_cookie","",time()-3600);
			return false;
		}
    }
    // var_dump(cekuser($_COOKIE['username_cookie'],$_COOKIE['password_cookie']));
    // var_dump($_COOKIE['username_cookie']);
    // var_dump($_COOKIE['password_cookie']);
?>