<?php
//created by dsyafaatul
include("koneksi.php");
$id_penjaga = $_SESSION['id_penjaga'];
$nis_get = $_GET['nis'];
$nis = (is_numeric($_POST['nis']))?$_POST['nis']:header("location: index.php?menu=siswa&aksi=edit&nis=$nis&alert=error");
$nama_siswa = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telepon = (is_numeric($_POST['no_telepon']))?$_POST['no_telepon']:header("location: index.php?menu=siswa&aksi=edit&nis=$nis&alert=error");
$alamat = $_POST['alamat'];
$action = $_POST['action'];
if(!empty($action)){
	if(!empty($nis) AND !empty($nama_siswa) AND !empty($id_kelas) AND !empty($jenis_kelamin) AND !empty($no_telepon) AND !empty($alamat) AND !empty($nis)){
		$edit_siswa_query = mysql_query("UPDATE tabel_siswa SET nis='$nis',nama_siswa='$nama_siswa',id_kelas='$id_kelas',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon', alamat='$alamat' WHERE nis=$nis_get");
		if($edit_siswa_query){
			$log_query = mysql_query("INSERT INTO log VALUES('','$id_penjaga','Mengedit Data Anggota $nama_siswa',NOW());");
				if($log_query){
					header("location: index.php?menu=siswa&alert=success");
				}
		}else{
			header("location: index.php?menu=siswa&aksi=edit&nis=$nis&alert=error");
		}
	}else{
		header("location: index.php?menu=siswa&aksi=edit&nis=$nis&alert=error");
	}
}else{
	header("location: index.php?menu=siswa&aksi=edit&nis=$nis&alert=error");
}
?>