<?php
//created by dsyafaatul
include("koneksi.php");
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$alamat = $_POST['alamat'];
$denda = (is_numeric($_POST['denda']))?$_POST['denda']:header("location: index.php?alert=error");
$jumlah_pinjam_maksimal = (is_numeric($_POST['jumlah_pinjam_maksimal']))?$_POST['jumlah_pinjam_maksimal']:header("location: index.php?alert=error");
$lama_pinjam_maksimal = (is_numeric($_POST['lama_pinjam_maksimal']))?$_POST['lama_pinjam_maksimal']:header("location: index.php?alert=error");
$ukuran_laporan = $_POST['ukuran_laporan'];
$nama_foto = date(YmdHis)."_".$_FILES['logo']['name'];
$type_foto = $_FILES['logo']['type'];
$size_foto = $_FILES['logo']['size'];
$max_size= 1000000;
$type = array("image/jpg","image/jpeg","image/png");
$id_penjaga = $_SESSION['id_penjaga'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nama) AND !empty($denda) AND !empty($jumlah_pinjam_maksimal) AND !empty($keterangan) AND !empty($alamat) AND !empty($lama_pinjam_maksimal) AND !empty($ukuran_laporan)){
		if(!empty($type_foto)){
			if($size_foto<=$max_size){
				if(in_array($type_foto, $type)){
					move_uploaded_file($_FILES['logo']['tmp_name'], "img/".$nama_foto);
					$edit_config = mysql_query("UPDATE config SET nama='$nama',denda='$denda',jumlah_pinjam_maksimal='$jumlah_pinjam_maksimal',keterangan='$keterangan',alamat='$alamat',lama_pinjam_maksimal='$lama_pinjam_maksimal',ukuran_laporan='$ukuran_laporan',logo='$nama_foto'");
					}else{
						header("location: index.php?alert=error");
					}
				}else{
					header("location: index.php?alert=error");
				}
		}else{
			$edit_config = mysql_query("UPDATE config SET nama='$nama',denda='$denda',jumlah_pinjam_maksimal='$jumlah_pinjam_maksimal',keterangan='$keterangan',alamat='$alamat',lama_pinjam_maksimal='$lama_pinjam_maksimal',ukuran_laporan='$ukuran_laporan'");
		}
		if($edit_config){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Pengaturan Perpustakaan',NOW());");
				if($log_query){
					header("location: index.php?alert=success");
				}
		}else{
			header("location: index.php?alert=error");
		}
	}else{
		header("location: index.php?alert=error");
	}
}else{
	header("location: index.php?alert=error");
}
?>