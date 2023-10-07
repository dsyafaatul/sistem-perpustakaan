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
        Data Siswa
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Data Siswa</a></li>
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
        if($aksi=="edit" AND !empty($_GET['nis'])){
          $nis = (!empty($_GET['nis']))?(int)$_GET['nis']:"";
          $data_siswa = mysql_fetch_array(mysql_query("SELECT * FROM tabel_siswa WHERE nis=$nis"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Siswa</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form action="proses_edit_siswa.php?nis=<?= $data_siswa['nis'] ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                      <input type="text" name="nis" value="<?= $data_siswa['nis'] ?>" placeholder="Nis" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" name="nama_siswa" value="<?= $data_siswa['nama_siswa'] ?>" placeholder="Nama Lengkap" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <select name="id_kelas" class="form-control" required="required">
                        <option value="">----- Pilih Kelas -----</option>
                      <?php
                      $data_kelas_query = mysql_query("SELECT * FROM tabel_kelas");
                      while($data_kelas = mysql_fetch_array($data_kelas_query)){
                      ?>
                        <option value="<?= $data_kelas['id_kelas'] ?>" <?= ($data_siswa['id_kelas']==$data_kelas['id_kelas'])?"selected":""; ?>><?= $data_kelas['tingkat']; ?> <?= $data_kelas['jurusan'];  ?></option>
                      <?php
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="jenis_kelamin" value="L" class="minimal" <?= ($data_siswa['jenis_kelamin']=="L")?"checked":""; ?> required="required">
                         Laki-Laki
                        <input type="radio" name="jenis_kelamin" value="P" class="minimal" <?= ($data_siswa['jenis_kelamin']=="P")?"checked":""; ?> required="required">
                         Perempuan
                    </div>
                     <div class="form-group">
                      <input type="text" name="no_telepon" value="<?= $data_siswa['no_telepon'] ?>" placeholder="No Telepon" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"><?= $data_siswa['alamat'] ?></textarea>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-right">
                      <a href="index.php?menu=siswa" class="btn btn-default">Batal</a>
                      <input type="Reset" value="Reset" class="btn btn-warning" />
                      <input type="submit" name="action" value="Simpan" class="btn btn-success" />
                  </div>
                </div>
                </form>
              </div>
              <!-- /.box -->
            </div>
          <?php
        }else if($aksi=="detail" AND !empty($_GET['nis'])){
          $nis = (!empty($_GET['nis']))?(int)$_GET['nis']:"";
          $data_peminjaman = mysql_fetch_array(mysql_query("SELECT COUNT(*) as peminjaman,(SELECT COUNT(*) FROM tabel_peminjaman WHERE nis=$nis AND ((batas_waktu<CURDATE() AND status='0')OR (keterangan='0'))) as telat FROM tabel_peminjaman WHERE nis=$nis"));
          $data_siswa = mysql_fetch_array(mysql_query("SELECT tabel_siswa.*,tabel_kelas.* FROM tabel_siswa,tabel_kelas WHERE tabel_siswa.id_kelas=tabel_kelas.id_kelas AND nis=$nis"));
          $jenis_kelamin = ($data_siswa['jenis_kelamin']=="L"?"Laki-Laki":"Perempuan");
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Siswa</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="col-md-12">
                    <table class="table table-bordered table-hover" width="100%">
                      <tr>
                        <td>ID</td>
                        <td>:</td>
                        <td><?= $data_siswa['id_siswa'] ?></td>
                      </tr>
                      <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td><?= $data_siswa['nis'] ?></td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $data_siswa['nama_siswa'] ?></td>
                      </tr>
                      <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?= $data_siswa['tingkat']." ".$data_siswa['jurusan'] ?></td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $jenis_kelamin ?></td>
                      </tr>
                      <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <td><?= $data_siswa['no_telepon'] ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $data_siswa['alamat'] ?></td>
                      </tr>
                      <tr>
                        <td>Peminjaman</td>
                        <td>:</td>
                        <td><?= $data_peminjaman['peminjaman'] ?> Kali</td>
                      </tr>
                      <tr>
                        <td>Telat</td>
                        <td>:</td>
                        <td><?= $data_peminjaman['telat'] ?> Kali</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover datatables-full" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Judul Buku</th>
                    <th>Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas waktu</th>
                    <th>Tanggal Kembali</th>
                    <th></th>
                    <th style="width: 10px">Ket</th>
                    <th>denda</th>
                    <th style="width: 80px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_peminjaman.nis='$data_siswa[nis]' ORDER BY tanggal_pinjam DESC");
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
                        <a href="?menu=pengembalian&aksi=edit&id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-warning btn-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="proses_hapus_peminjaman.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
                          <i class="fa fa-trash"></i>
                        </a>
                        <a href="proses_edit_status.php?id_peminjaman=<?= $data_peminjaman['id_peminjaman'] ?>" class="btn btn-primary btn-xs" onclick="return confirm('Konfirmasi Pengembalian?')">
                          <i class="fa fa-refresh"></i>
                        </a>
                      </td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="form-group pull-right">
                    <a href="index.php?menu=siswa" class="btn btn-default">Kembali</a>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          <?php
        }
      }else{
      ?>
      <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                  <i class="fa fa-plus"></i> Tambah
                </a>
                <a href="laporan_pdf.php?laporan=siswa" class="btn btn-warning" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="laporan_excel.php?laporan=siswa" class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
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
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th style="width: 60px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_siswa_query = mysql_query("SELECT tabel_siswa.*,tabel_kelas.*,tabel_siswa.status as status_siswa FROM tabel_siswa,tabel_kelas WHERE tabel_siswa.id_kelas=tabel_kelas.id_kelas ORDER BY nama_siswa");
                    while($data_siswa = mysql_fetch_array($data_siswa_query)){
                    $jenis_kelamin = ($data_siswa['jenis_kelamin']=="L"?"Laki-Laki":"Perempuan");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_siswa['nis'] ?></td>
                        <td><?= $data_siswa['nama_siswa'] ?></td>
                        <td><?= $data_siswa['tingkat']." ".$data_siswa['jurusan'] ?></td>
                        <td><?= $jenis_kelamin ?></td>
                        <td><?= $data_siswa['no_telepon'] ?></td>
                        <td><?= $data_siswa['alamat'] ?></td>
                        <td>
                        <a href="?menu=siswa&aksi=edit&nis=<?= $data_siswa['nis'] ?>" class="btn btn-warning btn-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <?php
                        if($data_siswa['status_siswa']==1){
                        ?>
                        <a href="proses_edit_status_siswa.php?nis=<?= $data_siswa['nis'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin mengnonaktifkan?')">
                          <i class="fa fa-lock"></i>
                        </a>
                        <?php }else{ ?>
                        <a href="proses_edit_status_siswa.php?nis=<?= $data_siswa['nis'] ?>" class="btn btn-success btn-xs" onclick="return confirm('apakah anda yakin ingin mengaktifkan?')">
                          <i class="fa fa-unlock"></i>
                        </a>
                        <?php } ?>
                        <?php
                        $level = $_SESSION['level'];
                        if($level=="Admin"){
                        ?>
                        <a href="proses_hapus_siswa.php?nis=<?= $data_siswa['nis'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php } ?>
                        <a href="?menu=siswa&aksi=detail&nis=<?= $data_siswa['nis'] ?>" class="btn btn-info btn-xs" style="width: 23px;">
                          <i class="fa fa-info"></i>
                        </a>
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
        <?php } ?>
                <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Siswa</h4>
            </div>
            <form action="proses_tambah_siswa.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="nis" value="" placeholder="Nis" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="nama_siswa" value="" placeholder="Nama Lengkap" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <select class="form-control select2" name="id_kelas" style="width: 100%;" required="required">
                    <option value="">----- Pilih Kelas -----</option>
                  <?php
                  $data_kelas_query = mysql_query("SELECT * FROM tabel_kelas WHERE status='1'");
                  while($data_kelas = mysql_fetch_array($data_kelas_query)){
                  ?>
                    <option value="<?= $data_kelas['id_kelas'] ?>"><?= $data_kelas['tingkat']; ?> <?= $data_kelas['jurusan']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                    <input type="radio" name="jenis_kelamin" value="L" class="minimal" required="required">
                     Laki-Laki
                    <input type="radio" name="jenis_kelamin" value="P" class="minimal" required="required">
                     Perempuan
                </div>
                 <div class="form-group">
                  <input type="text" name="no_telepon" value="" placeholder="No Telepon" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"></textarea>
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
  <?php } ?>