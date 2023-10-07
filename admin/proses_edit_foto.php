<?php
//created by dsyafaatul
include("koneksi.php");
$nama_foto = date(YmdHis)."_".$_FILES['foto']['name'];
$type_foto = $_FILES['foto']['type'];
$size_foto = $_FILES['foto']['size'];
$max_size= 1000000;
$type = array("image/jpg","image/jpeg","image/png");
$id_penjaga = $_SESSION['id_penjaga'];
$action = $_POST['action'];
	if(!empty($action)){
		if(!empty($type_foto)){
			$foto_kasir = mysql_result(mysql_query("SELECT foto_penjaga FROM tabel_penjaga WHERE id_penjaga=$id_penjaga"),0);
			if($size_foto<=$max_size){
				if(in_array($type_foto, $type)){
						move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$nama_foto);
						$ganti_foto_query = mysql_query("UPDATE tabel_penjaga SET foto_penjaga='$nama_foto' WHERE id_penjaga='$id_penjaga'");
					if($ganti_foto_query){
						$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengubah Foto Profile',NOW());");
						if($log_query){
							header("location: index.php?menu=profile&alert=success");
						}
					}else{
						header("location: index.php?menu=profile&alert=error");
					}
				}else{
					header("location: index.php?menu=profile&alert=error");
				}
			}else{
				header("location: index.php?menu=profile&alert=error");
			}
		}else{
			header("location: index.php?menu=profile&alert=error");
		}
	}else{
		header("location: index.php?menu=profile&alert=error");
	}
?>