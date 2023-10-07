<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Peminjaman
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Peminjaman</a></li>
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
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">
                Peminjaman Buku
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <form action="" method="get">
                  <input type="hidden" name="menu" value="peminjaman">
                  <div class="form-group">
                    <div class="input-group">
                    <select class="form-control select2" name="nis" style="width: 100%;" onchange="submit()">
                      <option value="">----- Pilih siswa -----</option>
                    <?php
                    $nis = $_GET['nis'];
                    $data_siswa_query = mysql_query("SELECT * FROM tabel_siswa WHERE status='1'");
                    while($data_siswa = mysql_fetch_array($data_siswa_query)){
                    ?>
                      <option value="<?= $data_siswa['nis'] ?>" <?= ($nis==$data_siswa['nis'])?"selected":"" ?>><?= $data_siswa['nis']." | ".$data_siswa['nama_siswa']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    </div>
                  </div>
                  </form>
                <?php
                $nis = $_GET['nis'];
                if(!empty($nis)){
                  ?>
                  <form action="proses_tambah_peminjaman.php" method="POST" name="getBuku">
                    <input type="hidden" name="nis" value="<?= $nis ?>">
                  <div class="form-group">
                  <div class="input-group">
                  <select class="form-control select2" name="kode_buku" style="width: 100%;">
                    <option value="">----- Pilih Buku -----</option>
                  <?php
                  $data_buku_query = mysql_query("SELECT * FROM tabel_buku WHERE status='1'");
                  while($data_buku = mysql_fetch_array($data_buku_query)){
                  ?>
                    <option value="<?= $data_buku['kode_buku'] ?>"><?= $data_buku['kode_buku']." | ".$data_buku['judul_buku']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                  <span class="input-group-addon">
                    <i class="fa fa-book"></i>
                  </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Nama Penjaga</label>
                  <input type="text" name="sekarang" value="<?= $data_penjaga['nama_penjaga'] ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <label for="">Tanggal Pinjam</label>
                  <input type="text" name="sekarang" value="<?= date("Y-m-d") ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                  <label for="">Batas Waktu</label>
                  <input type="text" name="sekarang" value="<?= date("Y-m-d",strtotime("+$config[lama_pinjam_maksimal] days")); ?>" class="form-control" disabled>
                </div>
                <div class="box-footer">
                  <a href="index.php?menu=peminjaman" class="btn btn-default">Batal</a>
                  <input type="submit" name="action" value="Simpan" class="btn btn-success" />
                </div>
                </form>
                  <?php
                }
                ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php } ?>