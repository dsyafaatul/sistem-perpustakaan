<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_GET['id_penjaga'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama_penjaga = $_POST['nama_penjaga'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telepon = (is_numeric($_POST['no_telepon']))?$_POST['no_telepon']:header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
$alamat = $_POST['alamat'];
$nama_foto = date(YmdHis)."_".$_FILES['foto']['name'];
$type_foto = $_FILES['foto']['type'];
$size_foto = $_FILES['foto']['size'];
$max_size= 1000000;
$type = array("image/jpg","image/jpeg","image/png");
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($username) AND !empty($nama_penjaga) AND !empty($jenis_kelamin) AND !empty($no_telepon) AND !empty($alamat)){
	$password_hash = password_hash($password,PASSWORD_BCRYPT);
		if(!empty($password) AND !empty($type_foto)){
			if($size_foto<=$max_size){
				if(in_array($type_foto, $type)){
				move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$nama_foto);
								$ganti_foto_query = mysql_query("UPDATE tabel_penjaga SET foto_penjaga='$nama_foto' WHERE id_penjaga='$id_penjaga'");
				$edit_penjaga_query = mysql_query("UPDATE tabel_penjaga SET username='$username',password='$password_hash',nama_penjaga='$nama_penjaga',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',alamat='$alamat' WHERE id_penjaga='$id_penjaga'");
					}else{
						header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
					}
				}else{
					header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
				}
		}else if(!empty($password) AND empty($type_foto)){
			$edit_penjaga_query = mysql_query("UPDATE tabel_penjaga SET username='$username',password='$password_hash',nama_penjaga='$nama_penjaga',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',alamat='$alamat' WHERE id_penjaga='$id_penjaga'");
		}else if(empty($password) AND !empty($type_foto)){
			if($size_foto<=$max_size){
				if(in_array($type_foto, $type)){
						move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$nama_foto);
						$ganti_foto_query = mysql_query("UPDATE tabel_penjaga SET foto_penjaga='$nama_foto' WHERE id_penjaga='$id_penjaga'");
						$edit_penjaga_query = mysql_query("UPDATE tabel_penjaga SET username='$username',nama_penjaga='$nama_penjaga',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',alamat='$alamat' WHERE id_penjaga='$id_penjaga'");
					}else{
						header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
					}
				}else{
					header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
				}
		}else if(empty($password) AND empty($type_foto)){
			$edit_penjaga_query = mysql_query("UPDATE tabel_penjaga SET username='$username',nama_penjaga='$nama_penjaga',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',alamat='$alamat' WHERE id_penjaga='$id_penjaga'");
		}
		if($edit_penjaga_query){
			$id_penjaga = $_SESSION['id_penjaga'];
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data penjaga $nama_penjaga',NOW());");
				if($log_query){
					header("location: index.php?menu=penjaga&alert=success");
				}
		}else{
			header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
		}
	}else{
		header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
	}
}else{
	header("location: index.php?menu=penjaga&aksi=edit&id_penjaga=$id_penjaga&alert=error");
}
?>