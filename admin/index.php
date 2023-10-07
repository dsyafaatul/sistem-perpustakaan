<?php
//created by dsyafaatul
  include("koneksi.php");
  if(empty($_SESSION['username']) OR empty($_SESSION['id_penjaga']) OR empty($_SESSION['level'])){
    $username_cookie = $_COOKIE['username_cookie'];
    if(!empty($username_cookie)){
      if(cekuser($username_cookie)){
        header("Location: lockscreen.php");
      }else{
        header("Location: login.php");
      }
    }else{
      header("Location: login.php");
    }
  }else{
    $action = $_GET['action'];
    $username = $_SESSION['username'];
    $id_penjaga = $_SESSION['id_penjaga'];
    $level = $_SESSION['level'];
    $data_penjaga_query = mysql_query("SELECT * FROM tabel_penjaga WHERE username='$username' AND id_penjaga='$id_penjaga'");
    $data_penjaga = mysql_fetch_array($data_penjaga_query);
    $config = mysql_fetch_array(mysql_query("SELECT * FROM config"));
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<!--
  created by dsyafaatul
  pkl 2018
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEM Perpustakaan | Welcome</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="icon/png" href="img/favicon.png">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Morris.js charts -->
  <script src="bower_components/raphael/raphael.min.js"></script>
  <script src="bower_components/morris.js/morris.min.js"></script>
  <style>
    .pagination>li>a{
      padding: 4px 9px;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="../index.php" class="logo" target="_blank">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SISTEM</b>Perpustakaan</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="#"><i class="fa fa-clock-o"></i> <span id="jam"></span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-calendar"></i> <?= date("d-m-Y") ?></a>
          </li>
            <script>
              function jam(){
              var today = new Date();
              var jam = today.getHours();
              var menit = today.getMinutes();
              var detik = today.getSeconds();
                document.getElementById('jam').innerHTML = jam+":"+menit+":"+detik;
              }
              setInterval("jam()",100);
            </script>
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <?php
            $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.* FROM tabel_peminjaman,tabel_siswa WHERE tabel_peminjaman.status='0' AND batas_waktu<CURDATE() AND tabel_peminjaman.nis=tabel_siswa.nis LIMIT 0,5");
            $jumlah_peminjaman =  mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tabel_peminjaman,tabel_siswa WHERE tabel_peminjaman.status='0' AND batas_waktu<CURDATE() AND tabel_peminjaman.nis=tabel_siswa.nis"));
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?= $jumlah_peminjaman[0] ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?= $jumlah_peminjaman[0] ?> Pemberitahuan</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <?php
                  while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                  ?>
                  <li><!-- start notification -->
                    <a href="index.php?menu=siswa&aksi=detail&nis=<?= $data_peminjaman['nis'] ?>">
                      <i class="fa fa-user fa-lg"></i> <?= $data_peminjaman['nama_siswa'] ?> Melebihi batas waktu peminjaman
                    </a>
                  </li>
                  <?php
                  }
                  ?>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#" data-toggle="modal" data-target="#modal_notif">Lihat Semua</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="img/<?= $data_penjaga['foto_penjaga']  ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= $data_penjaga['nama_penjaga']  ?></span>
            </a>
            <ul class="dropdown-menu" style="border: none;">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/<?= $data_penjaga['foto_penjaga']  ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $data_penjaga['nama_penjaga'] ?>
                </p>
                <p>
                  <?= $data_penjaga['level'] ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?menu=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="proses_logout.php" class="btn btn-default btn-flat" onclick="return confirm('Apakah anda yakin ingin logout?')">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <?php
          if($level==="Admin"){
          ?>
          <li>
            <a href="#" data-toggle="modal" data-target="#modal_pengaturan"><i class="fa fa-gears"></i></a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/<?= $data_penjaga['foto_penjaga']  ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $data_penjaga['nama_penjaga']  ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN</li>
        <!-- Optionally, you can add icons to the links -->
        <li>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
          <li>
            <a href="index.php?menu=peminjaman">
              <i class="fa fa-arrow-circle-right"></i> <span>Peminjaman</span>
            </a>
          </li>
          <li>
            <?php
            $jumlah_peminjaman0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE status='0'"));
            $jumlah_peminjaman1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE status='1'"));
            ?>
            <a href="index.php?menu=pengembalian">
              <i class="fa fa-arrow-circle-left"></i> <span>Pengembalian</span>
              <span class="pull-right-container">
              <?php
              if($jumlah_peminjaman0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_peminjaman0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_peminjaman1 ?></small>
            </span>
            </a>
          </li>
          <?php
        if($level==="Admin"){
        ?>
        <li>
          <?php
                  $saldo = 0;
                  $data_buku_kas_query = mysql_query("SELECT *,tabel_buku_kas.status as status_buku_kas FROM tabel_buku_kas,tabel_penjaga WHERE tabel_buku_kas.id_penjaga=tabel_penjaga.id_penjaga ORDER BY id ASC");
                  $hitung = mysql_num_rows($data_buku_kas_query);
                  $total = 0;
                  $no = 1;
                    while($data_buku_kas = mysql_fetch_array($data_buku_kas_query)){
                      if($data_buku_kas['status_buku_kas']==0){
                        if($hitung>1){
                          $saldo = $saldo-$data_buku_kas['uang'];
                        }else{
                          $saldo = $data_buku_kas['uang'];
                        }
                      }else{
                        $saldo = $saldo+$data_buku_kas['uang'];
                      }
                      ?>
                      <?php
                      $no++;
                      $total += $saldo;
                    }
                    ?>
          <a href="index.php?menu=buku_kas">
            <i class="fa fa-money"></i> <span>Buku Kas</span>
            <span class="pull-right-container">
              <?php
              if($saldo>0){
              ?>
              <small class="label pull-right bg-blue">Rp.<?= number_format($saldo) ?>,-</small>
              <?php } ?>
            </span>
          </a>
        </li>
        <?php } ?>
        <li class="header">DATA MASTER</li>
        <?php
            $jumlah_siswa0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_siswa WHERE status='0'"));
            $jumlah_siswa1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_siswa WHERE status='1'"));
            ?>
       <li>
          <a href="index.php?menu=siswa">
            <i class="fa fa-users"></i> <span>Data Siswa</span>
            <span class="pull-right-container">
              <?php
              if($jumlah_siswa0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_siswa0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_siswa1 ?></small>
            </span>
          </a>
        </li>
        <?php
            $jumlah_buku0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_buku WHERE status='0'"));
            $jumlah_buku1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_buku WHERE status='1'"));
            ?>
        <li>
          <a href="index.php?menu=buku">
            <i class="fa fa-book"></i> <span>Data Buku</span>
            <span class="pull-right-container">
              <?php
              if($jumlah_buku0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_buku0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_buku1 ?></small>
            </span>
          </a>
        </li>
        <?php
        if($level==="Admin"){
        ?>
        <?php
            $jumlah_penjaga0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_penjaga WHERE status='0'"));
            $jumlah_penjaga1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_penjaga WHERE status='1'"));
            ?>
        <li>
          <a href="index.php?menu=penjaga">
            <i class="fa fa-user-circle"></i> <span>Data Penjaga</span>
            <span class="pull-right-container">
              <?php
              if($jumlah_penjaga0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_penjaga0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_penjaga1 ?></small>
            </span>
          </a>
        </li>
        <?php } ?>
        <?php
            $jumlah_kelas0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_kelas WHERE status='0'"));
            $jumlah_kelas1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_kelas WHERE status='1'"));
            ?>
        <li>
          <a href="index.php?menu=kelas">
            <i class="fa fa-flag"></i> <span>Data Kelas</span>
            <span class="pull-right-container">
              <?php
              if($jumlah_kelas0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_kelas0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_kelas1 ?></small>
            </span>
          </a>
        </li>
        <?php
            $jumlah_kategori0 = mysql_num_rows(mysql_query("SELECT * FROM tabel_kategori WHERE status='0'"));
            $jumlah_kategori1 = mysql_num_rows(mysql_query("SELECT * FROM tabel_kategori WHERE status='1'"));
            ?>
        <li>
          <a href="index.php?menu=kategori_buku">
            <i class="fa fa-tags"></i> <span>Data Kategori Buku</span>
            <span class="pull-right-container">
              <?php
              if($jumlah_kategori0>0){
              ?>
              <small class="label pull-right bg-red"><?= $jumlah_kategori0 ?></small>
              <?php } ?>
              <small class="label pull-right bg-green"><?= $jumlah_kategori1 ?></small>
            </span>
          </a>
        </li>
        <?php
        if($level==="Admin"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i> <span>Laporan Peminjaman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?menu=laporan&submenu=laporan_realtime"><i class="fa fa-circle-o"></i>Laporan Realtime</a></li>
            <li><a href="index.php?menu=laporan&submenu=laporan_periode"><i class="fa fa-circle-o"></i>Laporan Perperiode</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <?php include("menu.php") ?>

  <!-- Main Footer -->
  <footer class="main-footer no-print">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#"><?= $config['nama'] ?></a>.</strong> All rights reserved.
    <strong class="pull-right">Powered by<a href="http://facebook.com/dsyafaatul"> dsyafaatul</a></strong>
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<?php
$data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.* FROM tabel_peminjaman,tabel_siswa WHERE tabel_peminjaman.status='0' AND batas_waktu<CURDATE() AND tabel_peminjaman.nis=tabel_siswa.nis ORDER BY tabel_peminjaman.tanggal_pinjam");
$jumlah_peminjaman = mysql_num_rows($data_peminjaman_query);
?>
<div class="modal fade" id="modal_notif">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?= $jumlah_peminjaman ?> Pemberitahuan</h4>
    </div>
    <div class="modal-body">
      <ul class="nav navbar-pills navbar-stacked">
      <?php
      while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
      ?>
      <li><!-- start notification -->
        <a href="index.php?menu=siswa&aksi=detail&nis=<?= $data_peminjaman['nis'] ?>" class="text-black">
          <i class="fa fa-user fa-lg"></i> <?= $data_peminjaman['nama_siswa'] ?> Melebihi batas waktu peminjaman
        </a>
      </li>
      <?php
      }
      ?>
      <!-- end notification -->
    </ul>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal_pengaturan">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Pengaturan Perpustakaan</h4>
    </div>
    <form enctype="multipart/form-data" action="proses_edit_config.php" method="POST">
    <div class="modal-body">
      <div class="form-group">
        <label for="nama">Nama Sekolah</label>
        <input type="text" name="nama" value="<?= $config['nama'] ?>" id="nama" class="form-control" required="required">
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" class="form-control" rows="3" id="alamat" style="max-width: 100%;" required="required"><?= $config['alamat'] ?></textarea>
      </div>
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" name="keterangan" value="<?= $config['keterangan'] ?>" id="keterangan" class="form-control" required="required">
      </div>
      <div class="form-group">
        <label for="logo">Logo</label>
        <div class="input-group">
          <div class="input-group-addon" style="width: 50px;height: 50px;padding: 5px;">
            <img src="img/<?= $config['logo'] ?>" alt="" style="height: 35px;width: 35px;">
          </div>
        <input type="file" name="logo" class="form-control" id="logo" style="height: 50px;padding: 15px;">
        </div>
      </div>
      <div class="form-group">
        <label for="denda">Denda Perhari</label>
        <div class="input-group">
          <div class="input-group-addon">
            Rp.
          </div>
        <input type="text" name="denda" value="<?= $config['denda'] ?>" id="denda" class="form-control" required="required">
        <div class="input-group-addon">
            / Hari
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="jumlah_pinjam_maksimal">Jumlah Pinjam Maksimal</label>
        <div class="input-group">
        <input type="text" name="jumlah_pinjam_maksimal" value="<?= $config['jumlah_pinjam_maksimal'] ?>" id="jumlah_pinjam_maksimal" class="form-control" required="required">
          <div class="input-group-addon">
            Kali
          </div>
      </div>
      </div>
      <div class="form-group">
        <label for="lama">Lama pinjam Maksimal</label>
        <div class="input-group">
        <input type="text" name="lama_pinjam_maksimal" value="<?= $config['lama_pinjam_maksimal'] ?>" id="lama_pinjam_maksimal" class="form-control" required="required">
          <div class="input-group-addon">
            Hari
          </div>
      </div>
      </div>
      <div class="form-group">
        <label for="ukuran_laporan">Ukuran Kertas Laporan</label>
        <select class="form-control" name="ukuran_laporan" id="ukuran_laporan" required="required">
          <option value="">----- Pilih Ukuran Kertas Laporan -----</option>
          <option value="A3" <?= ($config['ukuran_laporan']=="A3")?"selected":""; ?>>A3</option>
          <option value="A4" <?= ($config['ukuran_laporan']=="A4")?"selected":""; ?>>A4</option>
          <option value="A5" <?= ($config['ukuran_laporan']=="A5")?"selected":""; ?>>A5</option>
          <option value="Letter" <?= ($config['ukuran_laporan']=="Letter")?"selected":""; ?>>Letter</option>
          <option value="Legal" <?= ($config['ukuran_laporan']=="Legal")?"selected":""; ?>>Legal</option>
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <input type="button" value="Batal" class="btn btn-default" data-dismiss="modal" />
      <input type="Reset" value="Reset" class="btn btn-warning" />
      <input type="submit" name="action" value="Simpan" class="btn btn-success" />
    </div>
  </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables-responsive/dataTables.responsive.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    <?php
    $url = "?";
    $key = count($_GET);
    $i = 0;
    foreach ($_GET as $key => $value) {
      if($key=="menu" OR $key=="submenu"){
        if($i==0){
          $url .= "".$key."=".$value;
        }else{
          $url .= "&".$key."=".$value;
        }
      } 
      $i++;
    }
    if(!empty($_GET['menu'])){
    ?>
    $(".sidebar-menu [href='index.php<?= $url ?>']").unwrap().wrap("<li class=active></li>");
    $("[href='index.php<?= $url ?>']").parent().parent().parent().addClass("active");
    <?php
    }else{
    ?>
    $(".sidebar-menu [href='index.php']").unwrap().wrap("<li class=active></li>");
    <?php
    }
    ?>
    // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

    $('.select2').select2();

    $('#tahun').inputmask('y', { 'placeholder': '1999' });
    $('[data-mask]').inputmask();

    $('#reservation').daterangepicker();

    $( "#spinner" ).spinner();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  $('.alert').slideDown(1000).delay(1000).slideUp(1000);
  $('.datatables-full').DataTable({
      'responsive'  : true,
  });
  $('.kas').DataTable({
      'responsive'  : true,
      'order'       : [[0,'asc']],
  });
  $('.log').DataTable({
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
  });
  $('.datatables-min').DataTable({
      'responsive'  : true,
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
  });
  $('.peminjaman').DataTable({
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
  });
  $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );
})
</script>
</body>
</html>
<?php } ?>