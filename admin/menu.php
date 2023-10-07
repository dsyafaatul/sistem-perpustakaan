<?php
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<?php
//created by dsyafaatul
$menu = $_GET['menu'];
switch ($menu) {
	case 'peminjaman':
		include("peminjaman.php");
		break;
	case 'pengembalian':
		include("pengembalian.php");
		break;
	case 'siswa':
		include("siswa.php");
		break;
	case 'buku':
		include("buku.php");
		break;
	case 'buku_kas':
		include("buku_kas.php");
		break;
	case 'penjaga':
		include("penjaga.php");
		break;
	case 'kategori_buku':
		include("kategori_buku.php");
		break;
	case 'kelas':
		include("kelas.php");
		break;
	case 'laporan':
		include("laporan.php");
		break;
	case 'profile':
		include("profile.php");
		break;
	case 'error404':
		include("error404.php");
		break;
	default:
		include("home.php");
		break;
}
?>
<?php } ?>