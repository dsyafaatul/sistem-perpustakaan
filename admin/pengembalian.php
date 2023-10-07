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
        Data Pengembalian
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Pengembalian</a></li>
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
        if($aksi=="edit" AND !empty($_GET['id_peminjaman'])){
          $id_peminjaman = (!empty($_GET['id_peminjaman']))?(int)$_GET['id_peminjaman']:"";
          $data_peminjaman = mysql_fetch_array(mysql_query("SELECT * FROM tabel_peminjaman WHERE id_peminjaman=$id_peminjaman"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit peminjaman</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="proses_edit_peminjaman.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" method="POST">
                    <input type="hidden" name="nis" value="<?= $data_peminjaman['nis'] ?>">
                    <div class="form-group">
                  <select class="form-control select2" name="nis" style="width: 100%;" disabled="disabled">
                    <option value="">----- Pilih siswa -----</option>
                  <?php
                  $data_siswa_query = mysql_query("SELECT * FROM tabel_siswa");
                  while($data_siswa = mysql_fetch_array($data_siswa_query)){
                  ?>
                    <option value="<?= $data_siswa['nis'] ?>" <?= ($data_siswa['nis']==$data_peminjaman['nis'])?"selected":""; ?>><?= $data_siswa['nis']." | ".$data_siswa['nama_siswa']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control select2" name="kode_buku" style="width: 100%;">
                    <option value="">----- Pilih Buku -----</option>
                  <?php
                  $data_buku_query = mysql_query("SELECT * FROM tabel_buku");
                  while($data_buku = mysql_fetch_array($data_buku_query)){
                  ?>
                    <option value="<?= $data_buku['kode_buku'] ?>" <?= ($data_buku['kode_buku']==$data_peminjaman['kode_buku'])?"selected":""; ?>><?= $data_buku['kode_buku']." | ".$data_buku['judul_buku']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                    <div class="form-group pull-right">
                      <a href="index.php?menu=siswa&aksi=detail&nis=<?= $data_peminjaman['nis'] ?>" class="btn btn-default">Batal</a>
                      <input type="Reset" value="Reset" class="btn btn-warning" />
                      <input type="submit" name="action" value="Simpan" class="btn btn-success" />
                    </div>
                  </form>
                </div>
                <!-- /.box-body -->
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
              <h3 class="box-title">Semua Peminjaman</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover peminjaman" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Judul Buku</th>
                    <th>Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas waktu</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Ket</th>
                    <th>denda</th>
                    <th style="width: 80px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku ORDER BY tanggal_pinjam DESC");
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                    $status = ($data_peminjaman['status_peminjaman']=="0"?"<i class=\"fa fa-close text-red\"></i>":"<i class=\"fa fa-check text-green\"></i>");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $data_peminjaman['tanggal_kembali'] ?></td>
                        <td><?= $status ?></td>
                        <td align="center">
                          <?php
                            $sekarang_date_time = new DateTime(date("Y-m-d"));
                            $batas_waktu_date_time = new DateTime($data_peminjaman['batas_waktu']);
                            $tanggal_kembali = new DateTime($data_peminjaman['tanggal_kembali']);
                          if($data_peminjaman['status_peminjaman']==0){
                            $selisih = $sekarang_date_time->diff($batas_waktu_date_time)->days;
                            $keterangan = ($data_peminjaman['batas_waktu']<date("Y-m-d")?"<span class=\"label label-danger\">Telat $selisih Hari</span>":"-");
                          }else{
                            $selisih = $tanggal_kembali->diff($batas_waktu_date_time)->days;
                            $keterangan = ($data_peminjaman['batas_waktu']<$data_peminjaman['tanggal_kembali']?"<span class=\"label label-danger\">Telat $selisih Hari</span>":"-");
                          }
                          ?>
                          <?= $keterangan ?>
                          </td>
                        <td>Rp.<?= number_format($data_peminjaman['denda']) ?>,-</td>
                        <td>
                        <a href="?menu=siswa&aksi=detail&nis=<?= $data_peminjaman['nis'] ?>" class="btn btn-info btn-xs" style="width: 23px;">
                          <i class="fa fa-info"></i>
                        </a>
                        <a href="proses_edit_status.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-primary btn-xs" onclick="return confirm('Konfirmasi Pengembalian?')">
                          <i class="fa fa-refresh"></i>
                        </a>
                        <?php
                        if($data_peminjaman['status_peminjaman']=="0" AND $data_peminjaman['batas_waktu']>date("Y-m-d")){
                        ?>
                        <a href="proses_perpanjang_peminjaman.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-success btn-xs" onclick="return confirm('apakah anda yakin ingin memperpanjang peminjaman ini?')">
                          <i class="fa fa-clock-o"></i>
                        </a>
                        <?php } ?>
                        <?php
                        if($data_peminjaman['status_denda']=="0"){
                        ?>
                        <a href="proses_konfirmasi_pembayaran.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-success btn-xs" onclick="return confirm('Konfirmasi Pembayaran?')">
                          <i class="fa fa-money"></i>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php } ?>