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
        Data Buku
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Data Buku</a></li>

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
        if($aksi=="edit" AND !empty($_GET['kode_buku'])){
          $kode_buku = (!empty($_GET['kode_buku']))?$_GET['kode_buku']:"";
          $data_buku = mysql_fetch_array(mysql_query("SELECT * FROM tabel_buku WHERE kode_buku='$kode_buku'"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Buku</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form action="proses_edit_buku.php?kode_buku=<?= $kode_buku ?>" method="POST">
                <div class="box-body">
                <div class="form-group">
                  <input type="text" name="judul_buku" value="<?= $data_buku['judul_buku'] ?>" placeholder="Judul Buku" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <select class="form-control select2" name="id_kategori" style="width: 100%;" required="required">
                    <option value="">----- Pilih Kategori -----</option>
                  <?php
                  $data_kategori_query = mysql_query("SELECT * FROM tabel_kategori WHERE status='1'");
                  while($data_kategori = mysql_fetch_array($data_kategori_query)){
                  ?>
                    <option value="<?= $data_kategori['id_kategori'] ?>" <?= ($data_buku['id_kategori']==$data_kategori['id_kategori'])?"selected":"" ?>><?= $data_kategori['nama_kategori']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="pengarang" value="<?= $data_buku['pengarang'] ?>" placeholder="Pengarang" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="penerbit" value="<?= $data_buku['penerbit'] ?>" placeholder="Penerbit" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="tahun_terbit" value="<?= $data_buku['tahun_terbit'] ?>" placeholder="Tahun Terbit" class="form-control" id="tahun" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="stok" value="<?= $data_buku['stok'] ?>" placeholder="Stok" class="form-control" required="required">
                </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-right">
                      <a href="index.php?menu=buku" class="btn btn-default">Batal</a>
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
                <a href="laporan_pdf.php?laporan=buku" class="btn btn-warning" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="laporan_excel.php?laporan=buku" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-full" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th style="width: 5px;">Stok</th>
                    <th>Dipinjam</th>
                    <th>Tanggal Masuk</th>
                    <th style="width: 10px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_buku_query = mysql_query("SELECT tabel_buku.*,tabel_kategori.*,tabel_buku.status as status_buku FROM tabel_buku,tabel_kategori WHERE tabel_buku.id_kategori=tabel_kategori.id_kategori ORDER BY tabel_buku.judul_buku");
                    while($data_buku = mysql_fetch_array($data_buku_query)){
                      $sisa = $data_buku['stok']-(mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'")));
                      $dipinjam = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'"));
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_buku['kode_buku'] ?></td>
                        <td><?= $data_buku['judul_buku'] ?></td>
                        <td><?= $data_buku['pengarang'] ?></td>
                        <td><?= $data_buku['penerbit'] ?></td>
                        <td><?= $data_buku['tahun_terbit'] ?></td>
                        <td><?= $data_buku['nama_kategori'] ?></td>
                        <td><?= $sisa ?></td>
                        <td><?= $dipinjam ?></td>
                        <td><?= $data_buku['tanggal_masuk'] ?></td>
                        <td>
                          <a href="?menu=buku&aksi=edit&kode_buku=<?= $data_buku['kode_buku'] ?>" class="btn btn-warning btn-xs">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <?php
                        if($data_buku['status_buku']==1){
                        ?>
                        <a href="proses_edit_status_buku.php?kode_buku=<?= $data_buku['kode_buku'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin mengnonaktifkan?')">
                          <i class="fa fa-lock"></i>
                        </a>
                        <?php }else{ ?>
                        <a href="proses_edit_status_buku.php?kode_buku=<?= $data_buku['kode_buku'] ?>" class="btn btn-success btn-xs" onclick="return confirm('apakah anda yakin ingin mengaktifkan?')">
                          <i class="fa fa-unlock"></i>
                        </a>
                        <?php } ?>
                        <?php
                        $level = $_SESSION['level'];
                        if($level=="Admin"){
                        ?>
                        <a href="proses_hapus_buku.php?kode_buku=<?= $data_buku['kode_buku'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php } ?>
                      </td>
                      </tr>
                      <?php
                      $no++;
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
              <h4 class="modal-title">Tambah Buku</h4>
            </div>
            <form action="proses_tambah_buku.php" method="POST">
            <div class="modal-body">
              <div class="form-group">
                  <input type="text" name="kode_buku" value="<?= "B0".rand(100,999) ?>" placeholder="Judul Buku" class="form-control" maxlength="5" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="judul_buku" value="" placeholder="Judul Buku" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <select class="form-control select2" name="id_kategori" style="width: 100%;" required="required">
                    <option value="">----- Pilih Kategori -----</option>
                  <?php
                  $data_kategori_query = mysql_query("SELECT * FROM tabel_kategori WHERE status='1'");
                  while($data_kategori = mysql_fetch_array($data_kategori_query)){
                  ?>
                    <option value="<?= $data_kategori['id_kategori'] ?>"><?= $data_kategori['nama_kategori']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="pengarang" value="" placeholder="Pengarang" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="penerbit" value="" placeholder="Penerbit" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="tahun_terbit" value="" placeholder="Tahun Terbit" class="form-control" id="tahun" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="stok" value="" placeholder="Stok" class="form-control" required="required">
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
  <?php }  ?>