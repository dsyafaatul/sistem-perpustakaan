<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
    $level = $_SESSION['level'];
  if($level!="Admin"){
    ?>
    <script type="text/javascript">
      location='index.php?menu=error404';
    </script>
    <?php
  }else{
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Laporan
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Data Laporan</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="col-md-12">
          <?php
          $alert = $_GET['alert'];
          if(isset($alert)){
            if($alert=='error'){
            ?>
              <div class="alert alert-danger alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-ban"></i>Gagal!
              </div>
            <?php
            }else if($alert=='success'){
            ?>
              <div class="alert alert-success alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i>Berhasil!
              </div>
            <?php
            }
          }
          ?>
      </div>
    <!-- Main content -->
    <section class="invoice">
      <div class="row no-print pull-right">
        <div class="col-xs-12">
          <a href="javascript:void()" class="btn btn-default" onclick="print()"><i class="fa fa-print"></i> Print</a>
          <a href="laporan_pdf.php?laporan=peminjaman&range=<?= $_GET['range'] ?>&status=<?= $_GET['status'] ?>&id_kelas=<?= $_GET['id_kelas'] ?>" class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
          <a href="laporan_excel.php?laporan=peminjaman&range=<?= $_GET['range'] ?>&status=<?= $_GET['status'] ?>&id_kelas=<?= $_GET['id_kelas'] ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
        </div>
      </div>
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <!-- <i class="fa fa-globe"></i> <b>SISTEM</b>Perpustakaan
            <small class="pull-right">Date: <?= (!empty($_GET['range']))?$_GET['range']:date("m/d/Y") ?></small> -->
            <table border="0" width="100%">
              <img src="img/<?= $config['logo'] ?>" alt="" style="width: 70px;height: 70px;position: absolute;left: 120px;top: 25px;">
              <tr>
                  <td align="center" style="width: 100%;padding: 5px;font-size: 20pt;font-weight: bold;">
                  <?= $config['nama'] ?>
                  </td>
              </tr>
              <tr>
                <td align="center" style="padding: 5px;font-size: 11pt;">
                  <?= $config['alamat'] ?>
                </td>
              </tr>
              <tr style="border-bottom: 1px solid black;">
                <td align="center" style="padding: 5px;font-size: 11pt;">
                  <?= $config['keterangan'] ?>
                </td>
              </tr>
              <tr>
                <td align="center" style="padding-top: 15px;font-size: 14pt;font-weight: bold;">LAPORAN PEMINJAMAN</td>
              </tr>
              <tr>
                <td align="center" style="font-size: 11pt;">TANGGAL 
                  <?php
                  if(!empty($_GET['range'])){
                    echo $_GET['range'];
                  }else{  
                    echo strtoupper(date("d/m/Y"));
                  }
                  ?>
                </td>
              </tr>
          </table>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <?php
      if($config['ukuran_laporan']=="A3"){
        $width = "297mm";
        $height = "420mm";
      }else if($config['ukuran_laporan']=="A4"){
        $width = "210mm";
        $height = "297mm";
      }else if($config['ukuran_laporan']=="A4"){
        $width = "148mm";
        $height = "210mm";
      }else if($config['ukuran_laporan']=="Letter"){
        $width = "215.9mm";
        $height = "279.4mm";
      }else if($config['ukuran_laporan']=="Legal"){
        $width = "215.9mm";
        $height = "330mm";
      }
      ?>
      <style>
 table{
  width: 100%;
 }
 table th{
  padding: 5px;
  font-size: 8pt;
 }
 table td{
  padding: 5px;
  font-size: 8pt;
 }
@media print {
  html, body{
    height: <?php echo $height ?>;
    width: <?php echo $width ?>;  }
}
td{
vertical-align:top;
}
body {
  margin : 0 auto;
  font-size: 11pt;
}
</style>
      <?php
      $submenu = $_GET['submenu'];
      if($submenu=="laporan_periode"){
      ?>
        <form action="" method="GET">
          <input type="hidden" name="menu" value="laporan">
          <input type="hidden" name="submenu" value="laporan_periode">
        <div class="form-group no-print">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="range" class="form-control" id="reservation" value="<?= (!empty($_GET['range']))?$_GET['range']:"" ?>" style="width: 200px;margin-right: 10px;">
            <select name="status" id="" class="form-control" style="width: 200px;margin-right: 10px;">
              <option value="">--------- Pilih Status ---------</option>
              <option value="y" <?= ($_GET['status']=="y")?"selected":""; ?>>Sudah kembali</option>
              <option value="n" <?= ($_GET['status']=="n")?"selected":""; ?>>Belum Kembali</option>
            </select>
            <select name="id_kelas" class="form-control" style="width: 200px;margin-right: 10px;">
              <option value="">--------- Pilih Kelas ---------</option>
            <?php
            $data_kelas_query = mysql_query("SELECT * FROM tabel_kelas");
            while($data_kelas = mysql_fetch_array($data_kelas_query)){
            ?>
              <option value="<?= $data_kelas['id_kelas'] ?>" <?= ($_GET['id_kelas']==$data_kelas['id_kelas'])?"selected":""; ?>><?= $data_kelas['tingkat']; ?> <?= $data_kelas['jurusan'];  ?></option>
            <?php
            }
            ?>
            </select>
              <button class="btn btn-primary">
                <i class="fa fa-refresh"></i>
              </button>
          </div>
        </div>
        </form>
        <?php } ?>
        <!-- Table row -->
      <div class="row">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Judul Buku</th>
                    <th>Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Batas waktu</th>
                    <th>Status</th>
                    <th style="width: 10px">Ket</th>
                    <th>denda</th>
                  </tr>
                </thead>
                <?php
                if($submenu=="laporan_periode"){
                $range = $_GET['range'];
                if(!empty($range)){
                ?>
                <tbody>
                  <?php
                  $no = 1;
                  $range = explode("-",trim($_GET['range']));
                  $start = date("Y/m/d",strtotime($range[0]));
                  $end = date("Y/m/d",strtotime($range[1]));
                  $id_kelas = $_GET['id_kelas'];
                  $status = $_GET['status'];
                  if(!empty($id_kelas) AND empty($status)){
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_kelas.id_kelas='$id_kelas' AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                  }else
                  if(empty($id_kelas) AND !empty($status)){
                    $status = ($_GET['status']=='y')?1:0;
                    $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_peminjaman.status='$status' AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                  }else
                  if(empty($id_kelas) AND empty($status)){
                    $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                    }else
                    if(!empty($id_kelas) AND !empty($status)){
                      $status = ($_GET['status']=='y')?1:0;
                      $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_kelas.id_kelas='$id_kelas' AND tabel_peminjaman.status=$status AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                    }
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                    $status = ($data_peminjaman['status_peminjaman']=="0"?"Belum Kembali":"Sudah Kembali");
                    $keterangan = ($data_peminjaman['keterangan']=="0"?"Telat":"-");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
                        <td><?= $data_peminjaman['tanggal_kembali']   ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $status ?></td>
                        <td><?= $keterangan ?></td>
                        <td>Rp.<?= number_format($data_peminjaman['denda']) ?>,-</td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
                <?php
                }
                }else{
                ?>
                <tbody>
                  <?php
                  $no = 1;
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tanggal_pinjam=CURDATE() ORDER BY tanggal_pinjam ASC");
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                    $status = ($data_peminjaman['status_peminjaman']=="0"?"Belum Kembali":"Sudah Kembali");
                    $keterangan = ($data_peminjaman['keterangan']=="0"?"Telat":"-");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
                        <td><?= $data_peminjaman['tanggal_kembali']   ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $status ?></td>
                        <td><?= $keterangan ?></td>
                        <td>Rp.<?= number_format($data_peminjaman['denda']) ?>,-</td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
                <?php
                }
                ?>
              </table>
              <br>
              <br>
              <table border="0">
                <tr>
                  <td align="right" style="padding-right: 80px;">Majalengka, <?= date("d-m-Y") ?></td>
                </tr>
                <tr>
                  <td><br><br><br><br></td>
                </tr>
                <tr>
                  <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; border-bottom: 1px solid black; text-align: center; width: 200px;"></td>
                </tr>
                <tr>
                  <td align="right" style="padding-right: 40px;"><input type="text" style="border: none; text-align: left; width: 200px;" value="NIP. "></td>
                </tr>
              </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php }} ?>