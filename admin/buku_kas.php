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
        Buku Kas
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Buku Kas</a></li>
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
      <?php
      $aksi = $_GET['aksi'];
      if(!empty($aksi)){
        if($aksi=="edit" AND !empty($_GET['id'])){
          $id = (!empty($_GET['id']))?(int)$_GET['id']:"";
          $data_buku_kas = mysql_fetch_array(mysql_query("SELECT * FROM tabel_buku_kas WHERE id=$id"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Catatan Buku Kas</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form action="proses_edit_buku_kas.php?id=<?= $data_buku_kas['id'] ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                <input type="text" name="nama_penjaga" value="<?= $data_penjaga['nama_penjaga'] ?>" placeholder="Nama Penjaga" class="form-control" required="required" disabled>
              </div>
              <div class="form-group">
                <select class="form-control" name="status" style="width: 100%;" required="required">
                    <option value="1" <?= ($data_buku_kas['status']==1)?"selected":"" ?>>Masuk</option>
                    <option value="0" <?= ($data_buku_kas['status']==0)?"selected":"" ?>>Keluar</option>
                </select>
              </div>
              <div class="form-group">
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan" required="required"><?= $data_buku_kas['keterangan'] ?></textarea>
              </div>
              <div class="form-group">
                <input type="text" name="uang" value="<?= $data_buku_kas['uang'] ?>" placeholder="Jumlah Uang" class="form-control" required="required">
              </div>
              <div class="form-group">
                <input type="text" name="tanggal" value="<?= $data_buku_kas['tanggal'] ?>" placeholder="Tanggal" class="form-control" disabled="disabled">
              </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-right">
                      <a href="index.php?menu=buku_kas" class="btn btn-default">Batal</a>
                      <input type="Reset" value="Reset" class="btn btn-warning" />
                      <input type="submit" name="action" value="Simpan" class="btn btn-success" />
                  </div>
                </div>
                </form>
              </div>
              <!-- /.box -->
            </div>
          <?php
        }
      }
      ?>
      <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                  <i class="fa fa-plus"></i> Tambah
                </a>
                <a href="laporan_pdf.php?laporan=buku_kas" class="btn btn-warning" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="laporan_excel.php?laporan=buku_kas" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover kas" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Penjaga</th>
                    <th>Keterangan</th>
                    <th style="width: 10px">Masuk</th>
                    <th style="width: 10px">Keluar</th>
                    <th style="width: 80px">Tanggal</th>
                    <th style="width: 10px">Saldo</th>
                    <th style="width: 50px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $saldo = 0;
                  $data_buku_kas_query = mysql_query("SELECT *,tabel_buku_kas.status as status_buku_kas FROM tabel_buku_kas,tabel_penjaga WHERE tabel_buku_kas.id_penjaga=tabel_penjaga.id_penjaga ORDER BY id ASC");
                  $hitung = mysql_num_rows($data_buku_kas_query);
                  $no = $hitung;
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
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_buku_kas['nama_penjaga'] ?></td>
                        <td><?= $data_buku_kas['keterangan'] ?></td>
                        <td align="center"><?= ($data_buku_kas['status_buku_kas']==1)?"Rp.".number_format($data_buku_kas['uang'])."-,":"-" ?></td>
                        <td align="center"><?= ($data_buku_kas['status_buku_kas']==0)?"Rp.".number_format($data_buku_kas['uang'])."-,":"-" ?></td>
                        <td><?= $data_buku_kas['tanggal'] ?></td>
                        <td align="center">Rp.<?= number_format($saldo) ?>,-</td>
                        <td>
                        <a href="?menu=buku_kas&aksi=edit&id=<?= $data_buku_kas['id'] ?>" class="btn btn-warning btn-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="proses_hapus_buku_kas.php?id=<?= $data_buku_kas['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                      </tr>
                      <?php
                      $no--;
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Catatan Buku Kas</h4>
            </div>
            <form action="proses_tambah_buku_kas.php" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="nama_penjaga" value="<?= $data_penjaga['nama_penjaga'] ?>" placeholder="Nama Penjaga" class="form-control" required="required" disabled>
              </div>
              <div class="form-group">
                <select class="form-control" name="status" style="width: 100%;" required="required">
                    <option value="1">Masuk</option>
                    <option value="0">Keluar</option>
                </select>
              </div>
              <div class="form-group">
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan" required="required"></textarea>
              </div>
              <div class="form-group">
                <input type="text" name="uang" value="" placeholder="Jumlah Uang" class="form-control" required="required">
              </div>
              <div class="form-group">
                <input type="text" name="tanggal" value="<?= date("Y-m-d") ?>" placeholder="Tanggal" class="form-control" disabled="disabled">
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php }} ?>