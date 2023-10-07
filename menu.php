<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<?php
$menu = $_GET['menu'];
switch ($menu) {
	case 'error404':
		include("error404.php");
		break;
	case 'peminjaman':
		include("peminjaman.php");
		break;
	default:
		include("home.php");
		break;
}
?>
<?php } ?>